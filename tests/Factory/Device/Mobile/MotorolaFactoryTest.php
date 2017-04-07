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
namespace BrowserDetectorTest\Factory\Device\Mobile;

use BrowserDetector\Factory\Device\Mobile\MotorolaFactory;
use BrowserDetector\Loader\DeviceLoader;
use Cache\Adapter\Filesystem\FilesystemCachePool;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Stringy\Stringy;

/**
 * Test class for \BrowserDetector\Detector\Device\Mobile\GeneralMobile
 */
class MotorolaFactoryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var \BrowserDetector\Factory\Device\Mobile\MotorolaFactory
     */
    private $object = null;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $adapter      = new Local(__DIR__ . '/../../../../cache/');
        $cache        = new FilesystemCachePool(new Filesystem($adapter));
        $loader       = new DeviceLoader($cache);
        $this->object = new MotorolaFactory($loader);
    }

    /**
     * @dataProvider providerDetect
     *
     * @param string $agent
     * @param string $deviceName
     * @param string $marketingName
     * @param string $manufacturer
     * @param string $brand
     * @param string $deviceType
     * @param bool   $dualOrientation
     * @param string $pointingMethod
     */
    public function testDetect($agent, $deviceName, $marketingName, $manufacturer, $brand, $deviceType, $dualOrientation, $pointingMethod)
    {
        $s = new Stringy($agent);

        /** @var \UaResult\Device\DeviceInterface $result */
        list($result) = $this->object->detect($agent, $s);

        self::assertInstanceOf('\UaResult\Device\DeviceInterface', $result);

        self::assertSame(
            $deviceName,
            $result->getDeviceName(),
            'Expected device name to be "' . $deviceName . '" (was "' . $result->getDeviceName() . '")'
        );
        self::assertSame(
            $marketingName,
            $result->getMarketingName(),
            'Expected marketing name to be "' . $marketingName . '" (was "' . $result->getMarketingName() . '")'
        );
        self::assertSame(
            $manufacturer,
            $result->getManufacturer()->getName(),
            'Expected manufacturer name to be "' . $manufacturer . '" (was "' . $result->getManufacturer()->getName() . '")'
        );
        self::assertSame(
            $brand,
            $result->getBrand()->getBrandName(),
            'Expected brand name to be "' . $brand . '" (was "' . $result->getBrand()->getBrandName() . '")'
        );
        self::assertSame(
            $deviceType,
            $result->getType()->getName(),
            'Expected device type to be "' . $deviceType . '" (was "' . $result->getType()->getName() . '")'
        );
        self::assertSame(
            $dualOrientation,
            $result->getDualOrientation(),
            'Expected dual orientation to be "' . $dualOrientation . '" (was "' . $result->getDualOrientation() . '")'
        );
        self::assertSame(
            $pointingMethod,
            $result->getPointingMethod(),
            'Expected pointing method to be "' . $pointingMethod . '" (was "' . $result->getPointingMethod() . '")'
        );
    }

    /**
     * @return array[]
     */
    public function providerDetect()
    {
        return [
            [
                'this is a fake ua to trigger the fallback',
                'general Motorola Device',
                'general Motorola Device',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                false,
                'touchscreen',
            ],
            [
                'Mozilla/4.0 (compatible; MSIE 6.0; Windows CE; IEMobile 7.11) Sprint:MotoQ9c',
                'Q9c',
                'Q9c',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'MOT-E1000/80.28.08I MIB/2.2.1 Profile/MIDP-2.0 Configuration/CLDC-1.1',
                'E1000',
                'E1000',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                false,
                'touchscreen',
            ],
            [
                'MOT-L7/08.D5.09R MIB/2.2.1 Profile/MIDP-2.0 Configuration/CLDC-1.1',
                'SLVR L7',
                'SLVR L7',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                false,
                null,
            ],
            [
                'UCWEB/2.0 (Linux; U; Opera Mini/7.1.32052/30.3697; en-US; XT389 Build/0C.03.05R_S) U2/1.0.0 UCBrowser/10.7.2.757 Mobile',
                'XT389',
                'Motoluxe XT389',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'MOT-V3i/08.B4.34R MIB/2.2.1 Profile/MIDP-2.0 Configuration/CLDC-1.1 UP.Link/6.3.0.0.0',
                'RAZR V3i',
                'RAZR V3i',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                false,
                null,
            ],
            [
                'Mozilla/5.0 (Linux; Android 5.0.2; XT1068 Build/LXB22.46-28) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.89 Mobile Safari/537.36',
                'XT1068',
                'Moto G Dual SIM (2nd gen)',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 5.1.1; MotoG3 Build/LPI23.72-47.4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Mobile Safari/537.36',
                'MotoG3',
                'Moto G (3rd gen)',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 5.1; XT1039 Build/LPBS23.13-17.3-1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Mobile Safari/537.36',
                'XT1039',
                'Moto G 4G',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 5.0.2; Nexus 6 Build/LRX22G) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2272.63 Mobile Safari/537.36',
                'Nexus 6',
                'Nexus 6',
                'Motorola',
                'Google',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 5.0.2; XT1032 Build/LXB22.46-28.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Mobile Safari/537.36',
                'XT1032',
                'Moto G',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 2.2.2; ru-ru; MB612 Build/KRNS-X4-1.1.10) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
                'MB612',
                'XPRT (CDMA)',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.4.4; XT1080 Build/SU5-24) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.59 Mobile Safari/537.36',
                'XT1080',
                'Droid Ultra',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 5.1; XT1021 Build/LPCS23.13-34.8-3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.94 Mobile Safari/537.36',
                'XT1021',
                'Moto E',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.4.4; XT1058 Build/KXA21.12-L1.26) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.114 Mobile Safari/537.36',
                'XT1058',
                'Moto X',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.4.2; XT1052 Build/KLA20.16-2.16.2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.59 Mobile Safari/537.36',
                'XT1052',
                'Moto X',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.4.4; XT1033 Build/KXB21.14-L1.40) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.59 Mobile Safari/537.36',
                'XT1033',
                'Moto G',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.3; ru-ru; XT926 Build/JLS36G) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30 CyanogenMod/10.2/xt926',
                'XT926',
                'Droid Razr HD (Verizon)',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.1.2; XT925 Build/9.8.2Q-8-XT925_VQUL-1601) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.83 Mobile Safari/537.36',
                'XT925',
                'XT925',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 5.1.1; DROID RAZR HD Build/LMY47V) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.109 Mobile Safari/537.36',
                'XT923',
                'Droid Razr HD',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.1.2; de-de; XT910 Build/9.8.2O-124_SPUEM-14) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',
                'XT910',
                'RAZR XT910 Spider',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.4.2; XT907 Build/KDA20.62-15.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.117 Mobile Safari/537.36',
                'XT907',
                'DROID RAZR M 4G LTE',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.1.2; XT890 Build/9.8.2I-50_SMI-26) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/39.0.2171.59 Mobile Safari/537.36 OPR/26.0.1656.87080',
                'XT890',
                'RAZR i',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.0.4; en-us; DROID BIONIC 4G Build/6.7.2-223_DBN_M4-23) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',
                'XT875',
                'Droid Bionic 4G LTE',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 2.3.7; de-de; MOT-XT615 Build/V1.48C) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
                'XT615',
                'XT615',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 2.3.6; pt-pt; XT320 Build/GRK39F) AppleWebKit/533.1 (KHTML, like Gecko) Vers\\xe3o/4.0 Mobile Safari/533.1',
                'XT320',
                'Defy Mini',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'MOT-XT311/Mozilla/5.0 (Linux; U; Android 2.3.4; de-de; XT311 Build/V4.36M) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
                'XT311',
                'XT311',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.1.1; de-de; Xoom Build/JRO03L) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30',
                'Xoom',
                'Xoom',
                'Motorola',
                'Motorola',
                'Tablet',
                true,
                'touchscreen',
            ],
            [
                'Mot-WX308/v3 BTSTLE_G_0A.22.08RPS Release/10.11.2011 Browser/Opera Profile/MIDP-2.0 Configuration/CLDC-1.1 Sync/SyncClient1.1 Opera/9.80 (MTK; Nucleus; Opera Mobi/4000; U; de-DE) Presto/2.5.28 Version/10.10',
                'WX308',
                'Gleam+/WX308',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                false,
                null,
            ],
            [
                'MOT-RAZRV3x/01.2A.01 MIB/BER2.2 Profile/MIDP-2.0 Configuration/CLDC-1.1',
                'RAZRV3x',
                'RAZRV3x',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Dalvik/1.6.0 (Linux; U; Android 4.0.4; XOOM 2 ME Build/7.7.1-128_MZ608-14)',
                'MZ608',
                'Xoom 2 Media Edition 3G',
                'Motorola',
                'Motorola',
                'FonePad',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.0.4; en-gb; XOOM 2 ME Build/7.7.1-128_MZ607-14) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30',
                'MZ607',
                'Xoom 2 Media Edition',
                'Motorola',
                'Motorola',
                'Tablet',
                true,
                'touchscreen',
            ],
            [
                'Dalvik/1.5.1 (Linux; U; Android 3.2.2; XOOM 2 Build/1.6.0_268.6-MZ616)',
                'MZ616',
                'Xoom 2 3G',
                'Motorola',
                'Motorola',
                'FonePad',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.0.4; de-de; XOOM 2 Build/7.7.1-128_MZ615-12) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30',
                'MZ615',
                'Xoom 2',
                'Motorola',
                'Motorola',
                'Tablet',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.0.4; de-de; MZ604 Build/I.7.1-42) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30',
                'MZ604',
                'Xoom',
                'Motorola',
                'Motorola',
                'Tablet',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.0.4; de-de; MZ601 Build/I.7.1-42) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30',
                'MZ601',
                'Xoom',
                'Motorola',
                'Motorola',
                'Tablet',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 2.1-update1; de-de; Milestone Build/SHOLS_U2_02.36.0) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17',
                'Milestone',
                'Milestone',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 2.3.4; en-gb; MB860 Build/4.5.2A-74_OLE-27) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
                'MB860',
                'Atrix',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 2.3.6; de-de; MB632 Build/5.5.1Q-110_ELW-TA-38) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
                'MB632',
                'Pro+',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.4.2; MB526 Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.108 Mobile Safari/537.36',
                'MB526',
                'MB526',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'UCWEB/2.0(Linux; U; Opera Mini/7.1.32052/30.3697; fr-fr; MB525 Build/JRDNEM_U3_2.24.0) U2/1.0.0 UCBrowser/9.5.0.360 Mobile',
                'MB525',
                'DEFY',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 2.1-update1; de-de; MB511 Build/RUTEM_U3_01.14.2) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17',
                'MB511',
                'Ruth',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'UCWEB/2.0 (MIDP-2.0; U; Adr 2.3.7; en-US; MB300) U2/1.0.0 UCBrowser/9.7.0.520 U2/1.0.0 Mobile',
                'MB300',
                'Backflip',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 2.3.5; en-us; DROID X2 Build/4.5.1A-DTN-200-18) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
                'Droid X2',
                'Droid X2',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'YahooMobileMessenger/1.0 (Android Mail; 1.4.0) (cdma_shadow; motorola; DROIDX; 2.3.4/4.5.1_57_DX8-51)',
                'DroidX',
                'DroidX',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.1.2; en-us; DROID RAZR Build/9.8.2O-72_VZW-16) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',
                'Razr',
                'Droid Razr',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.0.4; en-us; DROID BIONIC 4G Build/6.7.2-223_DBN_M4-23) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',
                'XT875',
                'Droid Bionic 4G LTE',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 2.2; en-us; DROID2 Build/VZW) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1 480X854 motorola DROID2,Mozilla/5.0 (Linux; U; Android 2.2; en-us; DROID2 Build/VZW) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1 480X854 motorola DROID2',
                'Droid2',
                'Droid2',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                false,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 2.0.1; en-us; Droid Build/ESD56) AppleWebKit/530.17 (KHTML, like Gecko) Version/4.0 Mobile Safari/530.17',
                'Droid',
                'Droid',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                false,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 2.3.4; de-de; MotoA953 Build/MILS2_U6_4.1-22) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
                'A953',
                'Milestone 2',
                'Motorola',
                'Motorola',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
        ];
    }
}
