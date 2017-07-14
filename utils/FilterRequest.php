<?php

namespace Utils;

class FilterRequest
{
    static function get(array $params)
    {
        return array_filter($params, function($param) {
            return $param && $param != '';
        });
    }
}