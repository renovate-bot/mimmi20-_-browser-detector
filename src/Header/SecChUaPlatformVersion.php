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

namespace BrowserDetector\Header;

final class SecChUaPlatformVersion implements HeaderInterface
{
    use HeaderTrait;

    /** @throws void */
    public function hasPlatformVersion(): bool
    {
        return true;
    }
}
