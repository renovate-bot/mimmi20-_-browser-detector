<?php
/**
 * This file is part of the browser-detector package.
 *
 * Copyright (c) 2012-2018, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);
namespace BrowserDetectorTest\Helper;

use BrowserDetector\Helper\Desktop;
use PHPUnit\Framework\TestCase;
use Stringy\Stringy;

class DesktopTest extends TestCase
{
    /**
     * @dataProvider providerIsDesktop
     *
     * @param string $agent
     *
     * @return void
     */
    public function testIsDesktop(string $agent): void
    {
        $object = new Desktop(new Stringy($agent));

        self::assertTrue($object->isDesktopDevice());
    }

    /**
     * @return array[]
     */
    public function providerIsDesktop(): array
    {
        return [
            ['Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) MxNitro/1.0.0.2000 Chrome/35.0.1849.0 Safari/537.36'],
            ['CybEye.com/2.0 (compatible; MSIE 9.0; Windows NT 5.1; Trident/4.0; GTB6.4)'],
            ['revolt'],
            ['Microsoft Office Excel 2013'],
            ['iTunes/11.3.1 (Windows; Microsoft Windows 7 x64 Home Premium Edition Service Pack 1 (Build 7601)) AppleWebKit/537.60.17'],
            ['Mozilla/5.0 (X11; BSD Four) AppleWebKit/534.34 (KHTML, like Gecko) wkhtmltoimage Safari/534.34'],
            ['Microsoft Office Word 2013 (15.0.4693) Windows NT 6.2'],
            ['Microsoft Outlook Social Connector (15.0.4569) MsoStatic (15.0.4569)'],
            ['MSFrontPage/15.0'],
            ['Mozilla/2.0 (compatible; MS FrontPage 5.0)'],
            ['Mozilla/5.0 Gecko/20030306 Camino/0.7'],
            ['UCS (ESX) - 4.0-3 errata302 - 28d414cc-2dac-4c0e-a34a-734020b8af66 - 00000000-0000-0000-0000-000000000000 -'],
            ['TinyBrowser/2.0 (TinyBrowser Comment; rv:1.9.1a2pre) Gecko/20201231'],
            ['Apple-PubSub/65.28'],
            ['gvfs/1.4.3'],
            ['Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.8.1.9) Gecko/20071025 FreeBSD/i386 Firefox/2.0.0.9'],
            ['Mozilla/5.0 (X11; U; OSF1 alpha; en-US; rv:1.7.5) Gecko/20050112 Firefox/1.0'],
            ['Mozilla/5.0 (Windows NT 5.2) AppleWebKit/5342 (KHTML, like Gecko) Chrome/36.0.873.0 Mobile Safari/5342'],
            ['Opera/9.80 (Windows NT 6.0; Opera Mobi/49; U; en) Presto/2.4.18 Version/10.00'],
            ['Mozilla/5.0 (X11; NetBSD amd64; rv:43.0) Gecko/20100101 Firefox/43.0'],
            ['Mozilla/5.0 (X11; U; SunOS sun4u; pl-PL; rv:1.8.1.6) Gecko/20071217 Firefox/2.0.0.6'],
            ['Mozilla/5.0 (Windows; U; Windows NT 5.1; fr; rv:1.9.2.13) Gecko/20101203 iPhone'],
            ['BarcaPro/1.4.12'],
            ['Barca/2.8.2'],
            ['The Bat! 4.0.0.22'],
            ['Mozilla/5.0 (Windows NT 10.0; WOW64; Trident/7.0; Touch; tb-webde/2.6.9; MASEJS; rv:11.0) like Gecko'],
            ['Mozilla/5.0 (X11; BSD Four) AppleWebKit/534.34 (KHTML, like Gecko) wkhtmltoimage Safari/534.34'],
            ['Opera/9.80 (X11; Linux i686; Edition Linux Mint) Presto/2.12.388 Version/12.16'],
            ['Mozilla/5.0 (X11; U; Linux i686; pl-PL; rv:1.9.2a1pre) Gecko/20090330 Kubuntu/8.10 (intrepid) Minefield/3.2a1pre'],
            ['curl/7.15.5 (x86_64-redhat-linux-gnu) libcurl/7.15.5 OpenSSL/0.9.8b zlib/1.2.3 libidn/0.6.5'],
            ['OMozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.2.9) Gecko/20100827 Red Hat/3.6.9-2.el6 Firefox/3.6.9'],
            ['Mozilla/5.0 (X11; U; Linux i686; en-GB; rv:1.8.0.5) Gecko/20060805 CentOS/1.0.3-0.el4.1.centos4 SeaMonkey/1.0.3'],
            ['Mozilla/5.0 (X11; CrOS x86_64 14.4.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2558.0 Safari/537.36'],
            ['Mozilla/5.0 (X11; Jolicloud Linux i686) AppleWebKit/537.6 (KHTML, like Gecko) Joli OS/1.2 Chromium/23.0.1240.0 Chrome/23.0.1240.0 Safari/537.6'],
            ['Mozilla/5.0 (X11; U; Linux x86_64; en-US; rv:1.9.0.7) Gecko/2009031120 Mandriva/1.9.0.7-0.1mdv2009.0 (2009.0) Firefox/3.0.7'],
            ['Mozilla/5.0 (X11; U; Linux i686; de; rv:1.9.0.14) Gecko/2009090900 SUSE/3.0.14-0.1 Firefox/3.0.14'],
            ['Mozilla/5.0 (X11; U; Linux i686; en; rv:1.9) Gecko/20080528 (Gentoo) Epiphany/2.22 Firefox/3.0'],
            ['Mozilla/5.0 (X11; Linux i686) AppleWebKit/534.30 (KHTML, like Gecko) Slackware/Chrome/12.0.742.100 Safari/534.30'],
            ['Mozilla/5.0 (Linux; U; Linux Ventana; de-de; Transformer TF101G Build/HTJ85B) AppleWebKit/534.13 (KHTML, like Gecko) Chrome/8.0 Safari/534.13'],
            ['Mozilla/5.0 (X11; U; Linux i686; de; rv:1.9.1.1) Gecko/20090725 Moblin/3.5.1-2.5.14.moblin2 Shiretoko/3.5.1'],
            ['QuickTime\\\\xaa.7.0.4 (qtver=7.0.4;cpu=PPC;os=Mac 10.3.9)'],
            ['Mozilla/5.0 (X11; U; HP-UX 9000/785; en-US; rv:1.7) Gecko/20040617'],
            ['Mozilla/5.0 (Windows NT 5.1; rv:) Gecko/20100101 Firefox/ anonymized by Abelssoft 1433017337'],
            ['Mozilla/5.0 (Windows 95; Anonymisiert durch AlMiSoft Browser-Anonymisierer 69351893; Trident/7.0; rv:11.0) like Gecko'],
            ['Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36 SailfishBrowser/Rulz ~LenovoG780'],
            ['Mozilla/5.0 (X11; Windows aarch64 10718.88.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/68.0.3440.118 Safari/537.36 CitrixChromeApp'],
            ['Mozilla/5.0 (X11; CrOS aarch64 11021.19.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.22 Safari/537.36'],
        ];
    }

    /**
     * @dataProvider providerIsNoDesktop
     *
     * @param string $agent
     *
     * @return void
     */
    public function testIsNoDesktop(string $agent): void
    {
        $object = new Desktop(new Stringy($agent));

        self::assertFalse($object->isDesktopDevice());
    }

    /**
     * @return array[]
     */
    public function providerIsNoDesktop(): array
    {
        return [
            ['Mozilla/5.0 (Mobile; ALCATELOneTouch4012X/SVN 01010B; rv:18.1) Gecko/18.1 Firefox/18.1'],
            ['Mozilla/5.0 (PLAYSTATION 3; 2.00)'],
            ['Microsoft Office Protocol Discovery'],
            ['Mozilla/4.0 (compatible; Powermarks/3.5; Windows 95/98/2000/NT)'],
            ['ArchiveTeam ArchiveBot/20141009.02 (wpull 0.1002a1) and not Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.101 Safari/537.36'],
            ['Crowsnest/0.5 (+http://www.crowsnest.tv/)'],
            ['Dorado WAP-Browser/1.0.0'],
            ['DINO762 Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/534.24 (KHTML, like Gecko) Chrome/11.0.696.34 Safari/534.24'],
            ['Mozilla/5.0 (compatible; MSIE 9.0; Windows NT; MarketwireBot +http://www.marketwire.com)'],
            ['Mozilla/5.0 (DTV) AppleWebKit/531.2+ (KHTML, like Gecko) Espial/6.1.15 AQUOSBrowser/2.0 (US01DTV;V;0001;0001)'],
            ['TBD1083 Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/534.24 (KHTML, like Gecko) Chrome/11.0.696.34 Safari/534.24'],
            ['TBDB863 Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/534.24 (KHTML, like Gecko) Chrome/11.0.696.34 Safari/534.24'],
            ['TERRA_101 Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/534.24 (KHTML, like Gecko) Chrome/11.0.696.34 Safari/534.24'],
            ['Mozilla/5.0 (compatible; PAD-bot/9.0; +http://www.descargarprogramagratis.com/)'],
            ['Mozilla/5.0 (Macintosh; Butterfly/1.0; +http://labs.topsy.com/butterfly/) Gecko/2009032608 Firefox/3.0.8'],
            ['Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6 - James BOT - WebCrawler http://cognitiveseo.com/bot.html'],
            ['Mozilla/4.0 (compatible; Win32; WinHttp.WinHttpRequest.5)'],
            ['Mozilla/5.0 (X11; U; Linux Core i7-4980HQ; de; rv:32.0; compatible; Jobboerse.com; http://www.xn--jobbrse-d1a.com) Gecko/20100401 Firefox/24.0'],
            ['Mozilla/5.0 (X11; U; Linux x86_64; ar-SA) AppleWebKit/534.35 (KHTML, like Gecko)  Chrome/11.0.696.65 Safari/534.35 Puffin/3.11546IP'],
            ['Lemon B556'],
            ['LAVA Spark284/MIDP-2.0 Configuration/CLDC-1.1/Screen-240x320'],
            ['Spice QT-75'],
            ['ALCATEL_TRIBE_3075A/1.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 ObigoInternetBrowser/Q05A'],
            ['KKT20/MIDP-2.0 Configuration/CLDC-1.1/Screen-240x320'],
            ['Microsoft-CryptoAPI/6.3'],
            ['Mozilla/5.0 (Mobile; rv:32.0) Gecko/20100101 Firefox/32.0'],
            ['Microsoft Data Access Internet Publishing Provider Protocol Discovery'],
            ['Microsoft Data Access Internet Publishing Provider Cache Manager'],
            ['Microsoft-WebDAV-MiniRedir/6.1.7601'],
            ['Mozilla/5.0 CommonCrawler Node BCRJD3NIBD5D7FSESX5FYPD7DASPLXXTNN3HQFQEM6BOOIQPSUOW42ZHQM2YEA7.O.756TNQIGQC6WQCZW43CC253MBXM7UTLFE2BTSQBYM4OZA6UR.cdn0.common.crawl.zone'],
            ['Microsoft.Outlook.15'],
            ['Microsoft Internet Explorer'],
            ['Mozilla/5.0 (iPhone; CPU iPhone OS 8_0_2 like Mac OS X) (Windows NT 6.1; WOW64) AppleWebKit/600.1.4 (KHTML, like Gecko) Mobile/12A405 MicroMessenger/5.4.2 NetType/WIFI'],
            ['>Forum.WindowsFAQ.ru</a>'],
            ['iPodder/2.1 +http://ipodder.sf.net/'],
            ['TA SEO Crawler v0.1 URLData.pm (smcquaker@tripadvisor.com)'],
            ['Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/538.1 (KHTML, like Gecko) online-versicherungsportal.info Safari/538.1'],
            ['Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/538.1 (KHTML, like Gecko) versicherungssuchmaschine.net Safari/538.1'],
            ['Mozilla/5.0 (X11; Linux aarch64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.84 Safari/537.36 CrKey/1.22.74257'],
            ['WAP Browser-Karbonn K84/1.0.0'],
            ['Mozilla/5.0 (DirectFB; Linux armv7l) AppleWebKit/534.26+ (KHTML, like Gecko) Version/5.0 Safari/534.26+ LG Browser/5.00.00(+mouse+3D+SCREEN+TUNER; LGE; 47LM9600-NA; 06.00.00; 0x00000001;); LG NetCast.TV-2012 0'],
        ];
    }
}