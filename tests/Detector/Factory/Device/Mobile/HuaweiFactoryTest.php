<?php

namespace BrowserDetectorTest\Detector\Factory\Device\Mobile;

use BrowserDetector\Detector\Factory\Device\Mobile\HuaweiFactory;

/**
 * Test class for \BrowserDetector\Detector\Device\Mobile\GeneralMobile
 */
class HuaweiFactoryTest extends \PHPUnit_Framework_TestCase
{
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
        $result = HuaweiFactory::detect($agent);

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
            $result->getManufacturer(),
            'Expected manufacturer name to be "' . $manufacturer . '" (was "' . $result->getManufacturer() . '")'
        );
        self::assertSame(
            $brand,
            $result->getBrand(),
            'Expected brand name to be "' . $brand . '" (was "' . $result->getBrand() . '")'
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
                'UCWEB/2.0 (Linux; U; Opera Mini/7.1.32052/30.3697; en-US; HUAWEI G510-0100 Build/HuaweiG510-0100) U2/1.0.0 UCBrowser/10.1.5.583 Mobile',
                'G510-0100',
                'Ascend G510',
                'Huawei',
                'Huawei',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'UCWEB/2.0 (Linux; U; Opera Mini/7.1.32052/30.3697; en-US; U8860 Build/HuaweiU8860) U2/1.0.0 UCBrowser/10.1.5.583 Mobile',
                'U8860',
                'Honor',
                'Huawei',
                'Huawei',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (compatible; MSIE 10.0; Windows Phone 8.0; Trident/6.0; IEMobile/10.0; ARM; Touch; HUAWEI; 4Afrika)',
                '4Afrika',
                '4Afrika',
                'Huawei',
                'Huawei',
                'Mobile Phone',
                null,
                null,
            ],
            [
                'UCWEB/2.0 (Linux; U; Opera Mini/7.1.32052/30.3697; www.tigo.com.gt; HUAWEI_Y330-U05) U2/1.0.0 UCBrowser/9.6.0.514 Mobile',
                'Y330-U05',
                'Y330-U05',
                'Huawei',
                'Huawei',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'UCWEB/2.0(Linux; U; Opera Mini/7.1.32052/30.3697; en-US; HUAWEI Y625-U51 Build/HUAWEIY625-U51) U2/1.0.0 UCBrowser/10.7.0.636 Mobile',
                'Y625-U51',
                'Ascend Y625',
                'Huawei',
                'Huawei',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (compatible; MSIE 10.0; Windows Phone 8.0; Trident/6.0; IEMobile/10.0; ARM; Touch; HUAWEI; W2-U00)',
                'W2-U00',
                'Ascend W2',
                'Huawei',
                'Huawei',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 6.0; HUAWEI VNS-L31 Build/HUAWEIVNS-L31) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Mobile Safari/537.36',
                'VNS-L31',
                'P9 Lite',
                'Huawei',
                'Huawei',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.2.2; en-us; HUAWEI G750-U10 Build/HuaweiG750-U10) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',
                'G750-U10',
                'Honor 3X',
                'Huawei',
                'Huawei',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.1.2; tr-tr; MediaPad 7 Youth Build/HuaweiMediaPad) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Safari/534.30',
                'MediaPad 7 Youth',
                'MediaPad 7 Youth',
                'Huawei',
                'Huawei',
                'Tablet',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.2.2; fa-ir; HUAWEI G730-U10 Build/HuaweiG730-U10) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',
                'G730-U10',
                'Ascend G730',
                'Huawei',
                'Huawei',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 6.0; PE-TL10 Build/HuaweiPE-TL10) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Mobile Safari/537.36',
                'PE-TL10',
                'Honor 6 Plus 4G',
                'Huawei',
                'Huawei',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.3; cs-cz; HUAWEI G6-L11 Build/HuaweiG6-L11) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',
                'G6-L11',
                'Ascend G6 4G',
                'Huawei',
                'Huawei',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; U; Android 4.3; de-de; HUAWEI P7 mini Build/HuaweiG6-L11C02B119) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30',
                'P7 Mini',
                'Ascend P7 Mini',
                'Huawei',
                'Huawei',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 7.0; Nexus 6P Build/NPD90G) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Mobile Safari/537.36',
                'Nexus 6P',
                'Nexus 6P',
                'Huawei',
                'Google',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 6.0; EVA-L09 Build/HUAWEIEVA-L09; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/52.0.2743.98 Mobile Safari/537.36',
                'EVA-L09',
                'EVA-L09',
                'Huawei',
                'Huawei',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.1.2; MediaPad 10 LINK Build/HuaweiMediaPad) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.59 Safari/537.36',
                'S7-301w',
                'MediaPad 10 Link',
                'Huawei',
                'Huawei',
                'Tablet',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.1.2; MediaPad 10 LINK+ Build/HuaweiMediaPad) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/31.0.1650.59 Safari/537.36',
                'MediaPad 10+',
                'MediaPad 10 Link+',
                'Huawei',
                'Huawei',
                'Tablet',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.4.2; HUAWEI P7-L10 Build/HuaweiP7-L10) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Mobile Safari/537.36',
                'P7-L10',
                'Ascend P7',
                'Huawei',
                'Huawei',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 5.1.1; HUAWEI SCL-L01 Build/HuaweiSCL-L01) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.98 Mobile Safari/537.36',
                'SCL-L01',
                'Y6',
                'Huawei',
                'Huawei',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (;;; en-us; Huawei-U8651S Build/U8651SV100R001USAC85B843) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
                'U8651S',
                'Summit',
                'Huawei',
                'T-Mobile',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (;;; en-us; Huawei-U8651T Build/U8651SV100R001USAC85B843) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
                'U8651T',
                'Prism',
                'Huawei',
                'T-Mobile',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (;;; en-us; Huawei-U8651 Build/U8651SV100R001USAC85B843) AppleWebKit/533.1 (KHTML, like Gecko) Version/4.0 Mobile Safari/533.1',
                'U8651',
                'Prism',
                'Huawei',
                'T-Mobile',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.1.2; MediaPad 10 FHD Build/HuaweiMediaPad) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/35.0.1916.138 Safari/537.36 OPR/22.0.1485.78487',
                'MediaPad 10 FHD',
                'MediaPad 10 FHD',
                'Huawei',
                'Huawei',
                'Tablet',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.0.4; HUAWEI U8950-1 Build/HuaweiU8950-1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/32.0.1700.72 Mobile Safari/537.36 OPR/19.0.1340.69518',
                'U8950-1',
                'Honor Pro',
                'Huawei',
                'Huawei',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 5.0.2; Huawei Y511 Build/JDQ39) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.109 Mobile Safari/537.36',
                'Y511',
                'Ascend Y511',
                'Huawei',
                'Huawei',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.2.2; HUAWEI Y320-U30 Build/HUAWEIY320-U30) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/42.0.2311.111 Mobile Safari/537.36',
                'Y320-U30',
                'Ascend Y320',
                'Huawei',
                'Huawei',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
            [
                'Mozilla/5.0 (Linux; Android 4.2.2; H30-U10 Build/H30-U10-???) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.109 Mobile Safari/537.36',
                'H30-U10',
                'Honor 3C',
                'Huawei',
                'Huawei',
                'Mobile Phone',
                true,
                'touchscreen',
            ],
        ];
    }
}
