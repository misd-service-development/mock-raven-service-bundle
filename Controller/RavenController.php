<?php

/*
 * This file is part of the MisdMockRavenServiceBundle for Symfony2.
 *
 * (c) University of Cambridge
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Misd\MockRavenServiceBundle\Controller;

use Misd\MockRavenServiceBundle\WlsResponse\SuccessWlsResponse;
use Misd\MockRavenServiceBundle\WlsResponse\WlsResponseInterface;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Raven controller.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
class RavenController extends ContainerAware
{
    /**
     * Authenticate action.
     *
     * This replicates logging in to Raven.
     *
     * @param Request $request Request.
     *
     * @return RedirectResponse Response.
     */
    public function authenticateAction(Request $request)
    {
        $query = $request->query;

        $wlsResponse = $this->container->get('session')->get('next_wls_response');
        $this->container->get('session')->set('next_wls_response', null);

        if (false === $wlsResponse instanceof WlsResponseInterface) {
            $wlsResponse = new SuccessWlsResponse();
        }

        $wlsResponse->setVer($query->get('ver'));
        $wlsResponse->setUrl($query->get('url'));
        $wlsResponse->setParams($query->get('params'));

        $redirect = $query->get('url') .
            (false !== strpos($query->get('url'), '?') ? '&' : '?') .
            'WLS-Response=' . urlencode(implode('!', $wlsResponse->getResponse()));

        return new RedirectResponse($redirect);
    }
}
