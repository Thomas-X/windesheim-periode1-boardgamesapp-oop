<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 04/10/18
 * Time: 00:09
 */

namespace Qui\lib;


/**
 * a way of communicating a notification to the frontend
 * Class CNotifierParser
 * @package Qui\lib
 */
class CNotifierParser
{
    private const PARSE_VAL_DEFAULT = [];
    private const CUR_ID_DEFAULT = null;
    private $parseVal = CNotifierParser::PARSE_VAL_DEFAULT;
    private $curId = CNotifierParser::CUR_ID_DEFAULT;

    /**
     * @return $this
     */
    public function init()
    {
        $this->parseVal = CNotifierParser::PARSE_VAL_DEFAULT;
        $this->curId = CNotifierParser::CUR_ID_DEFAULT;
        return $this;
    }

    /**
     * @return $this
     */
    /**
     * @return $this
     */
    public function newNotification()
    {
        $count = count($this->parseVal);
        $this->curId = $count;
        return $this;
    }

    /**
     * @param string $type
     * @return $this
     */
    /**
     * @param string $type
     * @return $this
     */
    public function typeAdder(string $type)
    {
        $this->parseVal[$this->curId]['type'] = $type;
        return $this;
    }

    /**
     * @return CNotifierParser
     */
    /**
     * @return CNotifierParser
     */
    public function success()
    {
        return $this->typeAdder('success');
    }

    /**
     * @return CNotifierParser
     */
    /**
     * @return CNotifierParser
     */
    public function warning()
    {
        return $this->typeAdder('warning');
    }

    /**
     * @return CNotifierParser
     */
    /**
     * @return CNotifierParser
     */
    public function error()
    {
        return $this->typeAdder('danger');
    }

    /**
     * @return CNotifierParser
     */
    /**
     * @return CNotifierParser
     */
    public function info()
    {
        return $this->typeAdder('info');
    }

    /**
     * @param string $message
     * @return $this
     */
    /**
     * @param string $message
     * @return $this
     */
    public function message(string $message)
    {
        $this->parseVal[$this->curId]['message'] = $message;
        return $this;
    }

    /**
     * @return array
     */
    /**
     * @return array
     */
    public function make()
    {
        return $this->parseVal;
    }
}