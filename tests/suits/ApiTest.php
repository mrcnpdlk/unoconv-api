<?php
/**
 * Created by Marcin.
 * Date: 03.03.2019
 * Time: 17:07
 */

namespace Tests\Tvsat\Api\Xmdb;

use Mrcnpdlk\Api\Unoconv\Api;
use Mrcnpdlk\Api\Unoconv\Config;
use Mrcnpdlk\Api\Unoconv\Enum\FormatType;
use Mrcnpdlk\Api\Unoconv\Exception\InvalidFileArgumentException;
use Mrcnpdlk\Api\Unoconv\Exception\UnoconvException;
use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    /**
     * @throws \Mrcnpdlk\Api\Unoconv\Exception
     */
    public function testConstruct_1(): void
    {
        $oApi = new Api();
        $this->assertTrue(true);
    }

    /**
     * @throws \Mrcnpdlk\Api\Unoconv\Exception
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\ConfigurationException
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\InvalidFileArgumentException
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\UnoconvException
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
        $oApi->transcode($testFile, FormatType::PDF());
        @unlink($testFile);
    }

    /**
     * @throws \Mrcnpdlk\Api\Unoconv\Exception
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\ConfigurationException
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\InvalidFileArgumentException
     * @throws \Mrcnpdlk\Api\Unoconv\Exception\UnoconvException
     */
    public function testConstruct_invalid_2(): void
    {
        $this->expectException(InvalidFileArgumentException::class);
        $config   = new Config([
            'binary' => '/some/binary/file',
        ]);
        $oApi     = new Api();
        $oApi->transcode('foo_bar.test', FormatType::PDF());
    }
}
