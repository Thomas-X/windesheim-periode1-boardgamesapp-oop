<?php

namespace Qui\app\http\controllers;

use Qui\lib\facades\View;
use Qui\lib\Request;
use Qui\lib\Response;

/**
 * Class ExampleController
 * @package Qui\controllers
 */
class HomeController
{
    /**
     * @param Request $req
     * @param Response $res
     * @param $data
     * @return mixed
     */
    public function showHome(Request $req, Response $res, $data)
    {
        return View::render('pages.Home');
    }
}