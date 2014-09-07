<?php
namespace BrowserDetectorTest\Input;

use BrowserDetector\Detector\Version;
use phpbrowscap\Browscap;

/**
 * Test class for KreditCore_Class_BrowserDetector.
 * Generated by PHPUnit on 2010-09-05 at 22:13:26.
 */
class InputBrowscapTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \BrowserDetector\Input\Browscap
     */
    private $object = null;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new \BrowserDetector\Input\Browscap();
    }

    /**
     * @dataProvider providerGetBrowser
     */
    public function testGetBrowser($agent, $browser, $version, $platform)
    {
        $this->markTestSkipped('not implemented yet');

        $this->object->setLocaleFile('tests/data/full_php_browscap.ini');
        $this->object->setCachePrefix('original_ini_');
        $this->object->setAgent($agent);

        $parser = new Browscap('tests/temp/');

        $this->object->setParser($parser);

        $result = $this->object->getBrowser();

        self::assertInstanceOf('BrowserDetector\Detector\Result', $result);

        self::assertSame($browser, $result->getCapability('mobile_browser', true), 'browser name mismatch');
        self::assertSame($version, $result->getCapability('mobile_browser_version', false)->getVersion(Version::MAJORMINOR), 'browser version mismatch');
        self::assertSame($platform, $result->getCapability('device_os', false), 'platform name mismatch');
    }

    public function providerGetBrowser()
    {
        return array(
            array(
                'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/534.16 (KHTML, like Gecko) Iron/10.0.650.0 Chrome/10.0.650.0 Safari/534.16',
                'Iron', '10.0', 'WinXP'
            ),
            array(
                'Mozilla/5.0 (Windows NT 5.1; rv:5.0) Gecko/20100101 Firefox/5.0 FirePHP/0.5',
                'Firefox', '5.0', 'WinXP'
            ),
            array(
                'Mozilla/5.0 (Windows NT 5.1; rv:5.0) Gecko/20100101 Firefox/5.0',
                'Firefox', '5.0', 'WinXP'
            ),
            array(
                'Mozilla/5.0 (Windows NT 5.1; rv:2.0.1) Gecko/20100101 Firefox/4.0.1 FirePHP/0.5',
                'Firefox', '4.0', 'WinXP'
            ),
            array(
                'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 5.1; Trident/4.0; .NET CLR 1.1.4322; .NET CLR 3.0.4506.2152; .NET CLR 3.5.30729; .NET4.0C; .NET4.0E; .NET CLR 2.0.50727)',
                'Internet Explorer', '7.0', 'WinXP'
            ),
            array(
                'Opera/9.52 (Macintosh; Intel Mac OS X; U; en)',
                'Opera', '9.52', 'MacOSX'
            ),
            array(
                'Mozilla/5.0 (Windows NT 5.1; rv:5.0) Gecko/20100101 Firefox/5.0',
                'Firefox', '5.0', 'WinXP'
            ),
            array(
                'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/534.30 (KHTML, like Gecko) Chrome/12.0.742.122 Safari/534.30',
                'Chrome', '12.0', 'WinXP'
            ),
            array(
                'Jakarta Commons-HttpClient/3.0.1',
                'Jakarta Commons HttpClient', '3.0', null
            ),
            array(
                'check_http/v1.4.15 (nagios-plugins 1.4.15)',
                'Nagios', '1.4', 'unknown'
            ),
            array(
                'Opera/9.80 (Windows NT 6.1; U; en) Presto/2.9.168 Version/11.50',
                'Opera', '11.50', 'Win7'
            ),
            array(
                'Mozilla/5.0 (Windows NT 6.0; rv:6.0) Gecko/20100101 Firefox/6.0',
                'Firefox', '6.0', 'WinVista'
            ),
            array(
                'Mozilla/5.0 (iPad; U; CPU OS 4_2_1 like Mac OS X; de-de) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8C148 Safari/6533.18.5',
                'Safari', '5.0', 'iOS'
            ),
            array(
                'Mozilla/5.0 (compatible; Baiduspider/2.0; +http://www.baidu.com/search/spider.html)',
                'Baiduspider', '2.0', 'unknown'
            ),
            array(
                'Mozilla/5.0 (iPhone; U; CPU iOS 4_3_3 like Mac OS X; de-de) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8J2 Safari/6533.18.5',
                'Safari', '5.0', 'MacOSX'
            ),
            array(
                'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; Win64; x64; Trident/5.0)', 'Internet Explorer',
                '9.0', 'Win7'
            ),
            array(
                'Mozilla/5.0 (Linux; U; Android 2.1-update1; de-de; HTC Dream Build/EPE54B) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17',
                'Android Webkit', '4.0', 'Android'
            ),
            array(
                'Mozilla/5.0 (Linux; U; Android 2.2; de-de; HTC Desire 2.33.161.2 Build/FRF91) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
                'Android Webkit', '4.0', 'Android'
            ),
            array(
                'SonyEricssonW910i/R1FA Browser/NetFront/3.4 Profile/MIDP-2.1 Configuration/CLDC-1.1',
                'NetFront', '3.4', 'JAVA'
            ),
        );
    }
}