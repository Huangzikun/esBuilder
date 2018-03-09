<?php
/**
 * Created by PhpStorm.
 * User: huangzikun
 * Date: 2018/3/9
 * Time: 19:03
 */
namespace Huangzikun\esBuilder\tests;

use Huangzikun\esBuilder\builder\EsDslBuilder;
use PHPUnit\Framework\TestCase;

class EsDslBuilderTest extends TestCase
{
    public function testNewEsDslBuilder()
    {
        $builder = new EsDslBuilder();
        $this->assertEquals(EsDslBuilder::class, get_class($builder));
    }
}