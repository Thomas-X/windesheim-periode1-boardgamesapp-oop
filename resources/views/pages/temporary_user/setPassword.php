<div class="container" style="min-height: 100vh;">
    <div class="jumbotron">
        <h1>
            Stel hier je wachtwoord in
        </h1>
    </div>

    <form method="post" action'<?= \Qui\lib\Routes::routes['on_set_password_temporary_user'] ?>'>
    <?php
    \Qui\lib\Form::input('Wachtwoord', 'fa-lock',
        "<input type=\"password\" class=\"form-control ownInput\" id=\"password\" placeholder=\"Enter your password\"
                           name=\"password\" minlength='5' required>");
    ?>
    <button type="submit" class="btn btn-primary house-btn">Submit</button>
    </form>
</div>