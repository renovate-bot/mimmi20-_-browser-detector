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

/**
 * @author Thomas Müller <mimmi20@live.de>
 */
class LeecoFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        'le 1 pro' => 'leeco le x800',
        'lex626'   => 'leeco le x626',
        'le x829'  => 'leeco le x829',
        'le x820'  => 'leeco le x820',
        'lex820'   => 'leeco le x820',
        'lex720'   => 'leeco le x720',
        'le x620'  => 'leeco le x620',
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

        return $this->loader->load('general leeco device', $useragent);
    }
}