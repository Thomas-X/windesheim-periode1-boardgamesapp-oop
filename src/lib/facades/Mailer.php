<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 02/10/18
 * Time: 11:43
 */

namespace Qui\lib\facades;

use Qui\lib\facades\Facade;
/*
 * A facade, for an item in the DI container
 * */
/**
 * Class Mailer
 * @package Qui\lib\facades
 */
class Mailer extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'mailer';
    }
}