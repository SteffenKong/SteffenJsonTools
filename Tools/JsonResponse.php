<?php
/**
 * Created By PHPStorm
 * User: SteffenKong(Konghy)
 * Date: 2020/7/26
 * Time: 15:40
 */

namespace SteffenKong\Tools;

use SteffenKong\StringUtils\StringUtils;
use SteffenKong\Tools\ResultCode;

/**
 * Class JsonResponse
 * @package SteffenKong\Tools
 * Json响应客户端工具
 */
class JsonResponse {


    /**
     * @param string $message
     * @param array $extra
     */
    public static function success($message = '操作成功',$extra = []) {
        $result = new JsonResult(ResultCode::SUCCESS,$message);
        $result->setExtra($extra);
        $result->output();
    }


    public static function fail($message = '系统出小差!',$extra = []) {
        $result = new JsonResult(ResultCode::FAIL,$message);
        $result->setExtra($extra);
        $result->output();
    }


    public static function paginate($data,$count,$page,$pageSize,$extra) {
        $result = new JsonResult(ResultCode::SUCCESS,"获取成功");
        $result->setData($data);
        $result->setCount($count);
        $result->setPage($page);
        $result->setPageSize($pageSize);
        $result->setExtra($extra);
        $result->output();
    }


    public static function item($data,$extra = []) {
        $result = new JsonResult(ResultCode::SUCCESS,"获取成功");
        $result->setData($data);
        $result->setExtra($extra);
        $result->output();
    }
}