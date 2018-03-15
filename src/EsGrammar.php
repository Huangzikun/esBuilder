<?php
/**
 * Created by PhpStorm.
 * User: huangzikun
 * Date: 2018/3/14
 * Time: 19:13
 */
namespace Huangzikun\esBuilder;

class EsGrammar
{
    const QUERY = 'query';
    const MATCH_ALL = 'match_all';
    const SIZE = 'size';
    const BOOL = 'bool';
    const TERM = 'term';
    const TERMS = 'terms';
    const FROM = 'from';
    const SORT = 'sort';
    const ORDER = 'order';
    const _SOURCE = '_source';
    const ES_EXCLUDE = 'exclude';
    const ES_INCLUDE = 'include';
}