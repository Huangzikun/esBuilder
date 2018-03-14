<?php
/**
 * Created by PhpStorm.
 * User: huangzikun
 * Date: 2018/3/9
 * Time: 16:12
 */
namespace Huangzikun\esBuilder\builder;
use Exception;
use function PHPSTORM_META\type;

class EsDslBuilder
{
    /**
     * @var null
     * 保存Dsl查询语句
     */
    private $_dsl = null;
    private $_query = null;
    private $_size = null;

    const termTypes = ["should", "must", "must_not"];

    /**
     * EsDslBuilder constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return array
     */
    public function getDsl()
    {
        $this->_dsl['query'] = !empty($this->_query) ?  $this->_query : ['match_all' => new \stdClass()];
        return $this->_dsl;
    }

    /**
     * @param int $size
     * @return $this
     */
    public function setSize(int $size)
    {
        $this->_size = $size;
        return $this;
    }

    /**
     * 设置term查询参数，传入一个数组，key为字段名，value为值
     * @param array $fields
     * @param $type
     * @return $this
     */
    public function setTerm(array $fields, string $type)
    {
        $termArr = &$this->_query['bool'][$type]['term'];
        if (!empty($fields)){
            foreach ($fields as $field => $value){
                $termArr[$field] = $value;
            }
        }

        return $this;
    }

    /**
     * 设置
     * @param string $field
     * @param array $values
     * @param string $type
     * @return $this
     */
    public function setTerms(string $field, array $values, string $type)
    {
        if(!empty($this->_query['bool'][$type]['terms'][$field])){
            $this->_query['bool'][$type]['terms'][$field] = array_merge(
                $this->_query['bool'][$type]['terms'][$field],
                array_values($values)
            );
        }else{
            $this->_query['bool'][$type]['terms'][$field] = array_values($values);
        }

        return $this;
    }

}