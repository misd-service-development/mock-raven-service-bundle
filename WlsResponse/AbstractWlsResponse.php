<?php

/*
 * This file is part of the MisdMockRavenServiceBundle for Symfony2.
 *
 * (c) University of Cambridge
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Misd\MockRavenServiceBundle\WlsResponse;

/**
 * Abstract WLS response.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
abstract class AbstractWlsResponse implements WlsResponseInterface
{
    private $ver;
    private $url;
    private $params;

    protected function getVer()
    {
        return $this->ver;
    }

    public function setVer($ver)
    {
        $this->ver = $ver;
    }

    protected function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = str_replace(array('%', '!'), array('%25', '%21'), $url);
    }

    protected function getParams()
    {
        return $this->params;
    }

    public function setParams($params)
    {
        $this->params = $params;
    }

    abstract protected function getStatus();

    protected function getMsg()
    {
        return '';
    }

    protected function getIssue()
    {
        return date('Ymd\THis\Z', time());
    }

    protected function getId()
    {
        return '1351247047-25829-18';
    }

    protected function getPrincipal()
    {
        return '';
    }

    protected function getAuth()
    {
        return 'pwd';
    }

    protected function getSso()
    {
        return '';
    }

    protected function getLife()
    {
        return 36000;
    }

    protected function getKid()
    {
        return 901;
    }

    final private function generateSig()
    {
        $data = implode(
            '!',
            array(
                $this->getVer(),
                $this->getStatus(),
                $this->getMsg(),
                $this->getIssue(),
                $this->getId(),
                $this->getUrl(),
                $this->getPrincipal(),
                $this->getAuth(),
                $this->getSso(),
                $this->getLife(),
                $this->getParams(),
            )
        );
        $pkeyid = openssl_pkey_get_private(
            '-----BEGIN RSA PRIVATE KEY-----
MIICWwIBAAKBgQC4RYvbSGb42EEEXzsz93Mubo0fdWZ7UJ0HoZXQch5XIR0Zl8AN
aLf3tVpRz4CI2JBUVpUjXEgzOa+wZBbuvczOuiB3BfNDSKKQaftxWKouboJRA5ac
xa3fr2JZc8O5Qc1J6Qq8E8cjuSQWlpxTGa0JEnbKV7/PVUFDuFeEI11e/wIDAQAB
AoGACr2jBUkXF3IjeAnE/aZyxEYVW7wQGSf9vzAf92Jvekyn0ZIS07VC4+FiPlqF
93QIFaJmVwVOAA5guztaStgtU9YX37wRPkFwrtKgjZcqV8ReQeC67bjo5v3Odht9
750F7mKWXctZrm0MD1PoDlkLvVZ2hDolHm5tpfP52jPvQ6ECQQDgtI4K3IuEVOIg
75xUG3Z86DMmwPmme7vsFgf2goWV+p4471Ang9oN7l+l+Jj2VISdz7GE7ZQwW6a1
IQev3+h7AkEA0e9oC+lCcYsMsI9vtXvB8s6Bpl0c1U19HUUWHdJIpluwvxF6SIL3
ug4EJPP+sDT5LvdV5cNy7nmO9uUd+Se2TQJAdxI2UrsbkzwHt7xA8rC60OWadWa8
4+OdaTUjcxUnBJqRTUpDBy1vVwKB3MknBSE0RQvR3canSBjI9iJSmHfmEQJAKJlF
49fOU6ryX0q97bjrPwuUoxmqs81yfrCXoFjEV/evbKPypAc/5SlEv+i3vlfgQKbw
Y6iyl0/GyBRzAXYemQJAVeChw15Lj2/uE7HIDtkqd8POzXjumOxKPfESSHKxRGnP
3EruVQ6+SY9CDA1xGfgDSkoFiGhxeo1lGRkWmz09Yw==
-----END RSA PRIVATE KEY-----'
        );

        openssl_sign($data, $signature, $pkeyid);

        openssl_free_key($pkeyid);

        $signature =
            preg_replace(
                array(
                    '#\+#',
                    '#/#',
                    '#=#',
                ),
                array(
                    '-',
                    '.',
                    '_',
                ),
                base64_encode($signature)
            );

        return $signature;
    }

    public function getResponse()
    {
        return array(
            'ver' => $this->getVer(),
            'status' => $this->getStatus(),
            'msg' => $this->getMsg(),
            'issue' => $this->getIssue(),
            'id' => $this->getId(),
            'url' => $this->getUrl(),
            'principal' => $this->getPrincipal(),
            'auth' => $this->getAuth(),
            'sso' => $this->getSso(),
            'life' => $this->getLife(),
            'params' => $this->getParams(),
            'kid' => $this->getKid(),
            'sig' => $this->generateSig(),
        );
    }
}
