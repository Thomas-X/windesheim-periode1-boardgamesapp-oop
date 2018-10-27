<?php
/**
 * Created by PhpStorm.
 * User: thomas
 * Date: 25/09/18
 * Time: 19:47
 */

namespace Qui\lib;


use Qui\lib\facades\DB;

/**
 * this contains several methods for authentication and user registration.
 * @package Qui\lib
 */
class CAuthentication
{
    // increase this when hardware can handle more salting rounds
    const SALTING_ROUNDS = 10;
    const HASHING_OPTIONS = [
        'cost' => CAuthentication::SALTING_ROUNDS
    ];

    /**
     * logs the user in
    /**
     * @param Request $req
     * @param Response $res
     * @param string $email
     * @param string $password
     * @param $isTemporary
     */
    public function login(Request $req, Response $res, string $email, string $password, $isTemporary)
    {
        $user = ['isValid' => false];
        if (!!$email && !!$password) {
            $user = $this->verifyCredentials($email, $password);
        }
        if ($user['isValid'] == true || $isTemporary) {
            if ($isTemporary) {
                $user = (DB::selectWhere('*', 'users', 'email', $email))[0];
                if ($user['password'] != App::TEMPORARY_USER_PASSWORD) {
                    $res->redirect('/', 401);
                    return;
                }
            }
            // 1 week cookie time()+60*60*24*365 sec = 1 week
            // TODO enable secure option to avoi man-in-the-middle attacks
            if (App::isDevelopmentEnviroment()) {
                setcookie('token', $user['rememberMeToken'], time() + 60 * 60 * 24 * 7, '/');
            } else if (App::isProductionEnviroment()) {
                setcookie('token', $user['rememberMeToken'], time() + 60 * 60 * 24 * 7, '/', "", true);
            }

            $res->redirect(Routes::$routes['home'], 200);
        } else {
            $res->redirect(Routes::$routes['home'], 401);
        }
    }

    /**
     * @param Request $req
     * @param Response $res
     * logs the user our
     */
    /**
     * @param Request $req
     * @param Response $res
     */
    public function logout(Request $req, Response $res)
    {
        $token = $req->cookies['token'] ?? false;
        if (!$token) {
            // for some reason $res->redirect is undefined here, I can't be bothered
            header("Location: /");
        } else {
            if (App::isDevelopmentEnviroment()) {
                setcookie('token', null, time() + 1, '/');
            } else if (App::isProductionEnviroment()) {
                setcookie('token', null, time() + 1, '/', "", true);
            }
            header("Location: /");
        }
    }

    /*
     * generate random string based on the UNIX epoch timestamp and md5 hashing it
     * */
    /**
     * @return bool|string
     */
    /**
     * @return bool|string
     * generates a random string
     */
    public function generateRandomString()
    {
        return substr(str_shuffle(MD5(microtime())), 0, 99);
    }

    /*
     * not uniquely random (not researched at least) but since the chances of that are so abysmal its fine by me
     * */
    /**
     * @return bool|string
     */
    /**
     * @return bool|string
     * generates a random hash
     */
    public function generateRandomHash()
    {
        // generate random string
        $str = $this->generateRandomString();
        return $this->generateHash((string) $str);
    }

    /**
     * @param $nickname
     * @return mixed
     */
    /**
     * @param $nickname
     * @return mixed
     * makes a profile entry used for keeping track of played games
     */
    public function makeProfile($nickname)
    {
        DB::insertEntry('profiles', [
            'nickname' => $nickname,
            'wins' => 0,
            'losses' => 0,
            'totalGames' => 0,
        ]);
        return DB::execute("SELECT LAST_INSERT_ID()")[0][0];
    }
    
    // TODO remove / refactor this (superadmin should only be able to do this)

    /**
     * registers a user
     * @param $params
     * @return bool
     * @throws \Exception
     */
    /**
     * @param $params
     * @return bool
     * @throws \Exception
     */
    public function register($params)
    {
        // TODO check / validate parameters with Validator
        // TODO replace this token with a UUID
        try {
            $profileId = $this->makeProfile($params['fname'] . ' ' . $params['lname']);
            $rememberMeToken = $this->generateRandomHash();
            DB::insertEntry('users', array_merge([
                'fname' => $params['fname'],
                'lname' => $params['lname'],
                'email' => $params['email'],
                'profiles_id' => $profileId
            ], [
                'password' => $this->generateHash($params['password']),
                'rememberMeToken' => $rememberMeToken,
                'forgotPasswordToken' => '',
            ]));
            return true;
        } catch (\Exception $exception) {
            dd($exception);
            return false;
        }
    }

    /**
     * @param bool $returnUser
     * @return bool
     */
    /**
     * @param bool $returnUser
     * @return bool
     * verifies if a user is logged in
     */
    public function verify($returnUser = false)
    {
        $token = $_COOKIE['token'] ?? false;
        if (!$token) {
            return false;
        } else {
            $foundUsers = DB::selectWhere($returnUser ? '*' : 'rememberMeToken, id', 'users', 'rememberMeToken', $token);
            if (count($foundUsers) == 1) {
                // Update last login
                $user = $foundUsers[0];
                if ($user && !$returnUser) {
                    return true;
                } else {
                    return $user;
                }
            } else {
                return false;
            }
        }
    }

    /**
     * @param string $string
     * @return bool|string
     */
    /**
     * @param string $string
     * @return bool|string
     * generates a hash from a string
     */
    public function generateHash(string $string)
    {
        // password_default = bcrypt but can change in newer versions, in case it does hashes are re-generated
        return password_hash($string, PASSWORD_DEFAULT, CAuthentication::HASHING_OPTIONS);
    }

    /**
     * @param string $hash
     * @param string $password
     * @return bool
     */
    /**
     * @param string $hash
     * @param string $password
     * @return bool
     * verifies a hash and a plaintext string if they match
     */
    private function verifyHash(string $hash, string $password)
    {
        return password_verify($password, $hash);
    }

    /**
     * @param string $email
     * @param string $password
     * @return array
     */
    /**
     * @param string $email
     * @param string $password
     * @return array
     * verifies credentials, email and password
     */
    private function verifyCredentials(string $email, string $password)
    {
        $users = DB::selectAll('users');
        foreach ($users as $user) {
            // if matches, user has filled in correct password
            if ($user['password'] == null) {
                continue;
            }
            if ($this->verifyHash($user['password'], $password) && $email == $user['email']) {
                if (password_needs_rehash($user['password'], PASSWORD_BCRYPT, CAuthentication::HASHING_OPTIONS)) {
                    // since the password is verified to be the correct one we can use the user input here to hash
                    $hash = $this->generateHash($password);
                    DB::updateEntry(2, 'users', [
                        'password' => "{$hash}",
                    ]);
                }
                return array_merge($user, [
                    'rememberMeToken' => $user['rememberMeToken'],
                    'isValid' => true,
                ]);
            }
        }
        return [
            'rememberMeToken' => null,
            'isValid' => false,
        ];
    }
}