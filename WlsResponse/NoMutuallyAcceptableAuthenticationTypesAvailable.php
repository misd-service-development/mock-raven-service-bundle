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

class NoMutuallyAcceptableAuthenticationTypesAvailable extends AbstractWlsResponse
{
    protected function getStatus()
    {
        return 510;
    }
}
