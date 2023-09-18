<?php
/**
 * This file is part of the browser-detector package.
 *
 * Copyright (c) 2012-2023, Thomas Mueller <mimmi20@live.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types = 1);

namespace BrowserDetectorTest\Loader;

use BrowserDetector\Loader\CompanyLoaderInterface;
use BrowserDetector\Loader\DeviceLoader;
use BrowserDetector\Loader\Helper\DataInterface;
use BrowserDetector\Loader\NotFoundException;
use BrowserDetector\Version\TestFactory;
use BrowserDetector\Version\VersionBuilderFactory;
use PHPUnit\Framework\Exception;
use PHPUnit\Framework\ExpectationFailedException;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Stringable;
use UaDeviceType\TypeInterface;
use UaDeviceType\TypeLoaderInterface;
use UnexpectedValueException;

final class DeviceLoaderTest extends TestCase
{
    /**
     * @throws NotFoundException
     * @throws UnexpectedValueException
     */
    public function testInvokeNotInCache(): void
    {
        $logger = $this->createMock(LoggerInterface::class);
        $logger
            ->expects(self::never())
            ->method('info');
        $logger
            ->expects(self::never())
            ->method('notice');
        $logger
            ->expects(self::never())
            ->method('warning');
        $logger
            ->expects(self::never())
            ->method('error');
        $logger
            ->expects(self::never())
            ->method('critical');
        $logger
            ->expects(self::never())
            ->method('alert');
        $logger
            ->expects(self::never())
            ->method('emergency');

        $initData = $this->createMock(DataInterface::class);
        $initData
            ->expects(self::once())
            ->method('__invoke');
        $initData
            ->expects(self::once())
            ->method('hasItem')
            ->with('test-key')
            ->willReturn(false);
        $initData
            ->expects(self::never())
            ->method('getItem')
            ->with('test-key')
            ->willReturn(false);

        $companyLoader = $this->createMock(CompanyLoaderInterface::class);
        $companyLoader
            ->expects(self::never())
            ->method('load');

        $typeLoader = $this->createMock(TypeLoaderInterface::class);
        $typeLoader
            ->expects(self::never())
            ->method('load');

        $object = new DeviceLoader($logger, $initData, $companyLoader, $typeLoader);

        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('the device with key "test-key" was not found');
        $this->expectExceptionCode(0);

        $object->load('test-key');
    }

    /**
     * @throws NotFoundException
     * @throws UnexpectedValueException
     */
    public function testInvokeNullInCache(): void
    {
        $logger = $this->createMock(LoggerInterface::class);
        $logger
            ->expects(self::never())
            ->method('info');
        $logger
            ->expects(self::never())
            ->method('notice');
        $logger
            ->expects(self::never())
            ->method('warning');
        $logger
            ->expects(self::never())
            ->method('error');
        $logger
            ->expects(self::never())
            ->method('critical');
        $logger
            ->expects(self::never())
            ->method('alert');
        $logger
            ->expects(self::never())
            ->method('emergency');

        $initData = $this->createMock(DataInterface::class);
        $initData
            ->expects(self::once())
            ->method('__invoke');
        $initData
            ->expects(self::once())
            ->method('hasItem')
            ->with('test-key')
            ->willReturn(true);
        $initData
            ->expects(self::once())
            ->method('getItem')
            ->with('test-key')
            ->willReturn(null);

        $companyLoader = $this->createMock(CompanyLoaderInterface::class);
        $companyLoader
            ->expects(self::never())
            ->method('load');

        $typeLoader = $this->createMock(TypeLoaderInterface::class);
        $typeLoader
            ->expects(self::never())
            ->method('load');

        $object = new DeviceLoader($logger, $initData, $companyLoader, $typeLoader);

        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('the device with key "test-key" was not found');
        $this->expectExceptionCode(0);

        $object->load('test-key');
    }

    /**
     * @throws ExpectationFailedException
     * @throws Exception
     * @throws NotFoundException
     * @throws UnexpectedValueException
     */
    public function testInvokeNoVersion(): void
    {
        $logger = $this->createMock(LoggerInterface::class);
        $logger
            ->expects(self::never())
            ->method('info');
        $logger
            ->expects(self::never())
            ->method('notice');
        $logger
            ->expects(self::never())
            ->method('warning');
        $logger
            ->expects(self::never())
            ->method('error');
        $logger
            ->expects(self::never())
            ->method('critical');
        $logger
            ->expects(self::never())
            ->method('alert');
        $logger
            ->expects(self::never())
            ->method('emergency');

        $initData = $this->createMock(DataInterface::class);
        $initData
            ->expects(self::once())
            ->method('__invoke');
        $initData
            ->expects(self::once())
            ->method('hasItem')
            ->with('test-key')
            ->willReturn(true);

        $deviceData = (object) [
            'version' => (object) ['class' => null],
            'manufacturer' => 'unknown1',
            'brand' => 'unknown2',
            'type' => 'unknown',
            'deviceName' => null,
            'marketingName' => null,
            'platform' => null,
            'display' => ['width' => null, 'height' => null, 'touch' => null, 'size' => null],
        ];

        $initData
            ->expects(self::once())
            ->method('getItem')
            ->with('test-key')
            ->willReturn($deviceData);

        $companyLoader = $this->createMock(CompanyLoaderInterface::class);
        $matcher       = self::exactly(2);
        $companyLoader
            ->expects($matcher)
            ->method('load')
            ->willReturnCallback(
                static function (string $key) use ($matcher): array {
                    match ($matcher->numberOfInvocations()) {
                        1 => self::assertSame('unknown1', $key),
                        default => self::assertSame('unknown2', $key),
                    };

                    return match ($matcher->numberOfInvocations()) {
                        1 => ['type' => 'loaded-type-1'],
                        default => ['type' => 'loaded-type-2'],
                    };
                },
            );

        $type = $this->createMock(TypeInterface::class);
        $type
            ->expects(self::once())
            ->method('getType')
            ->willReturn('device-type');
        $type
            ->expects(self::once())
            ->method('isMobile')
            ->willReturn(true);

        $typeLoader = $this->createMock(TypeLoaderInterface::class);
        $typeLoader
            ->expects(self::once())
            ->method('load')
            ->with('unknown')
            ->willReturn($type);

        $object = new DeviceLoader($logger, $initData, $companyLoader, $typeLoader);

        $result = $object->load('test-key');

        $expected = [
            [
                'deviceName' => null,
                'marketingName' => null,
                'manufacturer' => 'loaded-type-1',
                'brand' => 'loaded-type-2',
                'dualOrientation' => null,
                'simCount' => null,
                'display' => [
                    'width' => null,
                    'height' => null,
                    'touch' => null,
                    'size' => null,
                ],
                'type' => 'device-type',
                'ismobile' => true,
                'istv' => false,
            ],
            null,
        ];

        self::assertSame($expected, $result);
    }

    /**
     * @throws ExpectationFailedException
     * @throws Exception
     * @throws NotFoundException
     * @throws UnexpectedValueException
     */
    public function testInvokeGenericVersionAndPlatformInvalidException(): void
    {
        $logger = $this->createMock(LoggerInterface::class);
        $logger
            ->expects(self::never())
            ->method('debug');
        $logger
            ->expects(self::never())
            ->method('info');
        $logger
            ->expects(self::never())
            ->method('notice');
        $logger
            ->expects(self::never())
            ->method('warning');
        $logger
            ->expects(self::never())
            ->method('error');
        $logger
            ->expects(self::never())
            ->method('critical');
        $logger
            ->expects(self::never())
            ->method('alert');
        $logger
            ->expects(self::never())
            ->method('emergency');

        $initData = $this->createMock(DataInterface::class);
        $initData
            ->expects(self::once())
            ->method('__invoke');
        $initData
            ->expects(self::once())
            ->method('hasItem')
            ->with('test-key')
            ->willReturn(true);

        $deviceData = (object) [
            'version' => (object) ['factory' => '\\' . VersionBuilderFactory::class, 'search' => ['test']],
            'manufacturer' => 'unknown1',
            'brand' => 'unknown2',
            'type' => 'unknown',
            'deviceName' => null,
            'marketingName' => null,
            'platform' => 'test-platform',
            'display' => ['width' => null, 'height' => null, 'touch' => null, 'size' => null],
        ];

        $initData
            ->expects(self::once())
            ->method('getItem')
            ->with('test-key')
            ->willReturn($deviceData);

        $companyLoader = $this->createMock(CompanyLoaderInterface::class);
        $matcher       = self::exactly(2);
        $companyLoader
            ->expects($matcher)
            ->method('load')
            ->willReturnCallback(
                static function (string $key) use ($matcher): array {
                    match ($matcher->numberOfInvocations()) {
                        1 => self::assertSame('unknown1', $key),
                        default => self::assertSame('unknown2', $key),
                    };

                    return match ($matcher->numberOfInvocations()) {
                        1 => ['type' => 'loaded-type-1'],
                        default => ['type' => 'loaded-type-2'],
                    };
                },
            );

        $type = $this->createMock(TypeInterface::class);
        $type
            ->expects(self::once())
            ->method('getType')
            ->willReturn('device-type');
        $type
            ->expects(self::once())
            ->method('isMobile')
            ->willReturn(false);

        $typeLoader = $this->createMock(TypeLoaderInterface::class);
        $typeLoader
            ->expects(self::once())
            ->method('load')
            ->with('unknown')
            ->willReturn($type);

        $object = new DeviceLoader($logger, $initData, $companyLoader, $typeLoader);

        $result = $object->load('test-key');

        $expected = [
            [
                'deviceName' => null,
                'marketingName' => null,
                'manufacturer' => 'loaded-type-1',
                'brand' => 'loaded-type-2',
                'dualOrientation' => null,
                'simCount' => null,
                'display' => [
                    'width' => null,
                    'height' => null,
                    'touch' => null,
                    'size' => null,
                ],
                'type' => 'device-type',
                'ismobile' => false,
                'istv' => false,
            ],
            'test-platform',
        ];

        self::assertSame($expected, $result);
    }

    /**
     * @throws ExpectationFailedException
     * @throws Exception
     * @throws NotFoundException
     * @throws UnexpectedValueException
     */
    public function testInvokeVersionAndPlatform(): void
    {
        $typeException     = new \UaDeviceType\NotFoundException('type');
        $companyException1 = new NotFoundException('type');
        $companyException2 = new NotFoundException('type');

        $logger  = $this->createMock(LoggerInterface::class);
        $matcher = self::exactly(3);
        $logger
            ->expects($matcher)
            ->method('info')
            ->willReturnCallback(
                static function (string | Stringable $message, array $context = []) use ($matcher, $typeException, $companyException1, $companyException2): void {
                    match ($matcher->numberOfInvocations()) {
                        1 => self::assertSame($typeException, $message),
                        2 => self::assertSame($companyException1, $message),
                        default => self::assertSame($companyException2, $message),
                    };

                    self::assertSame([], $context);
                },
            );
        $logger
            ->expects(self::never())
            ->method('notice');
        $logger
            ->expects(self::never())
            ->method('warning');
        $logger
            ->expects(self::never())
            ->method('error');
        $logger
            ->expects(self::never())
            ->method('critical');
        $logger
            ->expects(self::never())
            ->method('alert');
        $logger
            ->expects(self::never())
            ->method('emergency');

        $initData = $this->createMock(DataInterface::class);
        $initData
            ->expects(self::once())
            ->method('__invoke');
        $initData
            ->expects(self::once())
            ->method('hasItem')
            ->with('test-key')
            ->willReturn(true);

        $deviceData = (object) [
            'version' => (object) ['factory' => TestFactory::class],
            'manufacturer' => 'unknown1',
            'brand' => 'unknown2',
            'type' => 'unknown',
            'deviceName' => 'test-device',
            'marketingName' => 'test-device-name',
            'platform' => 'test-platform',
            'display' => ['width' => null, 'height' => null, 'touch' => null, 'size' => null],
        ];

        $initData
            ->expects(self::once())
            ->method('getItem')
            ->with('test-key')
            ->willReturn($deviceData);

        $companyLoader = $this->createMock(CompanyLoaderInterface::class);
        $matcher       = self::exactly(2);
        $companyLoader
            ->expects($matcher)
            ->method('load')
            ->willReturnCallback(
                static function (string $key) use ($matcher, $companyException1, $companyException2): array {
                    match ($matcher->numberOfInvocations()) {
                        1 => self::assertSame('unknown1', $key),
                        default => self::assertSame('unknown2', $key),
                    };

                    match ($matcher->numberOfInvocations()) {
                        1 => throw $companyException1,
                        default => throw $companyException2,
                    };
                },
            );

        $type = $this->createMock(TypeInterface::class);
        $type
            ->expects(self::never())
            ->method('getType');
        $type
            ->expects(self::never())
            ->method('isMobile');

        $typeLoader = $this->createMock(TypeLoaderInterface::class);
        $typeLoader
            ->expects(self::once())
            ->method('load')
            ->with('unknown')
            ->willThrowException($typeException);

        $object = new DeviceLoader($logger, $initData, $companyLoader, $typeLoader);

        $result = $object->load('test-key');

        $expected = [
            [
                'deviceName' => 'test-device',
                'marketingName' => 'test-device-name',
                'manufacturer' => 'unknown',
                'brand' => 'unknown',
                'dualOrientation' => null,
                'simCount' => null,
                'display' => [
                    'width' => null,
                    'height' => null,
                    'touch' => null,
                    'size' => null,
                ],
                'type' => 'unknown',
                'ismobile' => false,
                'istv' => false,
            ],
            'test-platform',
        ];

        self::assertSame($expected, $result);
    }
}
