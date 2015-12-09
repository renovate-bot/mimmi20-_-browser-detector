<?php
/**
 * Copyright (c) 2012-2015, Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
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
 * @package   BrowserDetector
 * @author    Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @copyright 2012-2015 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 * @link      https://github.com/mimmi20/BrowserDetector
 */

namespace BrowserDetector\Detector\Device\Mobile\Amazon;

use BrowserDetector\Detector\Company;
use UaDeviceType\Tablet;
use UaMatcher\Browser\BrowserInterface;
use UaMatcher\Device\DeviceHasWurflKeyInterface;
use BrowserDetector\Detector\Device\AbstractDevice;
use UaMatcher\Engine\EngineInterface;
use UaMatcher\Os\OsInterface;

/**
 * @category  BrowserDetector
 * @package   BrowserDetector
 * @copyright 2012-2015 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class AmazonKftt extends AbstractDevice implements DeviceHasWurflKeyInterface
{
    /**
     * the detected browser properties
     *
     * @var array
     */
    protected $properties = array(
        // device
        'model_name'             => 'KFTT',
        'model_extra_info'       => null,
        'marketing_name'         => 'Kindle Fire HD 7', // wurflkey: amazon_kindle_fire_hd7_ver1_subuanosilk
        'has_qwerty_keyboard'    => true,
        'pointing_method'        => 'touchscreen', // wurflkey: amazon_kindle_fire_hd7_ver1_subuanosilk

        // product info
        'ununiqueness_handler'   => null,
        'uaprof'                 => null,
        'uaprof2'                => null,
        'uaprof3'                => null,
        'unique'                 => true,
        // display
        'physical_screen_width'  => 95,
        'physical_screen_height' => 151,
        'columns'                => 80,
        'rows'                   => 100,
        'max_image_width'        => 580,
        'max_image_height'       => 1000,
        'resolution_width'       => 1280,
        'resolution_height'      => 800,
        'dual_orientation'       => true,
        'colors'                 => 256,
        // sms
        'sms_enabled'            => true, // wurflkey: amazon_kindle_fire_hd7_ver1_subuadesktop

        // chips
        'nfc_support'            => true, // wurflkey: amazon_kindle_fire_hd7_ver1_subuadesktop
    );

    /**
     * checks if this device is able to handle the useragent
     *
     * @return boolean returns TRUE, if this device can handle the useragent
     */
    public function canHandle()
    {
        if (!$this->utils->checkIfContains(array('KFTT'))) {
            return false;
        }

        return true;
    }

    /**
     * gets the weight of the handler, which is used for sorting
     *
     * @return integer
     */
    public function getWeight()
    {
        return 3;
    }

    /**
     * returns the type of the current device
     *
     * @return \UaDeviceType\TypeInterface
     */
    public function getDeviceType()
    {
        return new Tablet();
    }

    /**
     * returns the type of the current device
     *
     * @return \BrowserDetector\Detector\Company\AbstractCompany
     */
    public function getManufacturer()
    {
        return new Company\Amazon();
    }

    /**
     * returns the type of the current device
     *
     * @return \BrowserDetector\Detector\Company\AbstractCompany
     */
    public function getBrand()
    {
        return new Company\Amazon();
    }

    /**
     * returns the WurflKey for the device
     *
     * @param \UaMatcher\Browser\BrowserInterface $browser
     * @param \UaMatcher\Engine\EngineInterface   $engine
     * @param \UaMatcher\Os\OsInterface           $os
     *
     * @return string|null
     */
    public function getWurflKey(BrowserInterface $browser, EngineInterface $engine, OsInterface $os)
    {
        $wurflKey = 'amazon_kindle_fire_hd7_ver1_subuadesktop';
        if ('Android Webkit' == $browser->getName() || 'Chrome' == $browser->getName()) {
            $wurflKey = 'amazon_kindle_fire_hd7_ver1_subuanosilk';
        }

        return $wurflKey;
    }
}
