<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 27/10/18
 * Time: 13:43
 */

namespace Qui\app\http\controllers;


use Qui\lib\facades\DB;
use Qui\lib\facades\View;
use Qui\lib\Request;
use Qui\lib\Response;

/**
 * Class ScoreboardController
 * @package Qui\app\http\controllers
 */
class ScoreboardController
{
    /**
     * @param Request $req
     * @param Response $res
     * @return mixed
     */
    public function showScoreboard(Request $req, Response $res)
    {
        $games = DB::selectAll('games');
        return View::render('pages.scoreboard', compact('games'));
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
    public function showScoreboardForGame(Request $req, Response $res)
    {
        $gameId = $req->params['game'];
        $game = (DB::selectWhere('*', 'games', 'id', $gameId))[0];
        $data = DB::execute("SELECT
  profiles.id,
  playedgameuserscore.Games_id,
  games.name,
  playedgameuserscore.profiles_id,
  playedgameuserscore.didWin,
  profiles.nickname
FROM
  (
    (
      playedgameuserscore
      INNER JOIN profiles ON profiles.id = playedgameuserscore.profiles_id
    )
    INNER JOIN games ON games.id = playedgameuserscore.Games_id
  )
WHERE
  playedgameuserscore.Games_id = ?", [$gameId]);
        $arr = [];
        foreach ($data as $item) {
            $arrItem = $arr[$item['id']];
            if (isset($arrItem) && $arrItem['id'] == $item['id']) {
                if (isset($arrItem['didWin']) && $arrItem['didWin'] == $item['didWin']) {
                    if (isset($arrItem['didLose']) && $arrItem['didLose'] == $item['didWin']) {
                        continue;
                    }
                }
            }
            // 'remember'
            $key = $item['didWin'] != $arrItem['didLose'] ? 'didLose' : 'didWin';
            $arr[$item['id']] = array_merge($item ?? [], [
                'id' => $item['id'],
                $key => $item['didWin'],
            ]);
        }
        $data = $arr;

        foreach ($data as $idx => $item) {
            if ($item['didWin'] == 1) {
                $data[$idx]['amountWin'] = (DB::execute("SELECT COUNT(*) FROM playedgameuserscore WHERE Games_id=? AND profiles_id=? AND didWin=1", [$item['Games_id'],
                    $item['profiles_id']]))[0][0];
            }
            if ($item['didLose'] == 1) {
                $data[$idx]['amountLose'] = (DB::execute("SELECT COUNT(*) FROM playedgameuserscore WHERE Games_id=? AND profiles_id=? AND didWin=0", [$item['Games_id'],
                    $item['profiles_id']]))[0][0];
            }
        }
        return View::render('pages.scoreboard_game', compact('game', 'data'));
    }
}