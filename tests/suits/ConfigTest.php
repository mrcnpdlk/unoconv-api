<?php
/**
 * Created by Marcin.
 * Date: 03.03.2019
 * Time: 16:52
 */

namespace Tests\Mrcnpdlk\Api\Unoconv;

use Mrcnpdlk\Api\Unoconv\Config;
use Mrcnpdlk\Api\Unoconv\Enum\DocType;
use Mrcnpdlk\Api\Unoconv\Enum\FormatType;
use Mrcnpdlk\Lib\ConfigurationException;
use PHPUnit\Framework\TestCase;

class ConfigTest extends TestCase
{
    /**
     * @throws \Mrcnpdlk\Lib\ConfigurationException
     */
    public function testConstruct_1(): void
    {
        $oConfig = new Config();
        $this->assertTrue(true);
    }

    /**
     * @throws \Mrcnpdlk\Lib\ConfigurationException
     */
    public function testConstruct_2(): void
    {
        $oConfig = new Config([]);
        $this->assertTrue(true);
    }

    /**
     * @throws \Mrcnpdlk\Lib\ConfigurationException
     */
    public function testConstruct_3(): void
    {
        $oConfig = new Config([
            'binary'  => 'some_binary_file',
            'host'    => '127.0.0.1',
            'port'    => 2345,
            'docType' => DocType::GRAPHICS(),
            'format'  => FormatType::PDF(),
            'timeout' => 10,
        ]);
        $this->assertSame(DocType::GRAPHICS, $oConfig->getDocType()->getValue());
        $this->assertSame(FormatType::PDF, $oConfig->getFormat()->getValue());
        $this->assertSame(10, $oConfig->getTimeout());
    }

    /**
     * @throws \Mrcnpdlk\Lib\ConfigurationException
     */
    public function testConstruct_invalid(): void
    {
        $this->expectException(ConfigurationException::class);
        $oConfig = new Config([
            'foo_bar' => null,
        ]);
    }
}
