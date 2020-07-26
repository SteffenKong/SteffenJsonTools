<?php
/**
 * Created By PHPStorm
 * User: SteffenKong(Konghy)
 * Date: 2020/7/26
 * Time: 15:38
 */

namespace SteffenKong\StringUtils;

class StringUtils {


    /**
     * @param $data
     * @return false|string
     * 数组转Json
     */
    public static function jsonEncode($data) {
        return \json_encode($data,JSON_UNESCAPED_UNICODE);
    }


    /**
     * @param $string
     * @return mixed
     * Json转数组
     */
    public static function jsonDecode($string) {
        $string = trim($string, "\xEF\xBB\xBF");
        return \json_decode($string,true);
    }
}