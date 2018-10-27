<div class="container" style="min-height: 100vh;">
    <div class="jumbotron">
        <h1 class="display-5">Registreer een tijdelijke gebruiker</h1>
        <p>
            je krijgt een mail toegestuurd om je wachtwoord in te stellen. zorg dat je dit zo snel mogelijk doet en hier niet mee wacht want anders kan iedereen die jouw email heeft inloggen.
        </p>
    </div>
    <form method="post" action="<?= \Qui\lib\Routes::$routes['on_register_temporary_user'] ?>">
        <?php
        \Qui\lib\Form::input('Voornaam', 'fa-user',
            "<input type=\"text\" class=\"form-control ownInput\" id=\"fname\" placeholder=\"Enter your firstname\" name=\"fname\" required>");

        \Qui\lib\Form::input('Achternaam', 'fa-user',
            "<input type=\"text\" class=\"form-control ownInput\" id=\"lname\" placeholder=\"Enter your lastname\" name=\"lname\" required>");

        \Qui\lib\Form::input('E-mail', 'fa-envelope',
            "<input type=\"email\" class=\"form-control ownInput\" id=\"email\" placeholder=\"Enter your e-mail\"
                           name=\"email\" required>");
        ?>
        <button type="submit" class="btn btn-primary house-btn">Submit</button>
    </form>
</div>