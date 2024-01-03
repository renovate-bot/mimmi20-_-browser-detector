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

namespace BrowserDetector\Parser\Device;

use BrowserDetector\Parser\Helper\RulefileParserInterface;

use function sprintf;

final class MobileParser implements MobileParserInterface
{
    private const GENERIC_FILE = __DIR__ . '/../../../data/factories/devices/mobile.json';

    private const SPECIFIC_FILE = __DIR__ . '/../../../data/factories/devices/mobile/%s.json';

    /** @throws void */
    public function __construct(private readonly RulefileParserInterface $fileParser)
    {
        // nothing to do
    }

    /**
     * Gets the information about the device by User Agent
     *
     * @return non-empty-string
     *
     * @throws void
     */
    public function parse(string $useragent): string
    {
        $company = $this->fileParser->parseFile(self::GENERIC_FILE, $useragent, 'unknown');

        $key = $this->fileParser->parseFile(
            sprintf(self::SPECIFIC_FILE, $company),
            $useragent,
            'unknown',
        );

        return $company . '=' . $key;
    }
}
