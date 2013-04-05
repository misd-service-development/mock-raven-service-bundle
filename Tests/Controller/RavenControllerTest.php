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
    public function testRaven()
    {
        $client = static::createClient();

        $client->request('GET', '/auth/authenticate.html');

        /** @var AppResponse $response */
        $response = $client->getResponse();

        $this->assertTrue($response->isRedirect());
    }
}
