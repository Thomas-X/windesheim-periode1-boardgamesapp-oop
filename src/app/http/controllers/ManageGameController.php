<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 16/10/18
 * Time: 19:27
 */

namespace Qui\app\http\controllers;

use Qui\lib\facades\DB;
use Qui\lib\facades\View;
use Qui\lib\Request;
use Qui\lib\Response;
use Qui\lib\Routes;

/**
 * Class ManageGameController
 * @package Qui\app\http\controllers
 */
class ManageGameController
{
    /**
     * @param Request $req
     * @param Response $res
     * @return mixed
     */
    public function index(Request $req, Response $res)
    {
        $items = DB::selectAll('games');
        return View::render('pages.manage_games.index', compact('items'));
    }

    /**
     * @param Request $req
     * @param Response $res
     * @return mixed
     */
    /**
     * @param Request $req
     * @param Response $res
     * @return mixed
     */
    public function showAdd(Request $req, Response $res)
    {
        return View::render('pages.manage_games.add');
    }

    /**
     * @param Request $req
     * @param Response $res
     */
    /**
     * @param Request $req
     * @param Response $res
     */
    public function onAdd(Request $req, Response $res)
    {
        DB::insertEntry('games', [
            'name' => $req->params['name'],
            'description' => $req->params['description'],
        ]);
        return $res->redirect(Routes::$routes['manage_game']);
    }

    /**
     * @param Request $req
     * @param Response $res
     * @return mixed
     */
    /**
     * @param Request $req
     * @param Response $res
     * @return mixed
     */
    public function showUpdate(Request $req, Response $res)
    {
        $item = DB::selectWhere('*', 'games', 'id', $req->params['id'])[0];
        return View::render('pages.manage_games.update', compact('item'));
    }

    /**
     * @param Request $req
     * @param Response $res
     */
    /**
     * @param Request $req
     * @param Response $res
     */
    public function onUpdate(Request $req, Response $res)
    {
        $name = $req->params['name'];
        $description = $req->params['description'];
        $arr = [];
        if (isset($name)) {
            $arr['name'] = $name;
        }
        if (isset($description)) {
            $arr['description'] = $description;
        }
        DB::updateEntry($req->params['id'], 'games', $arr);
        $res->redirect(Routes::$routes['manage_game']);
    }

    /**
     * @param Request $req
     * @param Response $res
     */
    /**
     * @param Request $req
     * @param Response $res
     */
    public function remove(Request $req, Response $res)
    {
        $id = $req->params['id'];
        $playedgames = DB::selectWhere('*', 'playedgames', 'Games_id', $id);
        foreach ($playedgames as $playedgame) {
            DB::deleteEntry('playedgames', 'id', $playedgame['id']);
        }
        DB::deleteEntry('games', 'id', $id);
        return $res->redirect(Routes::$routes['manage_game']);
    }
}