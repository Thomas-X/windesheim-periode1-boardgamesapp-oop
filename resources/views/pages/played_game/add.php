<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">Register played game</h1>
    </div>
    <form action="<?= \Qui\lib\Routes::$routes['register_played_game'] ?>" method="post" id="played_game_form">
        <div>
            <label>Game</label>
            <select class="form-control" name="game_id" form="played_game_form">
                <?php foreach ($games as $game) : ?>
                    <option value="<?= $game['id'] ?>"><?= $game['name'] ?></option>
                <?php endforeach; ?>
            </select>
            <br/>
            <label>Score</label>
            <input type="number" class="form-control" placeholder="Score.." name="score" required>

            <div id="playerwonContainer">
                <div id="playerwon">
                    <br/>
                    <label>Player that won</label>
                    <select class="form-control" name="playerwon[]" form="played_game_form">
                        <?php foreach ($profiles as $profile) : ?>
                            <option value="<?= $profile['id'] ?>"><?= $profile['nickname'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <br/>
            <button type="button" class="btn btn-success" id="addPlayerWon">
                <i class="fas fa-plus"></i>&thinsp;Add player that won
            </button>
            <br/>
            <div id="playerloseContainer">
                <div id="playerlose">
                    <br/>
                    <label>Player that lost</label>
                    <select class="form-control" name="playerlose[]" form="played_game_form">
                        <?php foreach ($profiles as $profile) : ?>
                            <option value="<?= $profile['id'] ?>"><?= $profile['nickname'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <br/>
            <button type="button" class="btn btn-success" id="addPlayerLose">
                <i class="fas fa-plus"></i>&thinsp;Add player that lost
            </button>
            <br/>
            <br/>
            <hr/>
            <button type="submit" class="btn btn-success">
                <i class="fas fa-plus"></i>&thinsp;Register played game
            </button>
        </div>
    </form>
    <script src="js/registerplayedgame.js"></script>
</div>