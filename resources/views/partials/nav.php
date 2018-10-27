<nav style="padding: 2rem 0 2rem 0;margin: 0 0 2rem 0;">
    <div class="container">
        <div class="row container">
            <div class="col col-sm-2">
                <h5>Boardgamesapp</h5>
            </div>
            <div class="col-sm-10">

                <div class="flexContainer">
                    <a class="navLink nav-link" href="<?= \Qui\lib\Routes::$routes['home'] ?>">Home</a>
                    <a class="navLink nav-link" href="<?= \Qui\lib\Routes::$routes['manage_game'] ?>">Manage games</a>
                    <a class="navLink nav-link" href="<?= \Qui\lib\Routes::$routes['played_games'] ?>">Played games</a>
                    <a class="navLink nav-link" href='<?= \Qui\lib\Routes::$routes['scoreboard'] ?>'>Scoreboard</a>
                    <?php
                    $loggedIn = \Qui\lib\facades\Authentication::verify();
                    $user = \Qui\lib\facades\Authentication::verify(true);
                    $registerTmp = \Qui\lib\Routes::$routes['register_temporary_user'];
                    $lgn = \Qui\lib\Routes::$routes['login'];
                    $reg = \Qui\lib\Routes::$routes['register'];
                    $logout = \Qui\lib\Routes::$routes['logout'];
                    // if NOT logged in
                    if (!$loggedIn) {
                        echo "<a class=\"navLink nav-link\" href='{$lgn}'>Login</a>";
                        echo "<a class=\"navLink nav-link\" href='{$reg}'>Register</a>";
                        echo "<a class=\"navLink nav-link\" href='{$registerTmp}'>Register temporary user</a>";
                    }
                    // if logged in
                    if ($loggedIn) {
                        echo "<a class=\"navLink nav-link\" href='{$logout}'>Logout</a>";
                        echo "<a class=\"navLink nav-link\" href=\"#\">Hi, {$user['fname']}!</a>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</nav>