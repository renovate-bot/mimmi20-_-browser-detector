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

use BrowserDetector\Detector\Device\Mobile\Digma;
use BrowserDetector\Detector\Factory\DeviceFactory;
use BrowserDetector\Detector\Factory\FactoryInterface;

/**
 * @category  BrowserDetector
 *
 * @copyright 2012-2016 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class DigmaFactory implements FactoryInterface
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
        $deviceCode = 'general digma device';

        if (preg_match('/PS1043MG/', $useragent)) {
            $deviceCode = 'ps1043mg';
        }

        if (preg_match('/TT7026MW/', $useragent)) {
            $deviceCode = 'tt7026mw';
        }

        if (preg_match('/iDxD7/', $useragent)) {
            $deviceCode = 'idxd7 3g';
        }

        if (preg_match('/iDxD4/', $useragent)) {
            $deviceCode = 'idxd4 3g';
        }

        if (preg_match('/iDsD7/', $useragent)) {
            $deviceCode = 'idsd7 3g';
        }

        if (preg_match('/iDnD7/', $useragent)) {
            $deviceCode = 'idnd7';
        }

        if (preg_match('/iDjD7/', $useragent)) {
            $deviceCode = 'idjd7';
        }

        if (preg_match('/iDrQ10/', $useragent)) {
            $deviceCode = 'idrq10 3g';
        }

        return DeviceFactory::get($deviceCode, $useragent);
    }
}
