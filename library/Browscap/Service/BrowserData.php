<?php
declare(ENCODING = 'utf-8');
namespace Browscap\Service;

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Model
 *
 * PHP version 5
 *
 * @category  CreditCalc
 * @package   Models
 * @author    Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @copyright 2007-2010 Unister GmbH
 * @version   SVN: $Id$
 */

/**
 * Model
 *
 * @category  CreditCalc
 * @package   Models
 * @author    Thomas Mueller <t_mueller_stolzenhain@yahoo.de>
 * @copyright 2007-2010 Unister GmbH
 */
class BrowserData extends ServiceAbstract
{
    /**
     * Class Constructor
     *
     * @return \App\Service\BrowserData
     */
    public function __construct()
    {
        $this->_model = new \Browscap\Model\BrowserData();
    }

    /**
     * Loads a row from the database and binds the fields to the object
     * properties
     *
     * @param mixed $browser (Optional) the browsers short name e.g. 'IE'
     *
     * @return boolean True if successful
     * @access public
     */
    public function searchByBrowser(
        $browser = null, $version = 0, $bits = null)
    {
        return $this->_model->getCached('browserdata')->searchByBrowser(
            $browser, $version, $bits
        );
    }
    
    public function count($idBrowsers)
    {
        return $this->_model->count($idBrowsers);
    }
    
    public function countByName($browserName, $browserVersion = 0.0, $bits = 0, array $data)
    {
        return $this->_model->countByName($browserName, $browserVersion, $bits, $data);
    }
    
    public function getAll()
    {
        return $this->_model->getCached('browserdata')->getAll();
    }

    /**
     * cleans the model cache
     *
     * calls the {@link _cleanCache} function with defined tag name
     *
     * @return \App\Service\Browsers
     */
    public function cleanCache()
    {
        return $this->cleanTaggedCache('browserdata');
    }
}

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * c-hanging-comment-ender-p: nil
 * End:
 */