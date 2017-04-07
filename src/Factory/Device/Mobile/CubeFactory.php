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
use Psr\Cache\CacheItemPoolInterface;
use Stringy\Stringy;

/**
 * @category  BrowserDetector
 *
 * @copyright 2012-2017 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class CubeFactory implements Factory\FactoryInterface
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
        if ($s->contains('u55gt', false)) {
            return $this->loader->load('u55gt', $useragent);
        }

        if ($s->contains('u51gt', false)) {
            return $this->loader->load('u51gt', $useragent);
        }

        if ($s->contains('u30gt 2', false)) {
            return $this->loader->load('u30gt2', $useragent);
        }

        if ($s->contains('u30gt', false)) {
            return $this->loader->load('u30gt', $useragent);
        }

        if ($s->contains('u25gt-c4w', false)) {
            return $this->loader->load('u25gt-c4w', $useragent);
        }

        return $this->loader->load('general cube device', $useragent);
    }
}
