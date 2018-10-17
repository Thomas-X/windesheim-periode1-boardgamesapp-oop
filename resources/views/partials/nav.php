<nav style="padding: 2rem 0 2rem 0;margin: 0 0 2rem 0;">
    <div class="container">
        <div class="row container">
            <div class="col col-sm-4">
                <h5>Boardgamesapp</h5>
            </div>
            <div class="col-sm-8">

                <div class="flexContainer">
                    <a class="navLink nav-link" href="/">Home</a>
                    <a class="navLink nav-link" href="<?= \Qui\lib\Routes::routes['manage_game'] ?>">Manage games</a>
                    <a class="navLink nav-link" href="<?= \Qui\lib\Routes::routes['played_games'] ?>">Played games</a>
                    <?php
                    $loggedIn = \Qui\lib\facades\Authentication::verify();
                    $user = \Qui\lib\facades\Authentication::verify(true);
                    // if NOT logged in
                    if (!$loggedIn) {
                        echo "<a class=\"navLink nav-link\" href=\"/login\">Login</a>";
                        echo "<a class=\"navLink nav-link\" href=\"/register\">Register</a>";
                    }
                    // if logged in
                    if ($loggedIn) {
                        echo "<a class=\"navLink nav-link\" href=\"/logout\">Logout</a>";
                        echo "<a class=\"navLink nav-link\" href=\"#\">Hi, {$user['fname']}!</a>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</nav>