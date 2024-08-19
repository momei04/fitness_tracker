<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/style.css">
    <link rel="stylesheet" href="../../style/userAuth.scss">
    <title>Document</title>
</head>
<body>

    <!-- Log in -->
    <?php 
        require_once 'config_session.inc.php';
        require_once 'signup/signup_view.inc.php';
        require_once 'login/login_view.inc.php';
    ?>

<div class="userAuthWrapper">

    <?php include 'login/loginForm.php' ?>

    <!-- Sign up -->
    <?php include 'signup/signupForm.php' ?>

    <?php  if(isset($_SESSION['user_id'])){ ?>
        <h3>Log out</h3>
        <form action="logout.inc.php" class="toggle" method="post">
            <button>Log out</button>
        </form>
    <?php } 
        check_signup_errors();
    ?>
</div>

    
    <!-- Log out -->


    <script>

    </script>
</body>
</html>