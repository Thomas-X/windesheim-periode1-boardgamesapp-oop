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
    public const routes = [
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
    ];
}