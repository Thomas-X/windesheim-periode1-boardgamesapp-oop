<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 09/10/18
 * Time: 20:03
 */

namespace Qui\lib;


class Routes
{
    static public $routes = [
        'home' => '/',
        'login' => '/login',
        'logout' => '/logout',
        'register' => '/register',
        'onRegister' => '/register',
        'resetPassword' => '/resetpassword',
        'forgotPassword' => '/forgotpassword',
        'manage_game' => '/manage_games',
        'add_game' => '/add_game',
        'remove_game' => '/remove_game',
        'update_game' => '/update_game',
        'played_games' => '/played_games',
        'register_played_game' => '/register_played_game',
        'register_temporary_user' => '/register_temporary_user',
        'on_register_temporary_user' => '/on_register_temporary_user',
        'on_set_password_temporary_user' => '/on_set_password_temporary_user',
        'scoreboard' => '/scoreboard',
        'scoreboard_game' => '/scoreboard/game'
    ];

    public static function morphRoutes($path)
    {
        foreach (Routes::$routes as $key => $route) {
            Routes::$routes[$key] = $path . Routes::$routes[$key];
        }
        var_dump(Routes::$routes);
        die;
    }
}