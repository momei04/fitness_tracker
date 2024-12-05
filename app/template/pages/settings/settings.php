<?php
    session_start();
    include_once '../../includes/header.php';
    $helper = new Helper();
    $exercises = $helper->getAllExercises();
?>
<link rel="stylesheet" href="../../style/settings.css">

<div class="settings-container">
    <div class="title-container">
        <h1><?php echo $helper->getLanguageString('SETTINGS', $_SESSION['user']['language']) ?></h1>

    </div>
    <form action="../../../services/pages/settings/settings.php">
        <h3><?php echo $helper->getLanguageString('PERSONAL_INFORMATION', $_SESSION['user']['language']) ?></h3>
        <div class="input-container">
            <label for="first_name">
                <?php echo $helper->getLanguageString('FIRST_NAME', $_SESSION['user']['language']); ?>
            </label>
            <input type="text" name="first_name" id="first_name" value="<?php echo $_SESSION['user']['first_name']?>">
        </div>
        <div class="input-container">
            <label for="last_name">
                <?php echo $helper->getLanguageString('LAST_NAME', $_SESSION['user']['language']); ?>

            </label>
            <input type="text" name="last_name" id="last_name" value="<?php echo $_SESSION['user']['last_name']?>">
        </div>
        <div class="input-container">
            <label for="email">
                <?php echo $helper->getLanguageString('EMAIL', $_SESSION['user']['language']); ?>
            </label>
            <input type="text" name="email" id="email" value="<?php echo $_SESSION['user']['email']?>">
        </div>
        <div class="input-container">
            <label for="user_name">
                <?php echo $helper->getLanguageString('USER_NAME', $_SESSION['user']['language']); ?>

            </label>
            <input type="text" name="user_name" id="user_name" value="<?php echo $_SESSION['user']['user_name']?>">
        </div>
        <div class="street-container flex">
            <div class="input-container ">
                <label for="street">
                    <?php echo $helper->getLanguageString('STREET', $_SESSION['user']['language']); ?>
                </label>
                <input type="text" name="street" id="street" value="<?php echo $_SESSION['user']['street']?>">
            </div>
            <div class="input-container">
                <label for="house_nr">
                    <?php echo $helper->getLanguageString('HOUSE_NR', $_SESSION['user']['language']); ?>
                </label>
                <input type="text" name="street" id="house_nr" value="<?php echo $_SESSION['user']['house_nr']?>">
            </div>
        </div>
        <div class="ort-container flex ">
            <div class="input-container">
                <label for="plz">
                    <?php echo $helper->getLanguageString('PLZ', $_SESSION['user']['language']); ?>
                </label>
                <input type="text" name="plz" id="plz" value="<?php echo $_SESSION['user']['plz']?>">
            </div>
            <div class="input-container">
                <label for="ort">
                    <?php echo $helper->getLanguageString('ORT', $_SESSION['user']['language']); ?>

                </label>
                <input type="text" name="ort" id="ort" value="<?php echo $_SESSION['user']['ort']?>">
            </div>
        </div>
        <button type="submit"><?php echo $helper->getLanguageString('SUBMIT', $_SESSION['user']['language']); ?></button>
    </form>
</div>