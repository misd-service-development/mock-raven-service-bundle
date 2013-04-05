<?php

/*
 * This file is part of the MisdMockRavenServiceBundle for Symfony2.
 *
 * (c) University of Cambridge
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Misd\MockRavenServiceBundle\Test;

use Misd\MockRavenServiceBundle\WlsResponse\WlsResponseInterface;
use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase as BaseWebTestCase;

abstract class WebTestCase extends BaseWebTestCase
{
    protected function setNextWlsResponse(Client $client, WlsResponseInterface $wlsResponse)
    {
        $session = $client->getContainer()->get('session');
        $session->set('next_wls_response', $wlsResponse);
        $session->save();
    }
}
