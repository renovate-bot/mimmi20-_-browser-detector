<?php

namespace BrowserDetectorTest\Factory\Device\Mobile;

use BrowserDetector\Factory\Device\Mobile\AlcatelFactory;
use BrowserDetector\Loader\DeviceLoader;
use Cache\Adapter\Filesystem\FilesystemCachePool;
use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;

/**
 * Test class for \BrowserDetector\Detector\Device\Mobile\GeneralMobile
 */
class AlcatelFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \BrowserDetector\Factory\Device\Mobile\AlcatelFactory
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
        $this->object = new AlcatelFactory($cache, $loader);
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
        /** @var \UaResult\Device\DeviceInterface $result */
        list($result,) = $this->object->detect($agent);

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
                'ALCATEL_TRIBE_3075A/1.0 Profile/MIDP-2.0 Configuration/CLDC-1.1 ObigoInternetBrowser/Q05A',
                'OT-3075A',
                'One Touch Tribe',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Mobile; OneTouch6015X SVN:01010B MMS:1.1; rv:32.0) Gecko/32.0 Firefox/32.0',
                'OT-6015X',
                'One Touch Fire E',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'UCWEB/2.0 (Linux; U; Opera Mini/7.1.32052/30.3697; en-US; ALCATEL_ONE_TOUCH_5035D) U2/1.0.0 UCBrowser/10.0.0.556 Mobile',
                'OT-5035D',
                'One Touch XPop',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 6.0; 4034D Build/MRA58K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.95 Mobile Safari/537.36',
                'OT-4034D',
                'One Touch Pixi 4',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.2.2; ALCATEL ONE TOUCH 7041D Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 YaBrowser/15.2.2214.3581.00 Mobile Safari/537.36',
                'OT-7041D',
                'One Touch Pop C7',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.2.2; ru-ru; ALCATEL ONE TOUCH 6040D Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.2 Mobile Safari/534.30 ACHEETAHI/2100501074',
                'OT-6040D',
                'One Touch Idol X',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.2.2; ALCATEL ONE TOUCH 6035R Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.102 Mobile Safari/537.36 OPR/25.0.1619.84037',
                'OT-6035R',
                'One Touch Idol S',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.4.4; 5042D Build/KTU84P) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.115 YaBrowser/15.2.2214.3725.00 Mobile Safari/537.36',
                'OT-5042D',
                'One Touch Pop 2',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.1.1; en-gb; ALCATEL ONE TOUCH 4030D Build/JRO03C) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.1 Mobile Safari/534.30',
                'OT-4030D',
                'S-POP',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.1.1; en-gb; ALCATEL ONE TOUCH 4030X Build/JRO03C) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.1 Mobile Safari/534.30',
                'OT-4030X',
                'One Touch 4030X',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Mobile; ALCATELOneTouch4012X/SVN 01014G; rv:18.1) Gecko/18.1 Firefox/18.1',
                'OT-4012X',
                'One Touch Fire',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.1.1; de-de; ALCATEL ONE TOUCH 5020D Build/JRO03C) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.1 Mobile Safari/534.30',
                'OT-5020D',
                'One Touch MPop',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'LIAuthLibrary:0.0.2 com.linkedin.android:3.4.2 TCL_ALCATEL ONE TOUCH 4037T:android_4.4.2',
                'OT-4037T',
                'One Touch Evolve II Black',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.2.2; ALCATEL ONE TOUCH P310X Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.59 Safari/537.36',
                'OT-P310X',
                'One Touch Pop7 WiFi 3G',
                'Alcatel',
                'Alcatel',
                'FonePad',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.2.2; ALCATEL ONE TOUCH P320X Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.59 Safari/537.36',
                'OT-P320X',
                'One Touch POP 8 3G',
                'Alcatel',
                'Alcatel',
                'FonePad',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.0.4; de-de; ALCATEL_one_touch_995 Build/IceCreamSandwich) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',
                'OT-995',
                'One Touch 995',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 2.3.6; de-de; ALCATEL ONE TOUCH 991T Build/GRJ90) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
                'OT-991T',
                'One Touch 991T Play',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 2.3.6; de-de; ALCATEL ONE TOUCH 991D Build/GRJ90) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
                'OT-991D',
                'One Touch 991 Play',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 2.3.6; de-de; ALCATEL ONE TOUCH 991 Build/GRJ90) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
                'OT-991',
                'One Touch 991',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 2.3.6; de-de; ALCATEL ONE TOUCH 903D Build/GRK39F) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
                'OT-903D',
                'One Touch 903D',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.1.1; de-de; ALCATEL ONE TOUCH 6010D Build/JRO03C) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.1 Mobile Safari/534.30',
                'OT-6010D',
                'One Touch Star',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'UCWEB/2.0 (Java; U; MIDP-2.0; fr-FR; ALCATEL_one_touch_818) U2/1.0.0 UCBrowser/9.5.0.449 U2/1.0.0 Mobile UNTRUSTED/1.0',
                'OT-818',
                'One Touch 818',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.2.1; ALCATEL ONE TOUCH 7025D Build/JOP40D) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.58 Mobile Safari/537.31',
                'OT-7025D',
                'One Touch 7025D',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.2.2; ru-ru; ALCATEL ONE TOUCH 7047D Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.2 Mobile Safari/534.30',
                'OT-7047D',
                'One Touch Pop C9',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.1.1; de-de; ALCATEL ONE TOUCH 6030X Build/JRO03C) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.1 Mobile Safari/534.30',
                'OT-6030X',
                'One Touch Idol',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.1.1; de-de; ALCATEL ONE TOUCH 6030D Build/JRO03C) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.1 Mobile Safari/534.30',
                'OT-6030D',
                'One Touch Idol',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.1.1; ONE TOUCH TAB 7HD Build/SDT016) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166  Safari/535.19',
                'OT-TAB7HD',
                'One Touch Tab 7 HD',
                'Alcatel',
                'Alcatel',
                'Tablet',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.1.1; ru-; ALCATEL ONE TOUCH 5035D Build/JRO03C) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.1 Mobile Safari/534.30 bdbrowser_i18n/4.5.0.6',
                'OT-5035D',
                'One Touch XPop',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.1.1; ru; ALCATEL ONE TOUCH 6010X Build/JRO03C) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 UCBrowser/9.9.2.467 U3/0.8.0 Mobile Safari/534.30',
                'OT-6010X',
                'One Touch Star',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.2.2; ALCATEL ONE TOUCH Fierce Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/36.0.1985.131 Mobile Safari/537.36',
                'Fierce',
                'One Touch Fierce',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0(Linux;Android 4.4.2; en-ca; ALCATEL ONETOUCH 6050A Build/KVT49L)AppleWebKit/537.36(KHTML,like Gecko) Version/4.0 Chrome/30.0.1599.36 Mobile Safari/537.36',
                'OT-6050A',
                'One Touch Idol 2S',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.2.2; ALCATEL ONE TOUCH 7041X Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.89 Mobile Safari/537.36',
                'OT-7041X',
                'One Touch Pop C7',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.2.2; ALCATEL ONE TOUCH 5036D Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.89 Mobile Safari/537.36',
                'OT-5036D',
                'One Touch Pop C5',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.2.2; de-de; ONE TOUCH 4015D Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.2 Mobile Safari/534.30',
                'OT-4015D',
                'One Touch POP C1',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.1.1; ALCATEL ONE TOUCH 997D Build/JRO03C) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.89 Mobile Safari/537.36',
                'OT-997D',
                'One Touch 997D',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.2.1; de-de; ALCATEL ONE TOUCH 8008D Build/JOP40D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.2 Mobile Safari/534.30',
                'OT-8008D',
                'One Touch Scribe HD',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Mobile; ALCATELOneTouch6015X SVN:01004B MMS:1.1; rv:28.0) Gecko/28.0 Firefox/28.0',
                'OT-6015X',
                'One Touch Fire E',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 2.3.6; de-de; ALCATEL ONE TOUCH 985D Build/GRK39F) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
                'OT-985D',
                'OT-985D',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 2.3.6; de-de; ALCATEL ONE TOUCH 980 Build/GRK39F) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
                'OT-980',
                'OT-980',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.2.2; ONE TOUCH 4015X Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/34.0.1847.114 Mobile Safari/537.36',
                'OT-4015X',
                'One Touch POP C1',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.2.2; ALCATEL ONETOUCH P310A Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.89 Safari/537.36',
                'OT-P310A',
                'One Touch Pop7 WiFi 3G',
                'Alcatel',
                'Alcatel',
                'FonePad',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.3; 6036Y Build/JLS36C) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.89 Mobile Safari/537.36',
                'OT-6036Y',
                'One Touch Idol 2 Mini S',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.1.1; ALCATEL ONE TOUCH 6033X Build/JRO03C) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.89 Mobile Safari/537.36',
                'OT-6033X',
                'One Touch Idol Ultra',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Mobile; ALCATEL ONE TOUCH 4012A; rv:18.1) Gecko/18.1 Firefox/18.1',
                'OT-4012A',
                'One Touch Fire',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.0.4; de-de; ALCATEL ONE TOUCH 992D Build/IMM76D) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',
                'OT-992D',
                'One Touch 992 Play',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.1.2; de-de; ALCATEL ONE TOUCH 8000D Build/JZO54K) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',
                'OT-8000D',
                'OT-8000D',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.4.2; Alcatel 6043D Build/KOT49H) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/30.0.0.0 Mobile Safari/537.36 ACHEETAHI/2100502020',
                'OT-6043D',
                'OT-6043D',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 5.1; Alcatel_7049D Build/LMY47D) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Mobile Safari/537.36',
                'OT-7049D',
                'OT-7049D',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.1.1; ONE TOUCH TAB 8HD Build/JRO03H) AppleWebKit/535.19 (KHTML, like Gecko) Chrome/18.0.1025.166  Safari/535.19',
                'OT-TAB8HD',
                'One Touch Tab 8 HD',
                'Alcatel',
                'Alcatel',
                'Tablet',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.2.2; ALCATEL ONE TOUCH 6034R Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Mobile Safari/537.36',
                'OT-6034R',
                'OT-6034R',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.2.2; ALCATEL ONE TOUCH 6032 Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Mobile Safari/537.36',
                'OT-6032',
                'OT-6032',
                'Alcatel',
                'Alcatel',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.2.2; de-de; ALCATEL ONE TOUCH P321 Build/JDQ39) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.2 Mobile Safari/534.30',
                'OT-P321',
                'One Touch POP 8',
                'Alcatel',
                'Alcatel',
                'Tablet',
                true,
                'touchscreen',
            ],
        ];
    }
}
