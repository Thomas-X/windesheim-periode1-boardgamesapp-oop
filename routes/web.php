<?php

use Qui\lib\App;
use Qui\lib\facades\Router;
use Qui\lib\Routes;

/*
 *
 * No middleware routes should be placed before middleware routes (is nice)
 *
 * */
/*
 * GET
 * */
Router::get(Routes::routes['home'], 'HomeController@showHome');

// CRUD board_game
Router::get(Routes::routes['manage_game'], 'ManageGameController@index');
Router::get(Routes::routes['add_game'], 'ManageGameController@showAdd');
Router::get(Routes::routes['update_game'], 'ManageGameController@showUpdate');

Router::post(Routes::routes['remove_game'], 'ManageGameController@remove');
Router::post(Routes::routes['add_game'], 'ManageGameController@onAdd');
Router::post(Routes::routes['update_game'], 'ManageGameController@onUpdate');

// Register played game / show played games scored vs other players
Router::get(Routes::routes['played_games'], 'PlayedGameController@showPlayedGame');
Router::get(Routes::routes['register_played_game'], 'PlayedGameController@showRegisterPlayedGame');
Router::post(Routes::routes['register_played_game'], 'PlayedGameController@onRegisterPlayedGame');

// register temporary user
// TODO detect on login if user has no password set
Router::get(Routes::routes['register_temporary_user'], 'TemporaryUserController@showRegisterTemporaryUser');

Router::post(Routes::routes['on_register_temporary_user'], 'TemporaryUserController@onRegisterTemporaryUser');

// set password for temporary user
Router::get(Routes::routes['on_set_password_temporary_user'], 'TemporaryUserController@showSetPasswordTemporaryUser');
Router::post(Routes::routes['on_set_password_temporary_user'], 'TemporaryUserController@onSetPasswordTemporaryUser');

// scoreboard
Router::get(Routes::routes['scoreboard'], 'ScoreboardController@showScoreboard');
Router::get(Routes::routes['scoreboard_game'], 'ScoreboardController@showScoreboardForGame');

/*
 *
 * MIDDLEWARE
 *
 * */

/*
 * Forgot password token verification middleware
 * */
Router::middleware(['AuthenticationMiddleware@resetPassword'], [
    [
        App::GET,
        Routes::routes['resetPassword'],
        'AuthenticationController@showResetPassword'
    ],
    [
        App::POST,
        Routes::routes['resetPassword'],
        'AuthenticationController@onResetPassword'
    ]
]);

/*
 * Should be logged in middleware
 * */
Router::middleware(['AuthenticationMiddleware@shouldBeLoggedIn'], [
    [
        App::GET,
        Routes::routes['logout'],
        'AuthenticationController@onLogout'
    ]
]);

/*
 * Should not be logged in middleware
 * */
Router::middleware(['AuthenticationMiddleware@shouldNotBeLoggedIn'], [
    [
        App::GET,
        Routes::routes['login'],
        'AuthenticationController@showLogin'
    ],
    [
        App::GET,
        Routes::routes['register'],
        'AuthenticationController@showRegister'
    ],
    [
        App::GET,
        Routes::routes['forgotPassword'],
        'AuthenticationController@showForgotPassword'
    ],
    [
        App::POST,
        Routes::routes['login'],
        'AuthenticationController@onLogin'
    ],
    [
        App::POST,
        Routes::routes['onRegister'],
        'AuthenticationController@onRegister'
    ],
    [
        App::POST,
        Routes::routes['forgotPassword'],
        'AuthenticationController@onForgotPassword'
    ]
]);
