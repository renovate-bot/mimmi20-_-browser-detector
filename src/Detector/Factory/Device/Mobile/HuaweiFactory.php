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

use BrowserDetector\Detector\Device\Mobile\Huawei;
use BrowserDetector\Detector\Factory\FactoryInterface;

/**
 * @category  BrowserDetector
 *
 * @copyright 2012-2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class HuaweiFactory implements FactoryInterface
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
        if (preg_match('/y625\-u51/i', $useragent)) {
            return new Huawei\HuaweiY625u51($useragent);
        }

        if (preg_match('/y530\-u00/i', $useragent)) {
            return new Huawei\HuaweiY530u00($useragent);
        }

        if (preg_match('/y330\-u05/i', $useragent)) {
            return new Huawei\HuaweiY330u05($useragent);
        }

        if (preg_match('/y330\-u01/i', $useragent)) {
            return new Huawei\HuaweiY330u01($useragent);
        }

        if (preg_match('/y300/i', $useragent)) {
            return new Huawei\HuaweiY300($useragent);
        }

        if (preg_match('/w2\-u00/i', $useragent)) {
            return new Huawei\HuaweiW2u00($useragent);
        }

        if (preg_match('/w1\-u00/i', $useragent)) {
            return new Huawei\HuaweiW1u00($useragent);
        }

        if (preg_match('/vodafone 858/i', $useragent)) {
            return new Huawei\HuaweiVodafone858($useragent);
        }

        if (preg_match('/vodafone 845/i', $useragent)) {
            return new Huawei\HuaweiVodafone845($useragent);
        }

        if (preg_match('/u9510/i', $useragent)) {
            return new Huawei\HuaweiU9510($useragent);
        }

        if (preg_match('/u9508/i', $useragent)) {
            return new Huawei\HuaweiU9508($useragent);
        }

        if (preg_match('/u9200/i', $useragent)) {
            return new Huawei\HuaweiU9200($useragent);
        }

        if (preg_match('/u8950n/i', $useragent)) {
            return new Huawei\HuaweiU8950n($useragent);
        }

        if (preg_match('/u8950d/i', $useragent)) {
            return new Huawei\HuaweiU8950d($useragent);
        }

        if (preg_match('/u8950/i', $useragent)) {
            return new Huawei\HuaweiU8950($useragent);
        }

        if (preg_match('/u8860/i', $useragent)) {
            return new Huawei\HuaweiU8860($useragent);
        }

        if (preg_match('/u8850/i', $useragent)) {
            return new Huawei\HuaweiU8850($useragent);
        }

        if (preg_match('/u8825/i', $useragent)) {
            return new Huawei\HuaweiU8825($useragent);
        }

        if (preg_match('/u8815/i', $useragent)) {
            return new Huawei\HuaweiU8815($useragent);
        }

        if (preg_match('/u8800/i', $useragent)) {
            return new Huawei\HuaweiU8800($useragent);
        }

        if (preg_match('/u8666e/i', $useragent)) {
            return new Huawei\HuaweiU8666e($useragent);
        }

        if (preg_match('/u8666/i', $useragent)) {
            return new Huawei\HuaweiU8666($useragent);
        }

        if (preg_match('/u8655/i', $useragent)) {
            return new Huawei\HuaweiU8655($useragent);
        }

        if (preg_match('/u8651/i', $useragent)) {
            return new Huawei\HuaweiU8651($useragent);
        }

        if (preg_match('/u8650/i', $useragent)) {
            return new Huawei\HuaweiU8650($useragent);
        }

        if (preg_match('/u8600/i', $useragent)) {
            return new Huawei\HuaweiU8600($useragent);
        }

        if (preg_match('/u8520/i', $useragent)) {
            return new Huawei\HuaweiU8520($useragent);
        }

        if (preg_match('/u8510/i', $useragent)) {
            return new Huawei\HuaweiU8510($useragent);
        }

        if (preg_match('/u8500/i', $useragent)) {
            return new Huawei\HuaweiU8500($useragent);
        }

        if (preg_match('/u8350/i', $useragent)) {
            return new Huawei\HuaweiU8350($useragent);
        }

        if (preg_match('/u8185/i', $useragent)) {
            return new Huawei\HuaweiU8185($useragent);
        }

        if (preg_match('/u8180/i', $useragent)) {
            return new Huawei\HuaweiU8180($useragent);
        }

        if (preg_match('/(u8110|tsp21)/i', $useragent)) {
            return new Huawei\HuaweiU8110($useragent);
        }

        if (preg_match('/u8100/i', $useragent)) {
            return new Huawei\HuaweiU8100($useragent);
        }

        if (preg_match('/u7510/i', $useragent)) {
            return new Huawei\HuaweiU7510($useragent);
        }

        if (preg_match('/s8600/i', $useragent)) {
            return new Huawei\HuaweiS8600($useragent);
        }

        if (preg_match('/p6\-u06/i', $useragent)) {
            return new Huawei\HuaweiP6U06($useragent);
        }

        if (preg_match('/p6 s\-u06/i', $useragent)) {
            return new Huawei\HuaweiP6SU06($useragent);
        }

        if (preg_match('/mt7\-l09/i', $useragent)) {
            return new Huawei\HuaweiMt7L09($useragent);
        }

        if (preg_match('/mt2\-l01/i', $useragent)) {
            return new Huawei\HuaweiMt2L01($useragent);
        }

        if (preg_match('/mt1\-u06/i', $useragent)) {
            return new Huawei\HuaweiMt1U06($useragent);
        }

        if (preg_match('/mediapad t1 8\.0/i', $useragent)) {
            return new Huawei\HuaweiMediaPadT180($useragent);
        }

        if (preg_match('/mediapad m1 8\.0/i', $useragent)) {
            return new Huawei\HuaweiMediaPadM18($useragent);
        }

        if (preg_match('/mediapad 10 link\+/i', $useragent)) {
            return new Huawei\HuaweiMediaPad10LinkPlus($useragent);
        }

        if (preg_match('/mediapad 10 link/i', $useragent)) {
            return new Huawei\HuaweiMediaPad10Link($useragent);
        }

        if (preg_match('/mediapad 7 lite/i', $useragent)) {
            return new Huawei\HuaweiMediaPad7Lite($useragent);
        }

        if (preg_match('/mediapad 7 classic/i', $useragent)) {
            return new Huawei\HuaweiMediaPad7Classic($useragent);
        }

        if (preg_match('/mediapad/i', $useragent)) {
            return new Huawei\HuaweiMediaPad($useragent);
        }

        if (preg_match('/m860/i', $useragent)) {
            return new Huawei\HuaweiM860($useragent);
        }

        if (preg_match('/m635/i', $useragent)) {
            return new Huawei\HuaweiM635($useragent);
        }

        if (preg_match('/ideos s7 slim/i', $useragent)) {
            return new Huawei\HuaweiIdeosS7Slim($useragent);
        }

        if (preg_match('/ideos s7/i', $useragent)) {
            return new Huawei\HuaweiIdeosS7($useragent);
        }

        if (preg_match('/ideos /i', $useragent)) {
            return new Huawei\HuaweiIdeos($useragent);
        }

        if (preg_match('/g510\-0100/i', $useragent)) {
            return new Huawei\HuaweiG5100100($useragent);
        }

        if (preg_match('/g7300/i', $useragent)) {
            return new Huawei\HuaweiG7300($useragent);
        }

        if (preg_match('/g6609/i', $useragent)) {
            return new Huawei\HuaweiG6609($useragent);
        }

        if (preg_match('/g6600/i', $useragent)) {
            return new Huawei\HuaweiG6600($useragent);
        }

        if (preg_match('/g700\-u10/i', $useragent)) {
            return new Huawei\HuaweiG700U10($useragent);
        }

        if (preg_match('/g527\-u081/i', $useragent)) {
            return new Huawei\HuaweiG527u081($useragent);
        }

        if (preg_match('/g525\-u00/i', $useragent)) {
            return new Huawei\HuaweiG525U00($useragent);
        }

        if (preg_match('/g510/i', $useragent)) {
            return new Huawei\HuaweiG510($useragent);
        }

        if (preg_match('/4afrika/i', $useragent)) {
            return new Huawei\Huawei4Afrika($useragent);
        }

        return new Huawei\Huawei($useragent);
    }
}
