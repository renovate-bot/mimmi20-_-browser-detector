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

/**
 * @author Thomas Müller <mimmi20@live.de>
 */
class AndroidOs implements VersionCacheFactoryInterface
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
        if (false !== mb_stripos($useragent, 'android 2.1-update1')) {
            return VersionFactory::set('2.1.1');
        }

        $search = [
            'android android',
            'android androidhouse team',
            'android wildpuzzlerom v8 froyo',
            'juc ?\(linux;',
            'linux; googletv',
            'android os',
            'android;',
            'android_',
            'android ',
            'android\/',
            'android',
            'adr ',
        ];

        $detectedVersion = VersionFactory::detectVersion($useragent, $search);

        if ('0.0.0' !== $detectedVersion->getVersion()) {
            return $detectedVersion;
        }

        if (preg_match('/Linux; (\d+[\d\.]+)/', $useragent, $matches)) {
            return VersionFactory::set($matches[1]);
        }

        if (false !== mb_stripos($useragent, 'gingerbread')) {
            return VersionFactory::set('2.3.0');
        }

        if (false !== mb_stripos($useragent, 'android eclair')) {
            return VersionFactory::set('2.1.0');
        }

        return new Version('0');
    }
}
