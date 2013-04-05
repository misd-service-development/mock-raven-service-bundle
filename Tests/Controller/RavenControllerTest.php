<?php

/*
 * This file is part of the MisdMockRavenServiceBundle for Symfony2.
 *
 * (c) University of Cambridge
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Misd\MockRavenServiceBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response as AppResponse;

class RavenControllerTest extends WebTestCase
{
    /**
     * @dataProvider ravenProvider
     */
    public function testRaven($ver, $url, $params)
    {
        $client = static::createClient();

        $client->request('GET', '/auth/authenticate.html', array('ver' => $ver, 'url' => $url, 'params' => $params));

        /** @var AppResponse $response */
        $response = $client->getResponse();

        $this->assertTrue($response->isRedirect());
        $this->assertStringStartsWith($url, $response->headers->get('Location'));
        if (null !== $params) {
            $this->assertContains(urlencode($params), $response->headers->get('Location'));
        }
    }

    public function ravenProvider()
    {
        return array(
            array(1, 'http://localhost/foo', null),
            array(2, 'http://localhost/foo?query=key', null),
            array(2, 'http://localhost/foo?query=key', 'one=two'),
        );
    }
}
