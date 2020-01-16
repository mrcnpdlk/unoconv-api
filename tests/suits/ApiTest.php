<?php
/**
 * Created by Marcin.
 * Date: 03.03.2019
 * Time: 17:07
 */

namespace Tests\Mrcnpdlk\Api\Unoconv;

use Mrcnpdlk\Api\Unoconv\Api;
use Mrcnpdlk\Api\Unoconv\Config;
use Mrcnpdlk\Api\Unoconv\Enum\FormatType;
use Mrcnpdlk\Api\Unoconv\Exception\DomainException;
use Mrcnpdlk\Api\Unoconv\Exception\InvalidFileArgumentException;
use Mrcnpdlk\Api\Unoconv\Exception\UnoconvException;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;

class ApiTest extends TestCase
{
    /**
     * @throws \Mrcnpdlk\Lib\ConfigurationException
     */
    public function testConstruct_1(): void
    {
        $oApi = new Api();
        $this->assertTrue(true);
    }

    /**
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\DomainException
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\InvalidFileArgumentException
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\UnoconvException
     * @throws \Mrcnpdlk\Lib\ConfigurationException
     */
    public function testConstruct_invalid_1(): void
    {
        $this->expectException(UnoconvException::class);
        $config   = new Config([
            'binary' => '/some/binary/file',
        ]);
        $oApi     = new Api();
        $testFile = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'test.docx';
        file_put_contents($testFile, null);
        $oApi->transcode($testFile, FormatType::PDF(), null);
        @unlink($testFile);
    }

    /**
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\DomainException
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\InvalidFileArgumentException
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\UnoconvException
     * @throws \Mrcnpdlk\Lib\ConfigurationException
     */
    public function testConstruct_invalid_2(): void
    {
        $this->expectException(InvalidFileArgumentException::class);
        $config = new Config([
            'binary' => '/some/binary/file',
        ]);
        $oApi   = new Api();
        $oApi->transcode('foo_bar.test', FormatType::PDF(), null);
    }

    /**
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\DomainException
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\InvalidFileArgumentException
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\UnoconvException
     * @throws \Mrcnpdlk\Lib\ConfigurationException
     */
    public function testConstruct_invalid_3(): void
    {
        $this->expectException(DomainException::class);
        $config   = new Config([
            'binary' => '/some/binary/file',
            'logger' => new NullLogger(),
        ]);
        $oApi     = new Api($config);
        $testFile = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'test.docx';
        file_put_contents($testFile, null);
        $oApi->transcode($testFile, FormatType::PDF(), sys_get_temp_dir(), [
            'foo_bar' => null,
        ]);
        @unlink($testFile);
    }

    /**
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\DomainException
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\InvalidFileArgumentException
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\UnoconvException
     * @throws \Mrcnpdlk\Lib\ConfigurationException
     */
    public function testConstruct_invalid_4(): void
    {
        $this->expectException(UnoconvException::class);

        $oApi     = new Api();
        $testFile = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'test.docx';
        file_put_contents($testFile, null);
        $oApi->transcode($testFile, FormatType::PDF(), sys_get_temp_dir(), [
            'foo_string' => 'foo',
            'foo_bool'   => true,
        ]);
        @unlink($testFile);
    }

    /**
     * @throws \Mrcnpdlk\Api\Unoconv\Exception
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\InvalidFileArgumentException
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\UnoconvException
     * @throws \Mrcnpdlk\Lib\ConfigurationException
     */
    public function testWs_invalid_1(): void
    {
        $this->expectException(UnoconvException::class);

        $oApi     = new Api();
        $testFile = sys_get_temp_dir() . DIRECTORY_SEPARATOR . 'test.docx';
        file_put_contents($testFile, null);
        $oApi->wsGetPdf($testFile, sys_get_temp_dir());
        @unlink($testFile);
    }
}
