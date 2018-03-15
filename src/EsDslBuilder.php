<?php
/**
 * Created by PhpStorm.
 * User: huangzikun
 * Date: 2018/3/9
 * Time: 16:12
 */
namespace Huangzikun\esBuilder;
use Huangzikun\esBuilder\EsGrammar;

class EsDslBuilder
{
    /**
     * @var null
     * 保存Dsl查询语句
     */
    private $_dsl = null;
    private $_query = null;

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
        $this->_dsl[EsGrammar::QUERY] = !empty($this->_query)
            ? $this->_query
            : [EsGrammar::MATCH_ALL => new \stdClass()];

        return $this->_dsl;
    }

    /**
     * @param int $size
     * @return $this
     */
    public function setSize(int $size)
    {
        $this->_dsl[EsGrammar::SIZE] = $size;

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
        $termArr = &$this->_query[EsGrammar::BOOL][$type][EsGrammar::TERM];
        if (!empty($fields)){
            foreach ($fields as $field => $value){
                $termArr[$field] = $value;
            }
        }

        return $this;
    }

    /**
     * 设置terms
     * @param string $field
     * @param array $values
     * @param string $type
     * @return $this
     */
    public function setTerms(string $field, array $values, string $type)
    {
        $this->_query[EsGrammar::BOOL][$type][EsGrammar::TERMS][$field] = array_values($values);

        return $this;
    }

    public function andTerms(string $field, array $values, string $type)
    {
        if(!empty($this->_query[EsGrammar::BOOL][$type][EsGrammar::TERMS][$field])){
            $this->_query[EsGrammar::BOOL][$type][EsGrammar::TERMS][$field] = array_merge(
                $this->_query[EsGrammar::BOOL][$type][EsGrammar::TERMS][$field],
                array_values($values)
            );
        }

        return $this;
    }

    /**
     * @param int $from
     * @return $this
     */
    public function setFrom(int $from)
    {
        $this->_dsl[EsGrammar::FROM] = $from;

        return $this;
    }

    /**
     * @param string $field
     * @param string $sort
     * @return $this
     */
    public function orderBy(string $field, string $sort='asc')
    {
        $this->_dsl[EsGrammar::SORT][$field][EsGrammar::SORT] = $sort;

        return $this;
    }

    /**
     * @param $exclude
     * @return $this
     */
    public function setExcludeField($exclude)
    {
        if(is_string($exclude)){
            $this->_dsl[EsGrammar::_SOURCE][EsGrammar::ES_EXCLUDE] = $exclude;
        }elseif (is_array($exclude)){
            $this->_dsl[EsGrammar::_SOURCE][EsGrammar::ES_EXCLUDE] = array_values($exclude);
        }

        return $this;
    }

    /**
     * @param $include
     * @return $this
     */
    public function setIncludeField($include)
    {
        if(is_string($include)){
            $this->_dsl[EsGrammar::_SOURCE][EsGrammar::ES_INCLUDE] = $include;
        }elseif (is_array($include)){
            $this->_dsl[EsGrammar::_SOURCE][EsGrammar::ES_INCLUDE] = array_values($include);
        }

        return $this;
    }



}