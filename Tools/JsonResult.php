<?php
/**
 * Created By PHPStorm
 * User: SteffenKong(Konghy)
 * Date: 2020/7/26
 * Time: 15:40
 */

namespace SteffenKong\Tools;

use SteffenKong\StringUtils\StringUtils;

/**
 * Class JsonResult
 * @package SteffenKong\Tools
 * Json结果集构造工具
 */
class JsonResult {

    const CODE_SUCCESS = '000';
    const CODE_FAIL = '001';


    /**
     * @var array
     * 数据
     */
    private $data = [];


    /**
     * @var int
     * 数据条数
     */
    private $count = 0;


    /**
     * @var int
     * 当前页码
     */
    private $page = 0;


    /**
     * @var int
     * 每页显示的数据
     */
    private $pageSize = 10;


    /**
     * @var array
     * 扩展数据
     */
    private $extra = [];


    /**
     * @var
     * 消息
     */
    private $message;


    /**
     * @var string
     * 业务返回代码
     */
    private $code = self::CODE_SUCCESS;


    /**
     * @var bool
     * 是否使用json头
     */
    private $useJsonHeader = true;


    // 状态码信息
    private static $codeStatus = [
        self::CODE_SUCCESS => '操作成功.',
        self::CODE_FAIL => '系统出小差.  !'
    ];


    public function __construct($code,$message)
    {
        $this->setCode($code);
        $this->setMessage($message);
    }


    /**
     * @param $code
     * @param $message
     * 输出结果集数据
     */
    public static function result($code,$message) {
        $result = new self($code,$message);
        $result->output();
    }


    /**
     * @param $code
     * @param $message
     * 返回一个成功的result
     */
    public static function success($message = '操作成功') {
        $result = new self(self::CODE_SUCCESS,$message);
        $result->output();
    }


    /**
     * @param string $message
     * 返回一个失败的result
     */
    public static function fail($message = '系统开了小差!') {
        $result = new self(self::CODE_FAIL,$message);
        $result->output();
    }


    public function setCode($code) {
        $this->code = $code;
    }


    public function getCode() {
        return $this->code;
    }


    /**
     * @param $message
     * 设置消息
     */
    public function setMessage($message) {
        $this->message = $message;
    }


    /**
     * @param $message
     * @return mixed
     * 获取消息
     */
    public function getMessage() {
        return $this->message;
    }


    /**
     * @param $extra
     * 设置扩展数据
     */
    public function setExtra($extra) {
        $this->extra = $extra;
    }


    /**
     * @param $extra
     * @return array
     * 获取扩展数据
     */
    public function getExtra() {
        return $this->extra;
    }


    /**
     * @param $data
     * 设置数据
     */
    public function setData($data) {
        $this->data = $data;
    }


    /**
     * @param $data
     * @return array
     * 获取数据
     */
    public function getData() {
        return $this->data;
    }


    /**
     * @param $count
     * 设置数据条数
     */
    public function setCount($count) {
        $this->count = $count;
    }


    /**
     * @param $count
     * @return int
     * 获取数据条数
     */
    public function getCount() {
        return $this->count;
    }

    public function setPage($page) {
        $this->page = $page;
    }


    public function getPage() {
        return $this->page;
    }



    public function setPageSize($pageSize) {
        return $this->pageSize = $pageSize;
    }


    public function getPageSize() {
        return $this->pageSize;
    }


    /**
     * @return bool
     */
    public function isUseJsonHeader() {
        return $this->useJsonHeader;
    }


    /**
     * @param $useJsonHeader
     */
    public function setUseJsonHeader($useJsonHeader) {
        $this->useJsonHeader = $useJsonHeader;
    }




    public function __toString()
    {
        if (!$this->getMessage()) {
            $this->setMessage(self::$codeStatus[$this->code]);
        }

        return StringUtils::jsonEncode([
            'code' => $this->getCode(),
            'success' => $this->isSuccess(),
            'message' => $this->getMessage(),
            'data' => $this->getData(),
            'count' => $this->getCount(),
            'page' => $this->getPage(),
            'pageSize' => $this->getPageSize(),
            'countPage' => $this->getPageSize() != 0 ? ceil($this->getCount() / $this->getPageSize()) : 0,
            'extra' => $this->getExtra()
        ]);
    }


    /**
     * @return bool
     * 当前是否成功执行
     */
    public function isSuccess() {
        return $this->code == self::CODE_SUCCESS;
    }


    /**
     *
     * 输出数据
     */
    public function output() {
        if ($this->isUseJsonHeader() && !$this->isCli()) {
            header("Content-type:application/json;charset=utf-8");
        }

        echo $this;
        exit();
    }


    /**
     * @return bool
     * 是否为终端命令行运行程序
     */
    public function isCli()
    {
        return preg_match("/cli/i", php_sapi_name()) ? true : false;
    }
}