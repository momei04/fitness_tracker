<?php
session_start();
    if (isset($_SESSION['user']) && $_SESSION['user']['logged_in'] == 1) {

        header("Location: ../dashboard/dashboard.php");
        die();
    }else{
?>

<link rel="stylesheet" href="../../style/form.css">
<div class="form-container">
    <div class="container">
        <form action="../../../services/form_handler.php" method="post">
            <div class="form-header">
                <h1>Sign up</h1>
            </div>

            <div class="form-content">
                <div class="flex">
                    <div class="input-container">
                        <label for="first_name">Vorname</label>
                        <input type="text" name="first_name" id="first_name" placeholder="Vorname">
                    </div>
                    <div class="input-container">
                        <label for="last_name">Nachname</label>
                        <input type="text" name="last_name" id="last_name" placeholder="Nachname">
                    </div>
                </div>

                <div class="input-container">
                    <label for="user_name">Usernmae</label>
                    <input type="text" name="user_name" id="user_name" placeholder="Usernmae">
                </div>
                <div class="input-container">
                    <label for="email">E-Mail</label>
                    <input type="email" name="email" id="email" placeholder="E-Mail">
                </div>
                <div class="input-container">
                    <label for="password">Passwort</label>
                    <input type="password" name="password" id="password" placeholder="Passwort">
                </div>
                <div class="flex">
                    <div class="input-container">
                        <label for="street"></label>
                        <input type="text" name="street" id="street" placeholder="Straße">
                    </div>
                    <div class="input-container">
                        <label for="house_nr"></label>
                        <input type="text" name="house_nr" id="house_nr" placeholder="Haus-Nr.">
                    </div>
                </div>
                <div class="flex">
                    <div class="input-container">
                        <label for="plz"></label>
                        <input type="number" name="plz" id="plz" placeholder="PLZ">
                    </div>
                    <div class="input-container">
                        <label for="ort"></label>
                        <input type="text" name="ort" id="ort" placeholder="Ort">
                    </div>
                </div>
                <input type="hidden" name="page" value="userAuth">
                <input type="hidden" name="action" value="register">
                <button type="submit">Sign up</button>
            </div>
        </form>
        <form action="../../../services/form_handler.php" method="post">
            <div class="form-header">
                <h1>Log in</h1>
            </div>

            <div class="form-content">


                <div class="input-container">
                    <label for="login_name">Usernmae</label>
                    <input type="text" name="login_name" id="login_name" placeholder="Usernmae">
                </div>

                <div class="input-container">
                    <label for="password">Passwort</label>
                    <input type="password" name="password" id="password" placeholder="Passwort">
                </div>

                <input type="hidden" name="page" value="userAuth">
                <input type="hidden" name="action" value="login">
                <button name="submit" type="submit">Log in</button>
            </div>
        </form>
    </div>

    <div class="img-container">
        <div class="layer"></div>
        <img src="https://neunzigplus-media.s3.eu-central-1.amazonaws.com/wp-content/uploads/2021/10/13172256/Phil-Foden-liverpool-v-manchester-city-premier-league.jpg" alt="">
    </div>
</div>



<?php
    }
include_once '../../includes/footer.php'
?>



