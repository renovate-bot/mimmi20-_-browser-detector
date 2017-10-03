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
use BrowserDetector\Loader\ExtendedLoaderInterface;
use Stringy\Stringy;

/**
 * @author Thomas Müller <mimmi20@live.de>
 */
class HuaweiFactory implements Factory\FactoryInterface
{
    /**
     * @var array
     */
    private $devices = [
        'bln-l21'                         => 'huawei bln-l21',
        'bln-al10'                        => 'huawei bln-al10',
        'bln-tl00'                        => 'huawei bln-tl00',
        'bln-tl10'                        => 'huawei bln-tl10',
        'can-l01'                         => 'huawei can-l01',
        'can-l11'                         => 'huawei can-l11',
        'can-l02'                         => 'huawei can-l02',
        'can-l12'                         => 'huawei can-l12',
        'can-l03'                         => 'huawei can-l03',
        'can-l13'                         => 'huawei can-l13',
        'lua-l21'                         => 'huawei lua-l21',
        'gra-l09'                         => 'huawei gra-l09',
        'gra-ul00'                        => 'huawei gra-ul00',
        'frd-l14'                         => 'huawei frd-l14',
        'frd-al10'                        => 'huawei frd-al10',
        'frd-al00'                        => 'huawei frd-al00',
        'frd-l19'                         => 'huawei frd-l19',
        'frd-l09'                         => 'huawei frd-l09',
        'frd-tl00'                        => 'huawei frd-tl00',
        'was-lx1a'                        => 'huawei was-lx1a',
        'was-lx1'                         => 'huawei was-lx1',
        'was-lx2j'                        => 'huawei was-lx2j',
        'was-lx2'                         => 'huawei was-lx2',
        'was-lx3'                         => 'huawei was-lx3',
        'was-l03t'                        => 'huawei was-l03t',
        'btv-dl09'                        => 'huawei btv-dl09',
        'btv-w09'                         => 'huawei btv-w09',
        'duk-l09'                         => 'huawei duk-l09',
        'lon-l29'                         => 'huawei lon-l29',
        'plk-l01'                         => 'huawei plk-l01',
        'pra-la1'                         => 'huawei pra-la1',
        'pra-lx1'                         => 'huawei pra-lx1',
        'nem-al10'                        => 'huawei nem-al10',
        'nem-l51'                         => 'huawei nem-l51',
        'nem-l22'                         => 'huawei nem-l22',
        'nem-l21'                         => 'huawei nem-l21',
        'vtr-l09'                         => 'huawei vtr-l09',
        'vtr-al00'                        => 'huawei vtr-al00',
        'vtr-tl00'                        => 'huawei vtr-tl00',
        'vtr-l29'                         => 'huawei vtr-l29',
        'che2-l11'                        => 'huawei che2-l11',
        'cam-l21'                         => 'huawei cam-l21',
        'mha-al00'                        => 'huawei mha-al00',
        'mha-l29'                         => 'huawei mha-l29',
        'mha-l09'                         => 'huawei mha-l09',
        'h60-l01'                         => 'huawei h60-l01',
        'h60-l02'                         => 'huawei h60-l02',
        'h60-l04'                         => 'huawei h60-l04',
        'h60-l12'                         => 'huawei h60-l12',
        'nexus 6p'                        => 'huawei nexus 6p',
        'tag-al00'                        => 'huawei tag-al00',
        'tag-l21'                         => 'huawei tag-l21',
        'tag-l01'                         => 'huawei tag-l01',
        'ale-ul00'                        => 'huawei ale-ul00',
        'ale-cl00'                        => 'huawei ale-cl00',
        'ale-21'                          => 'huawei ale-l21',
        'ale-l23'                         => 'huawei ale-l23',
        'ale-l21'                         => 'huawei ale-l21',
        'ale-l02'                         => 'huawei ale-l02',
        'grace'                           => 'huawei grace',
        'p7-l10'                          => 'huawei p7-l10',
        'p7-l09'                          => 'huawei p7-l09',
        'p7 mini'                         => 'huawei p7 mini',
        'p7mini'                          => 'huawei p7 mini',
        'p2-6011'                         => 'huawei p2-6011',
        'eva-l19'                         => 'huawei eva-l19',
        'eva-l09'                         => 'huawei eva-l09',
        'scl-l01'                         => 'huawei scl-l01',
        'scl-l21'                         => 'huawei scl-l21',
        'scl-u31'                         => 'huawei scl-u31',
        'nxt-l29'                         => 'huawei nxt-l29',
        'nxt-al10'                        => 'huawei nxt-al10',
        'gem-703lt'                       => 'huawei gem-703lt',
        'gem-703l'                        => 'huawei gem-703l',
        'gem-702l'                        => 'huawei gem-702l',
        'gem-701l'                        => 'huawei gem-701l',
        'g630-u251'                       => 'huawei g630-u251',
        'g630-u20'                        => 'huawei g630-u20',
        'g630-u10'                        => 'huawei g630-u10',
        'g620s-l01'                       => 'huawei g620s-l01',
        'g610-u20'                        => 'huawei g610-u20',
        'g606-t00'                        => 'huawei g606-t00',
        'g7-l11'                          => 'huawei g7-l11',
        'g7-l01'                          => 'huawei g7-l01',
        'g6-l11'                          => 'huawei g6-l11',
        'g6-u10'                          => 'huawei g6-u10',
        'pe-tl10'                         => 'huawei pe-tl10',
        'rio-l01'                         => 'huawei rio-l01',
        'cun-l21'                         => 'huawei cun-l21',
        'cun-l03'                         => 'huawei cun-l03',
        'cun-l01'                         => 'huawei cun-l01',
        'crr-l09'                         => 'huawei crr-l09',
        'chc-u23'                         => 'huawei chc-u23',
        'chc-u03'                         => 'huawei chc-u03',
        'chc-u01'                         => 'huawei chc-u01',
        'g750-u10'                        => 'huawei g750-u10',
        'g750-t00'                        => 'huawei g750-t00',
        'g740-l00'                        => 'huawei g740-l00',
        'g730-u27'                        => 'huawei g730-u27',
        'g730-u10'                        => 'huawei g730-u10',
        'vns-l31'                         => 'huawei vns-l31',
        'vns-l22'                         => 'huawei vns-l22',
        'vns-l21'                         => 'huawei vns-l21',
        'tit-u02'                         => 'huawei tit-u02',
        'y635-l21'                        => 'huawei y635-l21',
        'y625-u51'                        => 'huawei y625-u51',
        'y625-u21'                        => 'huawei y625-u21',
        'y600-u151'                       => 'huawei y600-u151',
        'y600-u20'                        => 'huawei y600-u20',
        'y600-u00'                        => 'huawei y600-u00',
        'y560-l01'                        => 'huawei y560-l01',
        'y550-l01'                        => 'huawei y550-l01',
        'y540-u01'                        => 'huawei y540-u01',
        'y530-u00'                        => 'huawei y530-u00',
        'y511'                            => 'huawei y511',
        'y360-u61'                        => 'huawei y360-u61',
        'y360-u31'                        => 'huawei y360-u31',
        'y340-u081'                       => 'huawei y340-u081',
        'y336-u02'                        => 'huawei y336-u02',
        'y330-u11'                        => 'huawei y330-u11',
        'y330-u05'                        => 'huawei y330-u05',
        'y330-u01'                        => 'huawei y330-u01',
        'y320-u30'                        => 'huawei y320-u30',
        'y320-u10'                        => 'huawei y320-u10',
        'y300'                            => 'huawei y300',
        'y220-u10'                        => 'huawei y220-u10',
        'y210-0100'                       => 'huawei y210-0100',
        'w2-u00'                          => 'huawei w2-u00',
        'w1-u00'                          => 'huawei w1-u00',
        'h30-u10'                         => 'huawei h30-u10',
        'kiw-l21'                         => 'huawei kiw-l21',
        'lyo-l21'                         => 'huawei lyo-l21',
        'vodafone 858'                    => 'huawei vodafone 858',
        'vodafone 845'                    => 'huawei vodafone 845',
        'u9510e'                          => 'huawei u9510e',
        'u9510'                           => 'huawei u9510',
        'u9508'                           => 'huawei u9508',
        'u9200'                           => 'huawei u9200',
        'u8950n-1'                        => 'huawei u8950n-1',
        'u8950n'                          => 'huawei u8950n',
        'u8950d'                          => 'huawei u8950d',
        'u8950-1'                         => 'huawei u8950-1',
        'u8950'                           => 'huawei u8950',
        'u8860'                           => 'huawei u8860',
        'u8850'                           => 'huawei u8850',
        'u8825'                           => 'huawei u8825',
        'u8815'                           => 'huawei u8815',
        'u8800'                           => 'huawei u8800',
        'huawei u8666 build/huaweiu8666e' => 'huawei u8666',
        'u8666e'                          => 'huawei u8666e',
        'u8666'                           => 'huawei u8666',
        'u8655'                           => 'huawei u8655',
        'huawei-u8651t'                   => 'huawei u8651t',
        'huawei-u8651s'                   => 'huawei u8651s',
        'huawei-u8651'                    => 'huawei u8651',
        'u8650'                           => 'huawei u8650',
        'u8600'                           => 'huawei u8600',
        'u8520'                           => 'huawei u8520',
        'u8510'                           => 'huawei s41hw',
        'u8500'                           => 'huawei u8500',
        'u8350'                           => 'huawei u8350',
        'u8185'                           => 'huawei u8185',
        'u8180'                           => 'huawei u8180',
        'u8110'                           => 'huawei u8110',
        'tsp21'                           => 'huawei u8110',
        'u8100'                           => 'huawei u8100',
        'u7510'                           => 'huawei u7510',
        's8600'                           => 'huawei s8600',
        'p6-u06'                          => 'huawei p6-u06',
        'p6 s-u06'                        => 'huawei p6 s-u06',
        ' p6 '                            => 'huawei p6',
        'mt7-cl00'                        => 'huawei mt7-cl00',
        'mt7-tl10'                        => 'huawei mt7-tl10',
        'mt7-l09'                         => 'huawei mt7-l09',
        'jazz'                            => 'huawei mt7-l09',
        'mt2-l01'                         => 'huawei mt2-l01',
        'mt1-u06'                         => 'huawei mt1-u06',
        's8-701w'                         => 'huawei s8-701w',
        't1-701u'                         => 'huawei t1-701u',
        't1 7.0'                          => 'huawei t1-701u',
        't1-a21l'                         => 'huawei t1-a21l',
        't1-a21w'                         => 'huawei t1-a21w',
        'm2-a01l'                         => 'huawei m2-a01l',
        'fdr-a01l'                        => 'huawei fdr-a01l',
        'fdr-a01w'                        => 'huawei fdr-a01w',
        'm2-a01w'                         => 'huawei m2-a01w',
        'm2-801w'                         => 'huawei m2-801w',
        'm2-801l'                         => 'huawei m2-801l',
        'ath-al00'                        => 'huawei ath-al00',
        'ath-ul01'                        => 'huawei ath-ul01',
        'mediapad x1 7.0'                 => 'huawei mediapad x1 7.0',
        'mediapad t1 10 4g'               => 'huawei mediapad t1 10 4g',
        'mediapad t1 8.0'                 => 'huawei s8-701u',
        'mediapad m1 8.0'                 => 'huawei mediapad m1 8.0',
        'mediapad 10 link+'               => 'huawei mediapad 10+',
        'mediapad 10 fhd'                 => 'huawei mediapad 10 fhd',
        'mediapad 7 lite'                 => 'huawei mediapad 7 lite',
        'mediapad 7 classic'              => 'huawei mediapad 7 classic',
        'mediapad 7 youth'                => 'huawei mediapad 7 youth',
        'mediapad'                        => 'huawei s7-301w',
        'm860'                            => 'huawei m860',
        'm635'                            => 'huawei m635',
        'ideos s7 slim'                   => 'huawei s7_slim',
        'ideos s7'                        => 'huawei ideos s7',
        'ideos '                          => 'huawei bm-swu300',
        'g510-0100'                       => 'huawei g510-0100',
        'g7300'                           => 'huawei g7300',
        'g6609'                           => 'huawei g6609',
        'g6600'                           => 'huawei g6600',
        'g700-u10'                        => 'huawei g700-u10',
        'g700-u00'                        => 'huawei g700-u00',
        'g527-u081'                       => 'huawei g527-u081',
        'g525-u00'                        => 'huawei g525-u00',
        'g510'                            => 'huawei g510',
        'hn3-u01'                         => 'huawei hn3-u01',
        'hol-u19'                         => 'huawei hol-u19',
        'vie-l09'                         => 'huawei vie-l09',
        'vie-al10'                        => 'huawei vie-al10',
        'nmo-l31'                         => 'huawei nmo-l31',
        'd2-0082'                         => 'huawei d2-0082',
        'p8max'                           => 'huawei p8max',
        '4afrika'                         => 'huawei 4afrika',
        'g2800'                           => 'huawei g2800',
        't8600'                           => 'huawei t8600',
        'm750'                            => 'huawei m750',
    ];

    /**
     * @var \BrowserDetector\Loader\ExtendedLoaderInterface
     */
    private $loader;

    /**
     * @param \BrowserDetector\Loader\ExtendedLoaderInterface $loader
     */
    public function __construct(ExtendedLoaderInterface $loader)
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
    public function detect(string $useragent, Stringy $s): array
    {
        foreach ($this->devices as $search => $key) {
            if ($s->contains($search, false)) {
                return $this->loader->load($key, $useragent);
            }
        }

        return $this->loader->load('general huawei device', $useragent);
    }
}
