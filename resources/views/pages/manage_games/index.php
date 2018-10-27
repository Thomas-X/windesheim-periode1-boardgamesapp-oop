<div class="container">
    <div class="jumbotron">
        <h1 class="display-4">Manage / add games</h1>
    </div>
    <h3>
        <a href="<?= \Qui\lib\Routes::$routes['add_game'] ?>" class="btn btn-success"><i class="fas fa-plus"></i>
            &thinsp;Add new game
        </a>
    </h3>

    <ul class="list-group">
        <?php foreach($items as $item) : ?>
        <li class="list-group-item">
            <div class="row">
                <div class="col-sm-8 flexCenter">
                    <?= $item['name'] ?>
                </div>
                <div class="col-sm-4 buttongrid">
                    <a href="<?= \Qui\lib\Routes::$routes['update_game'] . '?id=' . $item['id'] ?>"
                       class="btn btn-success flex1" role="button">
                        <i class="fas fa-sync margin-2"></i>
                        &thinsp;Update
                    </a>
                    <form action="<?= \Qui\lib\Routes::$routes['remove_game'] . '?id=' . $item['id'] ?>" method="post">
                        <button type="submit"
                                class="btn btn-danger" role="button"
                                style="width: 100%;">
                        <i class="fas fa-trash margin-2"></i>
                        &thinsp;Remove
                        </button>
                    </form>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
</div>