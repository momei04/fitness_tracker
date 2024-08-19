<?php 
        if(!isset($_SESSION['user_id'])){ ?>
            <form action="login/login.inc.php" method="post" class="toggle">
                <div class="form-content">
                    <h3 class="title">Log in</h3>
                    <input type="text" name="username" placeholder="Nutzername">
                    <input type="password" name="password" placeholder="Passwort">
                    <button>Log in</button>
                </div>
            </form>
    <?php }
        check_login_errors();
    ?>