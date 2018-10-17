<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">Update game</h1>
    </div>

    <form action="<?= \Qui\lib\Routes::routes['update_game'] . '?id=' . $_GET['id'] ?>" method="post">
        <?php
        $name = $item['name'];
        $description = $item['description'];
        require(__DIR__ . '/fields.php')
        ?>
        <br/>
        <button type="submit" class="btn btn-success">
            <i class="fas fa-plus"></i>
            &thinsp; Voeg game toe
        </button>
    </form>
</div>
