<?php
/**
 * Copyright (c) 2012-2016, Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @category  BrowserDetector
 *
 * @author    Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @copyright 2012-2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 *
 * @link      https://github.com/mimmi20/BrowserDetector
 */

namespace BrowserDetector\Detector\Factory\Device\Mobile;

use BrowserDetector\Detector\Device\Mobile\Coby;
use BrowserDetector\Detector\Factory\DeviceFactory;
use BrowserDetector\Detector\Factory\FactoryInterface;

/**
 * @category  BrowserDetector
 *
 * @copyright 2012-2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class CobyFactory implements FactoryInterface
{
    /**
     * detects the device name from the given user agent
     *
     * @param string $useragent
     *
     * @return \UaResult\Device\DeviceInterface
     */
    public static function detect($useragent)
    {
        $deviceCode = 'general coby device';

        if (preg_match('/MID9742/i', $useragent)) {
            $deviceCode = 'mid9742';
        }

        if (preg_match('/MID8128/i', $useragent)) {
            $deviceCode = 'mid8128';
        }

        if (preg_match('/MID8127/i', $useragent)) {
            $deviceCode = 'mid8127';
        }

        if (preg_match('/MID8024/i', $useragent)) {
            $deviceCode = 'mid8024';
        }

        if (preg_match('/MID7022/i', $useragent)) {
            $deviceCode = 'mid7022';
        }

        if (preg_match('/MID7015/i', $useragent)) {
            $deviceCode = 'mid7015';
        }

        if (preg_match('/MID1126/i', $useragent)) {
            $deviceCode = 'mid1126';
        }

        if (preg_match('/MID1125/i', $useragent)) {
            $deviceCode = 'mid1125';
        }

        if (preg_match('/NBPC724/i', $useragent)) {
            $deviceCode = 'nbpc724';
        }

        return DeviceFactory::get($deviceCode, $useragent);
    }
}
