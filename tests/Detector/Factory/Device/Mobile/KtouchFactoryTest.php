<?php

namespace BrowserDetectorTest\Detector\Factory\Device\Mobile;

use BrowserDetector\Detector\Factory\Device\Mobile\KtouchFactory;

/**
 * Test class for \BrowserDetector\Detector\Device\Mobile\GeneralMobile
 */
class KtouchFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider providerDetect
     *
     * @param string $agent
     * @param string $deviceName
     * @param string $marketingName
     * @param string $manufacturer
     * @param string $brand
     */
    public function testDetect($agent, $deviceName, $marketingName, $manufacturer, $brand)
    {
        /** @var \UaResult\Device\DeviceInterface $result */
        $result = KtouchFactory::detect($agent);

        self::assertInstanceOf('\UaResult\Device\DeviceInterface', $result);
        self::assertSame($deviceName, $result->getDeviceName());
        self::assertSame($marketingName, $result->getMarketingName());
        self::assertSame($manufacturer, $result->getManufacturer());
        self::assertSame($brand, $result->getBrand());

        self::assertInternalType('string', $result->getManufacturer());
    }

    /**
     * @return array[]
     */
    public function providerDetect()
    {
        return [
            [
                'TIANYU-KTOUCH/A930/Screen-240X320',
                'Tianyu A930',
                'Tianyu A930',
                'K-Touch',
                'K-Touch',
            ],
        ];
    }
}