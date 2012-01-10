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
class Agents extends ServiceAbstract
{
    /**
     * Class Constructor
     *
     * @return \App\Service\Agents
     */
    public function __construct()
    {
        $this->_model = new \Browscap\Model\Agents();
    }

    /**
     * Loads a row from the database and binds the fields to the object
     * properties
     *
     * @param mixed $agent (Optional) the browsers short name e.g. 'IE'
     *
     * @return boolean True if successful
     * @access public
     */
    public function searchByAgent($userAgent)
    {
        return $this->_model->getCached('agent')->searchByAgent($userAgent);
    }
    
    public function count($idAgents)
    {
        return $this->_model->count($idAgents);
    }
    
    public function countByAgent($userAgent)
    {
        return $this->_model->countByAgent($userAgent);
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
        return $this->cleanTaggedCache('agent');
    }
}

/*
 * Local variables:
 * tab-width: 4
 * c-basic-offset: 4
 * c-hanging-comment-ender-p: nil
 * End:
 */