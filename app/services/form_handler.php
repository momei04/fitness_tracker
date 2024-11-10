<?php
$_POST = json_decode(file_get_contents('php://input'), true);
if(!empty($_POST['action'])) {

    $action = $_POST['action'];
    $page = $_POST['page'];
    require_once 'classes/Session/Session.php';
    $session = new \Session\Session();
    switch ($page) {
        case 'userAuth':
            require_once 'classes/Users/User.class.php';
            switch ($action) {
                case 'register':
                    $first_name = $_POST['first_name'];
                    $last_name = $_POST['last_name'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];
                    $user_name = $_POST['user_name'];
                    $street = $_POST['street'];
                    $house_nr = $_POST['house_nr'];
                    $plz = $_POST['plz'];
                    $ort = $_POST['ort'];

                    if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($password) && !empty($user_name)) {
                        $user = new User($user_name, $password, $email, $first_name, $last_name, $street, $house_nr, $plz, $ort);
                        if ($user->validatePassword($password)) {
                            $password = password_hash($password, PASSWORD_DEFAULT);
                        } else {
                            $message = $session->getLanguageString('PASSWORD_NO_SPECIALCHARS_OR_CAPITAL_LETTER', 1);
                            $session->removeLogIn($message);
                            header('Location: ../template/pages/userAuth/userAuth.php');
                            break;
                        }

                        if ($user->isValidEmail($email)) {

                            $user->save($user_name, $first_name, $last_name, $email, $street, $plz, $ort, $password);
                            $session->setUser($user);
                        }else{
                            $message = $session->getLanguageString('INVALID_EMAIL', 1);
                            $session->removeLogIn($message);
                            header("Location: ../template/pages/userAuth/userAuth.php'");
                            die();
                        }

                        if($user->isLoggedIn()){
                            header('Location: ../template/pages/dashboard/dashboard.php');
                            die();
                        }

                    } else {
                        $session->removeLogIn('');
                        header("Location: ../template/pages/userAuth/userAuth.php");
                        die();
                    }
                    break;
                case 'login':
                    if($session->checkLoginData($_POST['login_name'], $_POST['password'])){
                        $user = $session->getUser($_POST['login_name'], $_POST['password']);

                        $id = $user->getId($_POST['login_name']);
                        $session->setUser($user, $id);
                        header('Location: ../template/pages/dashboard/dashboard.php');
                    }else{
                        $session->removeLogIn('INVALID_LOGIN');
                        header("Location: ../template/pages/userAuth/userAuth.php");
                        die();
                    }

                    break;

                case 'logout':
                    $session->removeLogIn('LOGOUT_SUCCESS');

                    header("Location: ../../template/pages/userAuth/userAuth.php");
                    die();
            }
            break;
        case 'workout':
            require_once 'classes/Workout/Workout.class.php';
            $workout = new Workout();
            switch ($action) {
                case 'add_exercise':
                    $sets = $_POST['sets'];
                    $reps = $_POST['reps'];
                    $weight = $_POST['weight'];
                    $workout_id = $_POST['workout_id'];
                    $exercise = $_POST['exercise_id'];
                    $user_id = $_POST['user_id'];
                    $workout->insertExerciseInWorkout($sets, $reps, $weight, $workout_id, $exercise, $user_id);
                    $content = $workout->getWorkoutExercises($workout_id);

                    echo json_encode($content);
                    break;
                case 'remove':
                    $workout_id = $_POST['workout_id'];
                    $exercise = $_POST['exercise_id'];
                    $user_id = $_POST['user_id'];
                    $workout->delete($workout_id, $exercise, $user_id);
                    $content = $workout->getWorkoutExercise($workout_id, $exercise, $user_id);

                    echo json_encode($content);
                    break;
            }
            break;
    }
}