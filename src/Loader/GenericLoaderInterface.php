<?php
/**
 * This file is part of the browser-detector package.
 *
 * Copyright (c) 2012-2018, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace BrowserDetector\Loader;

interface GenericLoaderInterface
{
    /**
     * @param string $useragent
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \BrowserDetector\Loader\NotFoundException
     *
     * @return mixed
     */
    public function __invoke(string $useragent);

    /**
     * initializes cache
     *
     * @throws \Psr\SimpleCache\InvalidArgumentException
     *
     * @return void
     */
    public function init(): void;

    /**
     * @param string $key
     * @param string $useragent
     *
     * @throws \BrowserDetector\Loader\NotFoundException
     *
     * @return mixed
     */
    public function load(string $key, string $useragent = '');
}
