<div class="container" style="min-height: 100vh;">
    <div class="jumbotron">
        <h1>Scoreboard</h1>
        <p>
            Hier kan je zien hoeveel wins/losses een gebruiker heeft bij een bepaald spel en wie meeste wins / losses heeft van een spel. Klik op een spel om de specifieken te zien
        </p>
    </div>

    <ul class="list-group">
        <?php foreach($games as $game): ?>
        <li class="list-group-item">
            <a href='<?= \Qui\lib\Routes::$routes['scoreboard_game'] . '?game=' . $game['id'] ?> '><?= $game['name'] ?></a>
        </li>
        <?php endforeach; ?>
    </ul>
</div>