<?php
/**
 * Created by Marcin.
 * Date: 03.03.2019
 * Time: 17:07
 */

namespace Tests\Tvsat\Api\Xmdb;

use Mrcnpdlk\Api\Unoconv\Api;
use Mrcnpdlk\Api\Unoconv\Config;
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
     */
    public function testConstruct_invalid(): void
    {
        $this->expectException(UnoconvException::class);
        $config = new Config([
            'binary' => '/some/binary/file',
        ]);
        $oApi   = new Api();
        $oApi->create('sss.docx', 'sss.pdf');
    }
}
