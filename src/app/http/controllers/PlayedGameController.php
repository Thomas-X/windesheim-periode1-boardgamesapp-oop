<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 17/10/18
 * Time: 12:55
 */

namespace Qui\app\http\controllers;


use Qui\lib\facades\DB;
use Qui\lib\facades\DB_PDO;
use Qui\lib\facades\View;
use Qui\lib\Request;
use Qui\lib\Response;
use Qui\lib\Routes;

class PlayedGameController
{
    public function showPlayedGame(Request $req, Response $res)
    {
        $playedGames = DB::selectAll('playedgames');
        $games = DB::selectAll('games');
        return View::render('pages.played_game.index', compact('playedGames', 'games'));
    }

    public function showRegisterPlayedGame(Request $req, Response $res)
    {
        $games = DB::selectAll('games');
        $profiles = DB::selectAll('profiles');
        return View::render('pages.played_game.add', compact('games', 'profiles'));
    }

    public function onRegisterPlayedGame(Request $req, Response $res)
    {
        DB::insertEntry('playedgames', [
            'score' => $req->params['score'],
            'Games_id' => $req->params['game_id'],
        ]);
        // TODO avoid DRY.
        $addLoseOrWin = function ($req, $paramName, $profileKey) {
            foreach ($req->params[$paramName] as $p) {
                $profile = DB::selectWhere('*', 'profiles', 'id', $p)[0];
                DB::updateEntry($profile['id'], 'profiles', [
                    $profileKey => ($profile[$profileKey] + 1),
                    'totalGames' => ($profile['totalGames'] + 1)
                ]);
                DB::insertEntry('playedgameuserscore', [
                    'Games_id' => $req->params['game_id'],
                    'profiles_id' => $profile['id'],
                    'didWin' => $paramName === 'playerlose' ? 0 : 1
                ]);
            }
        };
        $addLoseOrWin($req, 'playerlose', 'losses');
        $addLoseOrWin($req, 'playerwon', 'wins');

        return $res->redirect(Routes::$routes['played_games']);
    }
}