<?php
/**
 * Created by PhpStorm.
 * User: huangzikun
 * Date: 2018/3/14
 * Time: 16:53
 */
namespace Huangzikun\esBuilder\tests;

use Huangzikun\esBuilder\builder\EsDslBuilder;

$autoloader = require_once dirname(__DIR__) . '/vendor/autoload.php';

$builder = new EsDslBuilder();

$builder->setTerms('id', ['1','2','3'], 'must')
    ->setTerms('id', ['4', '5', '6'], 'must');