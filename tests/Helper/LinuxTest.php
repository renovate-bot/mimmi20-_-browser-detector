<?php

namespace BrowserDetectorTest\Helper;

use BrowserDetector\Helper;

/**
 * Test class for KreditCore_Class_BrowserDetector.
 * Generated by PHPUnit on 2010-09-05 at 22:13:26.
 */
class LinuxTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerIsLinuxPositive
     *
     * @param string $agent
     */
    public function testIsLinuxPositive($agent)
    {
        self::assertTrue((new Helper\Linux($agent))->isLinux());
    }

    public function providerIsLinuxPositive()
    {
        return [
            ['Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/534.34 (KHTML, like Gecko) Qt/4.8.2'],
            ['gvfs'],
            ['amarok/2.8.0 (Phonon/4.8.0; Phonon-VLC/0.8.0) LibVLC/2.2.1'],
            ['UCS (ESX) - 4.0-3 errata302 - 28d414cc-2dac-4c0e-a34a-734020b8af66 - 00000000-0000-0000-0000-000000000000 -'],
            ['TinyBrowser/2.0 (TinyBrowser Comment; rv:1.9.1a2pre) Gecko/20201231'],
            ['gvfs/1.4.3'],
        ];
    }

    /**
     * @dataProvider providerIsLinuxNegative
     *
     * @param string $agent
     */
    public function testIsLinuxNegative($agent)
    {
        self::assertFalse((new Helper\Linux($agent))->isLinux());
    }

    public function providerIsLinuxNegative()
    {
        return [
            ['Mozilla/5.0 (iPad; CPU OS 5_1_1 like Mac OS X) AppleWebKit/534.46 (KHTML, like Gecko) Version/5.1 Mobile/9B206 Safari/7534.48.3'],
            ['revolt'],
            ['Microsoft Office Excel 2013'],
            ['Mozilla/5.0 (compatible; Linux; InfegyAtlas/1.0; en-US; collection@infegy.com)'],
            ['TBD1083 Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/534.24 (KHTML, like Gecko) Chrome/11.0.696.34 Safari/534.24'],
            ['TBDB863 Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/534.24 (KHTML, like Gecko) Chrome/11.0.696.34 Safari/534.24'],
            ['TERRA_101 Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/534.24 (KHTML, like Gecko) Chrome/11.0.696.34 Safari/534.24'],
            ['Microsoft Office Word 2013 (15.0.4693) Windows NT 6.2'],
            ['Microsoft Outlook Social Connector (15.0.4569) MsoStatic (15.0.4569)'],
            ['MSFrontPage/15.0'],
            ['Mozilla/5.0 (X11; U; Linux Core i7-4980HQ; de; rv:32.0; compatible; Jobboerse.com; http://www.xn--jobbrse-d1a.com) Gecko/20100401 Firefox/24.0'],
            ['MSRBOT (http://research.microsoft.com/research/sv/msrbot/)'],
            ['Mozilla/5.0 (X11; U; Linux x86_64; ar-SA) AppleWebKit/534.35 (KHTML, like Gecko)  Chrome/11.0.696.65 Safari/534.35 Puffin/3.11546IP'],
            ['Mozilla/5.0 (X11; U; Linux i686; th-TH@calendar=gregorian) AppleWebKit/534.12 (KHTML, like Gecko) Puffin/1.3.2665MS Safari/534.12'],
            ['Microsoft-CryptoAPI/6.3'],
            ['Mozilla/5.0 (Linux; U; en-us; Velocitymicro/T408) AppleWebKit/530.17(KHTML, like Gecko) Version/4.0Safari/530.17'],
            ['Microsoft Data Access Internet Publishing Provider Protocol Discovery'],
            ['Microsoft Data Access Internet Publishing Provider Cache Manager'],
            ['Microsoft-WebDAV-MiniRedir/6.1.7601'],
            ['Mozilla/5.0 CommonCrawler Node BCRJD3NIBD5D7FSESX5FYPD7DASPLXXTNN3HQFQEM6BOOIQPSUOW42ZHQM2YEA7.O.756TNQIGQC6WQCZW43CC253MBXM7UTLFE2BTSQBYM4OZA6UR.cdn0.common.crawl.zone'],
            ['Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.8.1.9) Gecko/20071025 FreeBSD/i386 Firefox/2.0.0.9'],
        ];
    }
}
