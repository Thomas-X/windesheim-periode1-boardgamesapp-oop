<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">Add game</h1>
    </div>
    <form action="<?= \Qui\lib\Routes::$routes['add_game'] ?>" method="post">
        <?php require(__DIR__ . '/fields.php') ?>
        <br/>
        <button type="submit" class="btn btn-success">
            <i class="fas fa-plus"></i>
            &thinsp; Voeg game toe
        </button>
    </form>
</div>