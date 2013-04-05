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
    public function setVer($ver);

    public function setUrl($url);

    public function setParams($params);

    /**
     * Get WLS response.
     *
     * @return array
     */
    public function getResponse();
}
