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

use Misd\MockRavenServiceBundle\WlsResponse\AbstractWlsResponse;

class UndefinedStatusCode extends AbstractWlsResponse
{
    protected function getStatus()
    {
        return 999;
    }
}
