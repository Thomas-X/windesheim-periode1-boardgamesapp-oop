<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 15/09/18
 * Time: 23:25
 */

namespace Qui\lib\facades;
/*
 * A facade, for an item in the DI container
 * */
/**
 * Class View
 * @package Qui\core\facades
 */
class View extends Facade
{
    /**
     * @return string
     */
    protected function getFacadeAccessor()
    {
        return 'view';
    }
}