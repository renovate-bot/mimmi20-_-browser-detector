<?php
namespace Browscap\Browser\Handlers;

/**
 * Copyright (c) 2012 ScientiaMobile, Inc.
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or(at your option) any later version.
 *
 * Refer to the COPYING.txt file distributed with this package.
 *
 * @category   WURFL
 * @package    WURFL_Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    SVN: $Id$
 */

/**
 * FirefoxUserAgentHandler
 *
 *
 * @category   WURFL
 * @package    WURFL_Handlers
 * @copyright  ScientiaMobile, Inc.
 * @license    GNU Affero General Public License
 * @version    SVN: $Id$
 */
class Seamonkey extends Firefox
{
    /**
     * @var string the detected browser
     */
    protected $_browser = 'SeaMonkey';

    /**
     * @var string the detected manufacturer
     */
    protected $_manufacturer = 'Mozilla';
    
    /**
     * Returns true if this handler can handle the given user agent
     *
     * @return bool
     */
    public function canHandle()
    {
        if ('' == $this->_useragent) {
            return false;
        }
        
        if ($this->_utils->isMobileBrowser($this->_useragent)) {
            return false;
        }
        
        if ($this->_utils->isSpamOrCrawler($this->_useragent)) {
            return false;
        }
        
        if (!$this->_utils->checkIfStartsWith('Mozilla/')) {
            return false;
        }
        
        if (!$this->_utils->checkIfContainsAll(array('Gecko', 'SeaMonkey'))
            && !$this->_utils->checkIfContains('Seamonkey')
        ) {
            return false;
        }
        
        $isNotReallyAnFirefox = array(
            'SnapPreviewBot',
            'ScanAlert',
            'spider',
            'Nutch',
            'webaroo',
            'OneRiot',
            // using also the Gecko rendering engine
            'Maemo',
            'Maxthon',
            'Camino',
            'Galeon',
            'Lunascape',
            'Opera',
            'Navigator',
            'PaleMoon',
            'Flock',
            'Fennec'
        );
        
        if ($this->_utils->checkIfContains($isNotReallyAnFirefox)) {
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
        $doMatch = preg_match('/SeaMonkey\/(\d+\.\d+)/', $this->_useragent, $matches);
        
        if ($doMatch) {
            $this->_version = $matches[1];
            return;
        }
        
        $doMatch = preg_match('/Seamonkey\/(\d+\.\d+)/', $this->_useragent, $matches);
        
        if ($doMatch) {
            $this->_version = $matches[1];
            return;
        }
        
        $this->_version = '';
    }
    
    /**
     * gets the weight of the handler, which is used for sorting
     *
     * @return integer
     */
    public function getWeight()
    {
        return 38;
    }
    
    /**
     * returns TRUE if the browser has a specific rendering engine
     *
     * @return boolean
     */
    public function hasEngine()
    {
        return true;
    }
    
    /**
     * returns null, if the browser does not have a specific rendering engine
     * returns the Engine Handler otherwise
     *
     * @return null|\Browscap\Os\Handler
     */
    public function getEngine()
    {
        $handler = new \Browscap\Engine\Handlers\Gecko();
        $handler->setLogger($this->_logger);
        $handler->setUseragent($this->_useragent);
        
        return $handler->detect();
    }
}