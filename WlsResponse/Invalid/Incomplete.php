<?php

/*
 * This file is part of the MisdMockRavenServiceBundle for Symfony2.
 *
 * (c) University of Cambridge
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Misd\MockRavenServiceBundle\WlsResponse\Invalid;

use Misd\MockRavenServiceBundle\WlsResponse\SuccessfulAuthentication;

class Incomplete extends SuccessfulAuthentication
{
    public function getResponse()
    {
        $response = parent::getResponse();

        unset($response['id']);

        return $response;
    }
}
