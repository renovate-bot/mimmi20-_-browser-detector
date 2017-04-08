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
use BrowserDetector\Loader\LoaderInterface;
use Stringy\Stringy;

/**
 * @category  BrowserDetector
 *
 * @copyright 2012-2017 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class BluFactory implements Factory\FactoryInterface
{
    /**
     * @var \BrowserDetector\Loader\LoaderInterface|null
     */
    private $loader = null;

    /**
     * @param \BrowserDetector\Loader\LoaderInterface $loader
     */
    public function __construct(LoaderInterface $loader)
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
    public function detect($useragent, Stringy $s = null)
    {
        if ($s->contains('VIVO IV', true)) {
            return $this->loader->load('vivo iv', $useragent);
        }

        if ($s->contains('studio 5.5', false)) {
            return $this->loader->load('studio 5.5', $useragent);
        }

        if ($s->contains('Studio 5.0 S II', true)) {
            return $this->loader->load('studio 5.0 s ii', $useragent);
        }

        if ($s->contains('WIN HD W510u', true)) {
            return $this->loader->load('win hd w510u', $useragent);
        }

        if ($s->contains('WIN HD LTE', true)) {
            return $this->loader->load('win hd lte', $useragent);
        }

        if ($s->contains('WIN JR W410a', true)) {
            return $this->loader->load('win jr w410a', $useragent);
        }

        if ($s->contains('WIN JR LTE', true)) {
            return $this->loader->load('win jr lte', $useragent);
        }

        return $this->loader->load('general blu device', $useragent);
    }
}
