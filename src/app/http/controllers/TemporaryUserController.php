<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 26/10/18
 * Time: 15:36
 */

namespace Qui\app\http\controllers;


use Qui\lib\App;
use Qui\lib\facades\Authentication;
use Qui\lib\facades\DB;
use Qui\lib\facades\Mailer;
use Qui\lib\facades\NotifierParser;
use Qui\lib\facades\View;
use Qui\lib\Request;
use Qui\lib\Response;

/**
 * Class TemporaryUserController
 * @package Qui\app\http\controllers
 */

/**
 * Class TemporaryUserController
 * @package Qui\app\http\controllers
 */
class TemporaryUserController
{
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
    public function showRegisterTemporaryUser(Request $req, Response $res)
    {
        return View::render('pages.temporary_user.index');
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
    public function onRegisterTemporaryUser(Request $req, Response $res)
    {
        $getParam = function ($key) use ($req) {
            return $req->params[$key];
        };
        $profiles_id = Authentication::makeProfile($getParam('fname') . ' ' . $getParam('lname'));
        $tmpToken = Authentication::generateRandomString();
        DB::insertEntry('users', [
            'fname' => $getParam('fname'),
            'lname' => $getParam('lname'),
            'email' => $getParam('email'),
            'temporaryUserToken' => $tmpToken,
            'password' => App::TEMPORARY_USER_PASSWORD,
            'rememberMeToken' => Authentication::generateRandomString(),
            'profiles_id' => $profiles_id
        ]);
        Mailer::setupMail()
            ->to($getParam('email'))
            ->subject('Stel je tijdelijke wachtwoord in')
            ->body("<html lang='en'><body><h3>Klik op deze <a href='https://adsd.clow.nl/~s1130146/P1_OOAPP_Opdracht/on_set_password_temporary_user?temporaryUserToken={$tmpToken}'>link</a> om je wachtwoord in te stellen</h3><br/><h5>Met vriendelijke groet, <br/><br/> BoardgamesApp</h5></body></html>")
            ->send();

        NotifierParser::init()
            ->newNotification()
            ->success()
            ->message('<div style="display:flex;align-items: center"><i class="fas fa-envelope"></i><div class="margin-1"></div>Check je inbox voor een mail om je wachtwoord in te stellen!</div>');

        return $this->showRegisterTemporaryUser($req, $res);
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
    public function showSetPasswordTemporaryUser(Request $req, Response $res)
    {
        return View::render('pages.temporary_user.setPassword');
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
    public function onSetPasswordTemporaryUser(Request $req, Response $res)
    {
        $user = (DB::selectWhere('*', 'users', 'temporaryUserToken', $req->params['temporaryUserToken']))[0];
        DB::updateEntry($user['id'], 'users', [
            'password' => Authentication::generateHash($req->params['password']),
            'temporaryUserToken' => null,
        ]);
        Mailer::setupMail()
            ->to($user['email'])
            ->subject('Je wachtwoord is succesvol ingesteld')
            ->body("<html lang='en'><body><h3>Je tijdelijke account is nu een permanent account.</h3><br/><h5>Met vriendelijke groet, <br/><br/>BoardgamesApp</h5></body></html>")
            ->send();

        NotifierParser::init()
            ->newNotification()
            ->success()
            ->message('<div style="display:flex;align-items: center"><i class="fas fa-envelope"></i><div class="margin-1"></div>Check je inbox voor een bevestigingsemail!</div>');
        return $this->showSetPasswordTemporaryUser($req, $res);
    }
}