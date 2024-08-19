<?php
    include('../includes/header.php');
    
    require_once('../../classes/Workout.php');
    require_once('../../classes/User.php');
    $workout = new Workout();
    $user = new User();
?>
<link rel="stylesheet" href="../../style/settings.scss">

<div>
    <!-- Settings Form -->
    <form action="settings.php" class="settingsForm" method="post">
        <h1>
            <?php $workout->getLanguageString('SETTINGS', $_SESSION['language_id']) ?>
        </h1>
        <div class="form-content">
            <div class="user-info-container container">
                
                <div class="input-container">
                    <label for="username"><?php echo $workout->getLanguageString('USER_NAME', $_SESSION['language_id']);  ?></label>
                    <input type="text" name="username" id="" value="<?php echo $_SESSION['username']?>">
                    <input type="hidden" name="action" value="saveSettings">
                </div>

                <div class="input-container">
                    <label for="vorname"><?php echo $workout->getLanguageString('NAME', $_SESSION['language_id']);  ?></label>
                    <input type="text" name="vorname" id="" value="<?php echo $_SESSION['vorname']?>">
                </div>

                <div class="input-container">
                    <label for="nachname"><?php echo $workout->getLanguageString('FAMILY_NAME', $_SESSION['language_id']);  ?></label>
                    <input type="text" name="nachname" id="" value="<?php echo $_SESSION['nachname']?>">
                </div>

                <div class="input-container">
                    <label for="email"><?php echo $workout->getLanguageString('EMAIL', $_SESSION['language_id']);  ?></label>
                    <input type="text" name="email" id="" value="<?php echo $_SESSION['email']?>">
                </div>

                <div class="wrapper">
                    <div class="input-container">
                        <label for="plz"><?php echo $workout->getLanguageString('PLZ', $_SESSION['language_id']);  ?></label>
                        <input type="text" name="plz" id="" value="<?php echo $_SESSION['plz']?>">
                    </div>
                    <div class="input-container">
                        <label for="ort"><?php echo $workout->getLanguageString('ORT', $_SESSION['language_id']);  ?></label>
                        <input type="text" name="ort" id="" value="<?php echo $_SESSION['ort']?>">
                    </div>
                </div>
                
                <div class="input-container">
                    <label for="street"><?php echo $workout->getLanguageString('STREET', $_SESSION['language_id']);  ?></label>
                    <input type="text" name="street" id="" value="<?php echo $_SESSION['street']?>">
                </div>
            </div>

            <div class="session-management-container container">
                <div class="input-container">
                    <label for="language_id"><?php echo $workout->getLanguageString('LANGUAGE', $_SESSION['language_id']);  ?> </label>
                    <div class="lang-container">
                        <?php 
                            $languages = $user->getAllLanguages();
                            foreach ($languages as $language) {
                        ?>
                            <label class="langLabel" for="<?php echo $language["language_name"]?>">
                                <input type="radio" id="<?php echo $language["language_name"]?>" name="language_id" value="<?php echo $language["id"];?>" <?php if($language["id"] == $_SESSION['language_id']){echo 'checked="checked"';} ?>>
                                <img src="<?php echo $language["img_path"]?>">
                            </label>
                        <?php
                            }
                        ?>
                    </div>
                </div>

                <div class="input-container">
                    <label for="session_duration"><?php echo $workout->getLanguageString('SESSION_DURATION', $_SESSION['language_id']);?> (in min)</label>
                    <input type="text" name="session_duration" id="" value="<?php echo $_SESSION['session_duration'] / 60;?>">
                </div>
            </div>
        </div>
        
        <button class="settingsButton" type="submit">Einstellungen speichern</button>
    </form>
</div>

<?php
    if(isset($_POST['action'])){
        
        $username = $_POST['username'];
        $vorname = $_POST['vorname'];
        $nachname = $_POST['nachname'];
        $email = $_POST['email'];
        $street = $_POST['street'];
        $ort = $_POST['ort'];
        $plz = $_POST['plz'];
        $language = $_POST['language_id'];
        $_SESSION['session_duration'] = $_POST['session_duration'] * 60;
        $user->saveSettings($username, $vorname, $nachname, $email, $street, $ort, $plz, $language);
            
        /* Setting the session variables again */
        $_SESSION['vorname'] = $_POST['vorname'];
        $_SESSION['nachname'] =$_POST['nachname'];
        $_SESSION['email'] =$_POST['email'];
        $_SESSION['plz'] = $_POST['plz'];
        $_SESSION['ort'] = $_POST['ort'];
        $_SESSION['street'] = $_POST['street'];
        $_SESSION['username'] = $_POST['username'];
        $_SESSION["last_regeneration"] = time();
        $_SESSION['language_id'] = $_POST['language_id'];

        /* Refreshing the page */
        echo "<meta http-equiv='refresh' content='0'>";
    }
?>
<?php
    include('../includes/footer.php');
?>