<div class="container" style="min-height: 100vh;">
    <div class="jumbotron">
        <h1>Scoreboard voor <?= $game['name'] ?></h1>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-6">
            <ul class="list-group">
                <h1 class="display-5">Wins</h1>
                <?php foreach ($data as $player_game_data): ?>
                        <?php
                        if (isset($player_game_data['amountWin'])) {
                            $str = $player_game_data['amountWin'] . ' &#8210; ' . $player_game_data['nickname'];
                            echo "<li class=\"list-group-item\">{$str}</li>";
                        }
                        ?>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="col-sm-12 col-md-6">
            <ul class="list-group">
                <h1 class="display-5">Losses</h1>
                <?php foreach ($data as $player_game_data): ?>
                    <?php
                    if (isset($player_game_data['amountLose'])) {
                        $str = $player_game_data['amountLose'] . ' &#8210; ' . $player_game_data['nickname'];
                        echo "<li class=\"list-group-item\">{$str}</li>";
                    }
                    ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>