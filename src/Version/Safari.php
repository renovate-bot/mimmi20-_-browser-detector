<?php
/**
 * This file is part of the browser-detector package.
 *
 * Copyright (c) 2012-2017, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace BrowserDetector\Version;

use BrowserDetector\Helper\Safari as SafariHelper;

/**
 * @author Thomas Müller <mimmi20@live.de>
 */
class Safari implements VersionCacheFactoryInterface
{
    /**
     * returns the version of the operating system/platform
     *
     * @param string $useragent
     *
     * @return \BrowserDetector\Version\VersionInterface
     */
    public function detectVersion(string $useragent): VersionInterface
    {
        $safariHelper = new SafariHelper();

        $doMatch = preg_match('/Version\/([\d\.]+)/', $useragent, $matches);

        if ($doMatch) {
            return VersionFactory::set($safariHelper->mapSafariVersions($matches[1]));
        }

        $doMatch = preg_match('/Safari\/([\d\.]+)/', $useragent, $matches);

        if ($doMatch) {
            return VersionFactory::set($safariHelper->mapSafariVersions($matches[1]));
        }

        return new Version('0');
    }
}
