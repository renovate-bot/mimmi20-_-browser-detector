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

namespace BrowserDetector\Detector\Browser;

use BrowserDetector\Detector\Company;
use BrowserDetector\Detector\Engine\Gecko;
use UaBrowserType\Browser;
use UaResult\Version;
use UaMatcher\Browser\BrowserHasSpecificEngineInterface;

/**
 * @category  BrowserDetector
 * @package   BrowserDetector
 * @copyright 2012-2015 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class Netscape extends AbstractBrowser implements BrowserHasSpecificEngineInterface
{
    /**
     * the detected browser properties
     *
     * @var array
     */
    protected $properties = array(
        // browser
        'mobile_browser_modus'         => null, // not in wurfl

        // product info
        'can_skip_aligned_link_row'    => true,
        'device_claims_web_support'    => false,
        // pdf
        'pdf_support'                  => true,
        // bugs
        'empty_option_value_support'   => true,
        'basic_authentication_support' => true,
        'post_method_support'          => true,
        // rss
        'rss_support'                  => false,
    );

    /**
     * Returns true if this handler can handle the given user agent
     *
     * @return bool
     */
    public function canHandle()
    {
        if (!$this->utils->checkIfContains('Mozilla/')) {
            return false;
        }

        $isNotReallyAnNetscape = array(
            'compatible',
            // using also the Gecko rendering engine
            'Firefox',
            'Maemo',
            'Maxthon',
            'MxBrowser',
            'Camino',
            'Galeon',
            'Lunascape',
            'Opera',
            'Navigator',
            'PaleMoon',
            'SeaMonkey',
            'Flock',
            'Fennec',
            'Iceape',
            'Icedove',
            'IceCat',
            'Eudora',
            //Nutch
            'Nutch',
            'CazoodleBot',
            'LOOQ',
            'Postbox',
            // using the Trident rendering engine
            'MSIE',
            'AOL',
            'TOB',
            'MyIE',
            'AppleWebKit',
            'Chrome',
            'MSOffice',
            'Outlook',
            'IEMobile',
            'BlackBerry',
            'WebTV',
            'ArgClrInt',
            // using the KHTML rendering engine
            'AppleWebKit',
            'Chrome',
            'Chromium',
            'Iron',
            'Rockmelt',
            'libwww',
            'OviBrowser',
            'K-Meleon',
            'Google Desktop',
            'Konqueror',
            // other rendering engines
            'Trident',
            // other applications
            'LotusNotes/',
            'Lotus-Notes/',
            // Fakes/Bots
            'Mac; Mac OS ',
            'Esribot',
            'sp_auditbot',
            'BLEXBot',
            'Yahoo',
            'ca-crawler',
            'fr-crawler',
            'sindice-fetcher',
            'DotBot',
            'semantic-visions.com crawler',
            'proximic',
            'publiclibraryarchive',
            'nbot',
            'WI Job Roboter',
            'Spiderlytics',
            'SemrushBot',
            'XoviBot',
            'aggregator:Spinn3r',
            'URLAppendBot',
            'GrapeshotCrawler',
            'SeznamBot',
            'linkdexbot',
            'CareerBot',
            'WBSearchBot',
            'Mail.RU_Bot',
            '80legs',
            'ThumbShotsBot',
            'OpenVAS',
            'Genieo',
            'Yeti',
            'WinHttp',
            'naver',
            'Feedfetcher-Google',
            'feedfetcher',
            'Exabot',
            'Powermarks',
            'metager2-verification-bot',
            'OpenHoseBot',
            'Kazehakase',
            'Polaris',
            'GooglePlus',
            'awmt',
            'Another Web Mining Tool',
            'TYPO3-linkvalidator',
            'PaperLiBot',
            'www.google.com',
            'Google-StructuredDataTestingTool',
            'WebmasterCoffee',
            'picmole',
            'uMBot',
            'Zollard',
            'FHScan',
            'LoadTimeBot',
            'Scrubby',
            'lbot',
            'Squzer',
            'EasouSpider',
            'Socialradarbot',
            'Synapse',
            'coccoc',
            'SiteExplorer',
            'IstellaBot',
            'meanpathbot',
            'Apercite',
            'XML Sitemaps Generator',
            'PiplBot',
            'Add Catalog',
            'Moreover',
            'LinkpadBot',
            'Lipperhey SEO Service',
            'Blog Search',
        );

        if ($this->utils->checkIfContains($isNotReallyAnNetscape)) {
            return false;
        }

        $isNotReallyAnNetscapeLowerCased = array(
            'www.archive.org',
            'archive.org_bot',
            'memorybot',
            'waybackarchive',
            'spbot',
            'heritrix',
            'bingbot',
            'crawler',
        );

        if ($this->utils->checkIfContains($isNotReallyAnNetscapeLowerCased, true)) {
            return false;
        }

        return true;
    }

    /**
     * gets the name of the browser
     *
     * @return string
     */
    public function getName()
    {
        return 'Netscape';
    }

    /**
     * gets the maker of the browser
     *
     * @return \BrowserDetector\Detector\Company\AbstractCompany
     */
    public function getManufacturer()
    {
        return new Company\Netscape();
    }

    /**
     * returns the type of the current device
     *
     * @return \UaBrowserType\TypeInterface
     */
    public function getBrowserType()
    {
        return new Browser();
    }

    /**
     * detects the browser version from the given user agent
     *
     * @return \UaResult\Version
     */
    public function detectVersion()
    {
        $detector = new Version();
        $detector->setUserAgent($this->useragent);

        $searches = array('Netscape', 'Netscape6', 'rv\:', 'Mozilla');

        return $detector->detectVersion($searches);
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
     * returns null, if the browser does not have a specific rendering engine
     * returns the Engine Handler otherwise
     *
     * @return \BrowserDetector\Detector\Engine\Gecko
     */
    public function getEngine()
    {
        return new Gecko($this->useragent, $this->logger);
    }
}
