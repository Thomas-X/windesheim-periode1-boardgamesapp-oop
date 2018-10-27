<div class="container" style="min-height: 100vh">
    <div>
        <form method="post" action="<?php echo \Qui\lib\Routes::routes['login'] ?>" id="loginForm">
            <?php

            \Qui\lib\Form::input('E-mail', 'fa-envelope',
                "<input type=\"email\" name=\"email\" class=\"form-control ownInput\" id=\"email\"
                               placeholder=\"Enter your email\" required minlength=\"2\"/>");

            echo "
<label>tijdelijk account?</label> &emsp;
<input type=\"checkbox\" name=\"temp_account\" id=\"temp_account\"
                   />";
            \Qui\lib\Form::input('Wachtwoord', 'fa-lock', "<input type=\"password\" name=\"password\" class=\"form-control ownInput\" id=\"password\"
                   placeholder=\"Enter your password\"/>");

            ?>
            <a id="passwordHelpBlock" class="form-text text-muted" href="<?php echo \Qui\lib\Routes::routes['forgotPassword'] ?>">
                Wachtwoord vergeten?
            </a>
            <button type="submit" class="btn btn-primary house-btn">Submit</button>
        </form>
    </div>
</div>


<script src="js/login.js"></script>