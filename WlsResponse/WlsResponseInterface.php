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
 * WLS response interface.
 *
 * @author Chris Wilkinson <chris.wilkinson@admin.cam.ac.uk>
 */
interface WlsResponseInterface
{
    /**
     * Set the ver parameter.
     *
     * @param $ver
     */
    public function setVer($ver);

    /**
     * Set the url parameter.
     *
     * @param $url
     */
    public function setUrl($url);

    /**
     * Set the params parameter.
     *
     * @param $params
     */
    public function setParams($params);

    /**
     * Get WLS response.
     *
     * @return array
     */
    public function getResponse();
}
