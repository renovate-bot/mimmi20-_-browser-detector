<?php
/**
 * This file is part of the browser-detector package.
 *
 * Copyright (c) 2012-2024, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace BrowserDetector\Version;

use BrowserDetector\Version\Exception\NotNumericException;
use Psr\Log\LoggerInterface;

use function mb_strtolower;
use function preg_match;
use function str_contains;

final class WindowsMobileOs implements VersionFactoryInterface
{
    public const SEARCHES = ['Windows Mobile', 'Windows Phone'];

    /** @throws void */
    public function __construct(
        private readonly LoggerInterface $logger,
        private readonly VersionBuilderInterface $versionBuilder,
    ) {
        // nothing to do
    }

    /**
     * returns the version of the operating system/platform
     *
     * @throws void
     */
    public function detectVersion(string $useragent): VersionInterface
    {
        if (
            str_contains(mb_strtolower($useragent), 'windows nt 5.1') !== false
            && !preg_match('/windows mobile|windows phone/i', $useragent)
        ) {
            try {
                return $this->versionBuilder->set('6.0');
            } catch (NotNumericException $e) {
                $this->logger->info($e);
            }

            return new NullVersion();
        }

        try {
            return $this->versionBuilder->detectVersion($useragent, self::SEARCHES);
        } catch (NotNumericException $e) {
            $this->logger->info($e);
        }

        return new NullVersion();
    }
}
