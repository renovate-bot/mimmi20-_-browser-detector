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
namespace BrowserDetector\Loader;

use BrowserDetector\Version\Version;
use BrowserDetector\Version\VersionFactory;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;
use UaResult\Company\CompanyLoader;
use UaResult\Engine\Engine;
use UaResult\Engine\EngineInterface;

/**
 * Browser detection class
 *
 * @author Thomas Müller <mimmi20@live.de>
 */
class EngineLoader implements ExtendedLoaderInterface
{
    /**
     * @var \Psr\Cache\CacheItemPoolInterface
     */
    private $cache;

    /**
     * @param \Psr\Cache\CacheItemPoolInterface $cache
     *
     * @return self
     */
    public function __construct(CacheItemPoolInterface $cache)
    {
        $this->cache = $cache;
    }

    /**
     * initializes cache
     *
     * @return void
     */
    private function init(): void
    {
        $cacheInitializedId = hash('sha512', 'engine-cache is initialized');
        $cacheInitialized   = $this->cache->getItem($cacheInitializedId);

        if (!$cacheInitialized->isHit() || !$cacheInitialized->get()) {
            $this->initCache($cacheInitialized);
        }
    }

    /**
     * @param string $engineKey
     *
     * @return bool
     */
    public function has(string $engineKey): bool
    {
        $this->init();

        $cacheItem = $this->cache->getItem(hash('sha512', 'engine-cache-' . $engineKey));

        return $cacheItem->isHit();
    }

    /**
     * @param string $engineKey
     * @param string $useragent
     *
     * @throws \BrowserDetector\Loader\NotFoundException
     *
     * @return \UaResult\Engine\EngineInterface
     */
    public function load(string $engineKey, string $useragent = ''): EngineInterface
    {
        $this->init();

        if (!$this->has($engineKey)) {
            throw new NotFoundException('the engine with key "' . $engineKey . '" was not found');
        }

        $cacheItem = $this->cache->getItem(hash('sha512', 'engine-cache-' . $engineKey));

        $engine = $cacheItem->get();

        $engineVersionClass = $engine->version->class;

        if (!is_string($engineVersionClass)) {
            $version = new Version('0');
        } elseif ('VersionFactory' === $engineVersionClass) {
            $version = VersionFactory::detectVersion($useragent, $engine->version->search);
        } else {
            /* @var \BrowserDetector\Version\VersionCacheFactoryInterface $versionClass */
            $versionClass = new $engineVersionClass();
            $version      = $versionClass->detectVersion($useragent);
        }

        return new Engine(
            $engine->name,
            (new CompanyLoader($this->cache))->load($engine->manufacturer),
            $version
        );
    }

    /**
     * @param \Psr\Cache\CacheItemInterface $cacheInitialized
     *
     * @return void
     */
    private function initCache(CacheItemInterface $cacheInitialized): void
    {
        static $engines = null;

        if (null === $engines) {
            $engines = json_decode(file_get_contents(__DIR__ . '/../../data/engines.json'));
        }

        foreach ($engines as $engineKey => $engineData) {
            $cacheItem = $this->cache->getItem(hash('sha512', 'engine-cache-' . $engineKey));
            $cacheItem->set($engineData);

            $this->cache->save($cacheItem);
        }

        $cacheInitialized->set(true);
        $this->cache->save($cacheInitialized);
    }
}
