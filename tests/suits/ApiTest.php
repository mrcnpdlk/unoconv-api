<?php
/**
 * Created by Marcin.
 * Date: 03.03.2019
 * Time: 17:07
 */

namespace Tests\Tvsat\Api\Xmdb;


use Mrcnpdlk\Api\Unoconv\Api;
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
}
