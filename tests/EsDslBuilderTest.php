<?php
/**
 * Created by PhpStorm.
 * User: huangzikun
 * Date: 2018/3/9
 * Time: 19:03
 */
namespace Huangzikun\esBuilder\tests;

use Huangzikun\esBuilder\EsDslBuilder;
use PHPUnit\Framework\TestCase;

class EsDslBuilderTest extends TestCase
{
    public function testNewEsDslBuilder()
    {
        $builder = new EsDslBuilder();
        $this->assertEquals(EsDslBuilder::class, get_class($builder));
    }

    public function testSetTerms()
    {
        $builder = new EsDslBuilder();
        $builder->setTerm([
            'id' => 1], 'must')
            ->setTerm([
                'sex' => 'man'
            ], 'must');

        $query = [
            'query' => [
                'bool' => [
                    'must' => [
                        'term' => [
                            'id' => 1,
                            'sex' => 'man'
                        ]
                    ]
                ]
            ]
        ];

        $this->assertEquals($query, $builder->getDsl());
    }

    public function testTerms()
    {
        $builder = new EsDslBuilder();
        $builder->setTerms('id', ['1','2','3'], 'must');

        $query = [
            'query' => [
                'bool' => [
                    'must' => [
                        'terms' => [
                            'id' => [
                                '1',
                                '2',
                                '3',
                                '4',
                                '5',
                                '6'
                            ]
                        ]
                    ]
                ]
            ]
        ];
        $builder->setTerms('id', ['4', '5', '6'], 'must');

        $this->assertEquals($query, $builder->getDsl());
    }

    public function testSetSize()
    {
        $builder = new EsDslBuilder();

        $query = [
            'query' => [
                'match_all' => new \stdClass()
            ]
        ];
        $this->assertEquals($query, $builder->getDsl());

        $builder->setSize(10);
        $query = [
            'query' => [
                'match_all' => new \stdClass()
            ],
            'size' => 10
        ];

        $this->assertEquals($query, $builder->getDsl());
    }

    public function testFrom()
    {
        $builder = new EsDslBuilder();

        $builder->setFrom(10);
        $query = [
            'query' => [
                'match_all' => new \stdClass()
            ],
            'from' => 10
        ];

        $this->assertEquals($query, $builder->getDsl());
    }

}