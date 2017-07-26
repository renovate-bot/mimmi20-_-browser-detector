<?php
/**
 * This file is part of the browser-detector package.
 *
 * Copyright (c) 2012-2017, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace BrowserDetector\Factory\Device\Mobile;

use BrowserDetector\Factory;
use BrowserDetector\Loader\LoaderInterface;
use Stringy\Stringy;

/**
 * @category  BrowserDetector
 *
 * @copyright 2012-2017 Thomas Mueller
 * @license   http://www.opensource.org/licenses/MIT MIT License
 */
class AcerFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        'b3-a30'       => 'acer b3-a30',
        'b1-810'       => 'acer b1-810',
        ' s55 '        => 'acer s55',
        'a3-a40'       => 'acer a3-a40',
        'a1-841'       => 'acer a1-841',
        ' t08 '        => 'acer t08',
        ' t07 '        => 'acer t07',
        ' t06 '        => 'acer t06',
        ' t03 '        => 'acer t03',
        'a1-840fhd'    => 'acer a1-840fhd',
        'a1-840'       => 'acer a1-840',
        'e380'         => 'acer e380',
        'v370'         => 'acer v370',
        'stream-s110'  => 'acer stream s110',
        's500'         => 'acer s500',
        'liquid mt'    => 'acer s120',
        'liquid metal' => 'acer s120',
        'z500'         => 'acer z500',
        'z200'         => 'acer z200',
        'z150'         => 'acer z150',
        'liquid'       => 'acer s100',
        'b1-770'       => 'acer b1-770',
        'b1-730hd'     => 'acer b1-730hd',
        'b1-721'       => 'acer b1-721',
        'b1-711'       => 'acer b1-711',
        'b1-710'       => 'acer b1-710',
        'b1-a71'       => 'acer b1-a71',
        'a1-830'       => 'acer a1-830',
        'a1-811'       => 'acer a1-811',
        'a1-810'       => 'acer a1-810',
        'a701'         => 'acer a701',
        'a700'         => 'acer a700',
        'a511'         => 'acer a511',
        'a510'         => 'acer a510',
        'a501'         => 'acer a501',
        'a500'         => 'acer a500',
        'a211'         => 'acer a211',
        'a210'         => 'acer a210',
        'a200'         => 'acer a200',
        'a101c'        => 'acer a101c',
        'a101'         => 'acer a101',
        'a100'         => 'acer a100',
        'a3-a20fhd'    => 'acer a3-a20fhd',
        'a3-a20'       => 'acer a3-a20',
        'a3-a11'       => 'acer a3-a11',
        'a3-a10'       => 'acer a3-a10',
        'g100w'        => 'acer g100w',
        'e320'         => 'acer e320',
        'e310'         => 'acer e310',
        'e140'         => 'acer e140',
        'da241hl'      => 'acer da241hl',
        'allegro'      => 'acer allegro',
        'tm01'         => 'acer tm01',
        'm220'         => 'acer m220',
    ];

    /**
     * @var \BrowserDetector\Loader\LoaderInterface|null
     */
    private $loader = null;

    /**
     * @param \BrowserDetector\Loader\LoaderInterface $loader
     */
    public function __construct(LoaderInterface $loader)
    {
        $this->loader = $loader;
    }

    /**
     * detects the device name from the given user agent
     *
     * @param string           $useragent
     * @param \Stringy\Stringy $s
     *
     * @return array
     */
    public function detect($useragent, Stringy $s = null)
    {
        foreach ($this->devices as $search => $key) {
            if ($s->contains($search, false)) {
                return $this->loader->load($key, $useragent);
            }
        }

        return $this->loader->load('general acer device', $useragent);
    }
}
