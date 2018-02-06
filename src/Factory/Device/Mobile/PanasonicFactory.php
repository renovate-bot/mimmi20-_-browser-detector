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
namespace BrowserDetector\Factory\Device\Mobile;

use BrowserDetector\Factory;
use BrowserDetector\Loader\ExtendedLoaderInterface;
use Stringy\Stringy;

class PanasonicFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        'eluga_arc_2' => 'panasonic eluga arc 2',
        'eluga a'     => 'panasonic eluga a',
        't50'         => 'panasonic t50',
        'p61'         => 'panasonic p61',
        'p55'         => 'panasonic p55',
        'p31'         => 'panasonic p31',
        'dl1'         => 'panasonic dl1',
        'kx-prxa15'   => 'panasonic kx-prxa15',
        'sv-mv100'    => 'panasonic sv-mv100',
    ];

    /**
     * @var \BrowserDetector\Loader\ExtendedLoaderInterface
     */
    private $loader;

    /**
     * @param \BrowserDetector\Loader\ExtendedLoaderInterface $loader
     */
    public function __construct(ExtendedLoaderInterface $loader)
    {
        $this->loader = $loader;
    }

    /**
     * detects the device name from the given user agent
     *
     * @param string           $useragent
     * @param \Stringy\Stringy $s
     *
     * @return array
     */
    public function detect(string $useragent, Stringy $s): array
    {
        foreach ($this->devices as $search => $key) {
            if ($s->contains($search, false)) {
                return $this->loader->load($key, $useragent);
            }
        }

        return $this->loader->load('general panasonic device', $useragent);
    }
}
