<?php
/**
 * Copyright (c) 2012-2014, Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
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
 * @copyright 2012-2014 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 * @link      https://github.com/mimmi20/BrowserDetector
 */

namespace BrowserDetector\Detector\Os;

use BrowserDetector\Detector\Browser\Desktop\Chrome;
use BrowserDetector\Detector\Browser\Desktop\Chromium;
use BrowserDetector\Detector\Browser\Desktop\Firefox;
use BrowserDetector\Detector\Browser\Desktop\Opera;
use BrowserDetector\Detector\Browser\Desktop\YouWaveAndroidOnPc;
use BrowserDetector\Detector\Browser\General\AdbeatBot;
use BrowserDetector\Detector\Browser\General\Googlebot;
use BrowserDetector\Detector\Browser\Mobile\Android;
use BrowserDetector\Detector\Browser\Mobile\AndroidDownloadManager;
use BrowserDetector\Detector\Browser\Mobile\Dalvik;
use BrowserDetector\Detector\Browser\Mobile\Dolfin;
use BrowserDetector\Detector\Browser\Mobile\MqqBrowser;
use BrowserDetector\Detector\Browser\Mobile\NetFrontLifeBrowser;
use BrowserDetector\Detector\Browser\Mobile\OperaMini;
use BrowserDetector\Detector\Browser\Mobile\OperaMobile;
use BrowserDetector\Detector\Browser\Mobile\Silk;
use BrowserDetector\Detector\Browser\Mobile\Ucweb;
use BrowserDetector\Detector\Browser\Mobile\YaBrowser;
use BrowserDetector\Detector\Browser\UnknownAbstractBrowser;
use BrowserDetector\Detector\Chain;
use BrowserDetector\Detector\Company;
use BrowserDetector\Detector\MatcherInterface\OsInterface;

use BrowserDetector\Detector\Version;

/**
 * MSIEAgentHandler
 *
 *
 * @category  BrowserDetector
 * @package   BrowserDetector
 * @copyright 2012-2014 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class Ubuntu
    extends AbstractOs
    implements OsInterface
{
    /**
     * Returns true if this handler can handle the given $useragent
     *
     * @return bool
     */
    public function canHandle()
    {
        if (!$this->utils->checkIfContains('ubuntu', true)) {
            return false;
        }

        if ($this->utils->checkIfContains('kubuntu', true)) {
            return false;
        }

        return true;
    }

    /**
     * returns the name of the operating system/platform
     *
     * @return string
     */
    public function getName()
    {
        return 'Ubuntu';
    }

    /**
     * returns the version of the operating system/platform
     *
     * @return \BrowserDetector\Detector\Version
     */
    public function detectVersion()
    {
        $detector = new Version();
        $detector->setUserAgent($this->useragent);

        $searches = array('Ubuntu', 'ubuntu');

        return $detector->detectVersion($searches);
    }

    /**
     * returns the version of the operating system/platform
     *
     * @return \BrowserDetector\Detector\Company\CompanyInterface
     */
    public function getManufacturer()
    {
        return new Company\Canonical();
    }

    /**
     * gets the weight of the handler, which is used for sorting
     *
     * @return integer
     */
    public function getWeight()
    {
        return 5798025;
    }

    /**
     * returns null, if the device does not have a specific Browser
     * returns the Browser Handler otherwise
     *
     * @return null|\BrowserDetector\Detector\AbstractBrowser
     */
    public function detectBrowser()
    {
        $browsers = array(

            new Android(),
            new Chrome(),
            new Dalvik(),
            new Silk(),
            new Dolfin(),
            new NetFrontLifeBrowser(),
            new Googlebot(),
            new Opera(),
            new OperaMini(),
            new OperaMobile(),
            new Firefox(),
            new YouWaveAndroidOnPc(),
            new AndroidDownloadManager(),
            new Ucweb(),
            new YaBrowser(),
            new MqqBrowser(),
            new Chromium(),
            new AdbeatBot(),
        );

        $chain = new Chain();
        $chain->setUserAgent($this->useragent);
        $chain->setHandlers($browsers);
        $chain->setDefaultHandler(new UnknownAbstractBrowser());

        return $chain->detect();
    }
}