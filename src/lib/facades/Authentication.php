<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 25/09/18
 * Time: 19:47
 */

namespace Qui\lib\facades;

/*
 * A facade, for an item in the DI container
 * */
/**
 * Class Authentication
 * @package Qui\lib\facades
 */
class Authentication extends Facade
{
    /**
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'authentication';
    }
}