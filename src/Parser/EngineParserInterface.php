<?php
/**
 * This file is part of the browser-detector package.
 *
 * Copyright (c) 2012-2023, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace BrowserDetector\Parser;

use BrowserDetector\Loader\NotFoundException;
use UnexpectedValueException;

interface EngineParserInterface
{
    /**
     * Gets the information about the engine by User Agent
     *
     * @throws void
     */
    public function parse(string $useragent): string;

    /**
     * @return array{name: string|null, version: string|null, manufacturer: string}
     *
     * @throws NotFoundException
     * @throws UnexpectedValueException
     */
    public function load(string $key, string $useragent = ''): array;
}
