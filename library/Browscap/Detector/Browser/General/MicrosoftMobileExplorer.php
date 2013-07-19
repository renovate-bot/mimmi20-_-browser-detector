<?php
namespace Browscap\Detector\Browser\General;

/**
 * PHP version 5.3
 *
 * LICENSE:
 *
 * Copyright (c) 2013, Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 *
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without 
 * modification, are permitted provided that the following conditions are met:
 *
 * * Redistributions of source code must retain the above copyright notice, 
 *   this list of conditions and the following disclaimer.
 * * Redistributions in binary form must reproduce the above copyright notice, 
 *   this list of conditions and the following disclaimer in the documentation 
 *   and/or other materials provided with the distribution.
 * * Neither the name of the authors nor the names of its contributors may be 
 *   used to endorse or promote products derived from this software without 
 *   specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" 
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE 
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE 
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE 
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR 
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF 
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS 
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN 
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) 
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE 
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @category  Browscap
 * @package   Browscap
 * @copyright Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @license   http://opensource.org/licenses/BSD-3-Clause New BSD License
 * @version   SVN: $Id$
 */

use \Browscap\Detector\BrowserHandler;
use \Browscap\Helper\Utils;
use \Browscap\Detector\MatcherInterface;
use \Browscap\Detector\MatcherInterface\BrowserInterface;
use \Browscap\Detector\EngineHandler;
use \Browscap\Detector\DeviceHandler;
use \Browscap\Detector\OsHandler;
use \Browscap\Detector\Version;

/**
 * @category  Browscap
 * @package   Browscap
 * @copyright Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @license   http://opensource.org/licenses/BSD-3-Clause New BSD License
 * @version   SVN: $Id$
 */
class MicrosoftMobileExplorer
    extends BrowserHandler
    implements MatcherInterface, BrowserInterface
{
    /**
     * the detected browser properties
     *
     * @var array
     */
    protected $_properties = array(
        'wurflKey' => null, // not in wurfl
        
        // kind of device
        'is_bot'                => false,
        'is_transcoder'         => false,
        'is_syndication_reader' => false,     // not in wurfl
        'browser_type'          => 'Browser', // not in wurfl
        'is_banned'             => false,     // not in wurfl
        
        // browser
        'mobile_browser'              => 'IEMobile',
        'mobile_browser_version'      => null,
        'mobile_browser_bits'         => null, // not in wurfl
        'mobile_browser_manufacturer' => 'Microsoft Corporation', // not in wurfl
        'mobile_browser_modus'        => null, // not in wurfl
        
        // product info
        'can_skip_aligned_link_row' => true,
        'device_claims_web_support' => true,
        
        // pdf
        'pdf_support' => true,
        
        // bugs
        'empty_option_value_support' => true,
        'basic_authentication_support' => true,
        'post_method_support' => true,
        
        // rss
        'rss_support' => true,
    );
    
    /**
     * Returns true if this handler can handle the given user agent
     *
     * @return bool
     */
    public function canHandle()
    {
        if (!$this->_utils->checkIfContains(array('IEMobile', 'Windows CE', 'MSIE', 'WPDesktop', 'XBLWP7', 'ZuneWP7'))) {
            return false;
        }
        
        $isNotReallyAnIE = array(
            // using also the Trident rendering engine
            'Maxthon',
            'Galeon',
            'Lunascape',
            'Opera',
            'PaleMoon',
            'Flock',
            'MyIE',
            //others
            'AppleWebKit',
            'Chrome',
            'Linux',
            'MSOffice',
            'Outlook',
            'BlackBerry',
            'WebTV',
            'ArgClrInt'
        );
        
        if ($this->_utils->checkIfContains($isNotReallyAnIE)) {
            return false;
        }
        
        return true;
    }
    
    /**
     * detects the browser version from the given user agent
     *
     * @return string
     */
    protected function _detectVersion()
    {
        $detector = new \Browscap\Detector\Version();
        $detector->setUserAgent($this->_useragent);
        
        if ($this->_utils->checkIfContains(array('XBLWP7', 'ZuneWP7'))) {
            $this->setCapability(
                'mobile_browser_version', $detector->setVersion('9.0')
            );
            return $this;
        }
        
        if ($this->_utils->checkIfContains('WPDesktop')) {
            $this->setCapability(
                'mobile_browser_version', $detector->setVersion('10.0')
            );
            return $this;
        }
        
        $searches = array('IEMobile', 'MSIE');
        
        $this->setCapability(
            'mobile_browser_version', $detector->detectVersion($searches)
        );
        
        return $this;
    }
    
    /**
     * returns null, if the browser does not have a specific rendering engine
     * returns the Engine Handler otherwise
     *
     * @return null|\Browscap\Os\Handler
     */
    public function detectEngine()
    {
        $handler = new \Browscap\Detector\Engine\Trident();
        $handler->setUseragent($this->_useragent);
        
        return $handler->detect();
    }
    
    /**
     * gets the weight of the handler, which is used for sorting
     *
     * @return integer
     */
    public function getWeight()
    {
        return 299565;
    }
    
    /**
     * detects properties who are depending on the browser, the rendering engine
     * or the operating system
     *
     * @return DeviceHandler
     */
    public function detectDependProperties(
        EngineHandler $engine, OsHandler $os, DeviceHandler $device)
    {
        parent::detectDependProperties($engine, $os, $device);
        
        $engine->setCapability('html_web_3_2', false);
        $engine->setCapability('html_wi_oma_xhtmlmp_1_0', true);
        $engine->setCapability('chtml_table_support', false);
        $engine->setCapability('xhtml_select_as_radiobutton', false);
        $engine->setCapability('xhtml_avoid_accesskeys', false);
        $engine->setCapability('xhtml_select_as_dropdown', false);
        $engine->setCapability('xhtml_supports_forms_in_table', false);
        $engine->setCapability('xhtmlmp_preferred_mime_type', 'application/vnd.wap.xhtml+xml');
        $engine->setCapability('xhtml_select_as_popup', false);
        $engine->setCapability('xhtml_honors_bgcolor', false);
        $engine->setCapability('xhtml_file_upload', 'not_supported');
        $engine->setCapability('xhtml_table_support', true);
        $engine->setCapability('bmp', true);
        $engine->setCapability('wbmp', true);
        $engine->setCapability('max_url_length_in_requests', 512);
        $engine->setCapability('wml_make_phone_call_string', 'wtai://wp/mc;');
        $engine->setCapability('card_title_support', true);
        $engine->setCapability('table_support', true);
        $engine->setCapability('elective_forms_recommended', true);
        $engine->setCapability('menu_with_list_of_links_recommended', true);
        $engine->setCapability('break_list_of_links_with_br_element_recommended', true);
        $engine->setCapability('is_sencha_touch_ok', false);
        $engine->setCapability('viewport_width', 'device_width_token');
        $engine->setCapability('viewport_supported', true);
        $engine->setCapability('viewport_userscalable', 'no');
        $engine->setCapability('css_spriting', true);
        $engine->setCapability('supports_background_sounds', false);
        $engine->setCapability('supports_java_applets', false);
        
        $version = (float) $this->getCapability('mobile_browser_version')->getVersion(
            Version::MAJORMINOR
        );
        
        if ($version >= 8) {
            $engine->setCapability('tiff', true);
            $engine->setCapability('image_inlining', true);
        }
        
        $engine->setCapability('is_sencha_touch_ok', false);
        
        if ($version >= 10) {
            $engine->setCapability('jqm_grade', 'A');
            $engine->setCapability('is_sencha_touch_ok', true);
        } elseif ($version >= 8) {
            $engine->setCapability('jqm_grade', 'A');
        } elseif ($version >= 7) {
            $engine->setCapability('jqm_grade', 'B');
        } else {
            $engine->setCapability('jqm_grade', 'C');
        }
        
        if ($this->_utils->checkIfContains('WPDesktop')) {
            $this->setCapability('mobile_browser_modus', 'Desktop Mode');
        }
        
        return $this;
    }
}