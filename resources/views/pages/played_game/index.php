<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">Overview of played games</h1>
        <p>
            You can also register a played game here.
        </p>
    </div>
    <h3>
        <a href="<?= \Qui\lib\Routes::$routes['register_played_game'] ?>" class="btn btn-success"><i class="fas fa-plus"></i>
            &thinsp;Register played game
        </a>
    </h3>
    <ul class="list-group">
        <?php foreach ($playedGames as $playedGame) : ?>
        <li class="list-group-item">
            <?php
            $game = null;
            foreach ($games as $_game) {
                if ($_game['id'] == $playedGame['Games_id']) {
                    $game = $_game;
                }
            }
            echo "{$game['name']}&thinsp;-&thinsp;{$playedGame['score']}";
            ?>
        </li>

        <?php endforeach; ?>
    </ul>
</div>