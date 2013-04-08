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

class SuccessWlsResponse extends AbstractWlsResponse
{
    private $principal;

    public function __construct($principal = 'test0001')
    {
        $this->principal = $principal;
    }

    protected function getStatus()
    {
        return 200;
    }

    public function getPrincipal()
    {
        return $this->principal;
    }
}
