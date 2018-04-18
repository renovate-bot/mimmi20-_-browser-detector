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
namespace BrowserDetectorTest\Loader;

use BrowserDetector\Cache\Cache;
use BrowserDetector\Loader\EngineLoaderFactory;
use BrowserDetector\Loader\GenericLoader;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;

class EngineLoaderFactoryTest extends TestCase
{
    /**
     * @throws \ReflectionException
     *
     * @return void
     */
    public function testInvoke(): void
    {
        /** @var NullLogger $logger */
        $logger = $this->createMock(NullLogger::class);

        /** @var Cache $cache */
        $cache = $this->createMock(Cache::class);

        $factory = new EngineLoaderFactory($cache, $logger);
        $object  = $factory();

        self::assertInstanceOf(GenericLoader::class, $object);

        $objectTwo = $factory();

        self::assertInstanceOf(GenericLoader::class, $objectTwo);
        self::assertSame($objectTwo, $object);
    }
}
