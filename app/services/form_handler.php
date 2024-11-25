<?php

if(!isset($_POST['page'])) {
    $_POST = json_decode(file_get_contents('php://input'), true);
}
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
                            //var_dump($user->isValidEmail($email));
                            if ($user->isValidEmail($email)) {
                                $user->save($user_name, $first_name, $last_name, $email, $street, $plz, $ort, $password);
                                $id = $user->getId($_POST['user_name']);
                                $session->setUser($user, $id);
                                header("Location: ../template/pages/dashboard/dashboard.php");

                            }else{
                                $message = $session->getLanguageString('INVALID_EMAIL', 1);
                                $session->removeLogIn($message);
                                header("Location: ../template/pages/userAuth/userAuth.php");
                                die();
                            }

                        } else {
                            $message = $session->getLanguageString('PASSWORD_NO_SPECIALCHARS_OR_CAPITAL_LETTER', 1);
                            $session->removeLogIn($message);
                            header('Location: ../template/pages/userAuth/userAuth.php');
                            break;
                        }
                        header("Location: ../template/pages/userAuth/userAuth.php");
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
                case 'delete_exercise':
                    $sets = $_POST['sets'];
                    $reps = $_POST['reps'];
                    $weight = $_POST['weight'];
                    $workout_id = $_POST['workout_id'];
                    $exercise = $_POST['exercise_id'];
                    $user_id = $_POST['user_id'];
                    $workout->insertExerciseInWorkout($sets, $reps, $weight, $workout_id, $exercise, $user_id);
                    $content = $workout->getWorkoutExercises($workout_id);
                    break;
                case 'remove':
                    $workout_name = $_POST['workout_name'];
                    $workout_id = $_POST['workout_id'];
                    $exercise = $_POST['exercise_id'];
                    $user_id = $_POST['user_id'];
                    $workout->delete($workout_id, $exercise, $user_id);
                    $content = $workout->getWorkoutExercise($workout_id, $exercise, $user_id);

                    echo json_encode($content);
                    break;

                case 'add_workout':
                    $user = $_POST['user'];
                    $workout_name = $_POST['name'];
                    $workout_type = $_POST['workout_type'];
                    $desc = $_POST['description'];
                    $img = $_POST['workout_img'];
                    $workout->addWorkout($user, $workout_name, $workout_type, $desc, $img);
                    $content = $workout->getWorkouts($user);
                    echo json_encode($content);
                    break;

                case 'delete_workout':
                    $data = json_decode(file_get_contents('php://input'), true);

                    $user = $data['user_id'];
                    $workout_name = $data['workout_id'];
                    $workout->deleteWorkout($workout_name);
                    $content = $workout->getWorkouts($user);
                    echo json_encode($content);
                    break;
                case 'get_exercise_history':
                    $workout_id = $_POST['workout_id'];
                    $user_id = $_POST['user_id'];
                    $exercise_id = $_POST['exercise_id'];
                    $content = $workout->getExerciseHistory($user_id, $workout_id, $exercise_id);
                    echo json_encode($content);
                    break;
            }
            break;
        case 'exercise':
            require_once 'classes/Exercises/Exercise.php';
            $exercise = new \Exercises\Exercise();
            switch ($action) {

                case 'add_exercise':
                    $muscle_id = $_POST['muscle_id'];
                    $exercise_name = $_POST['exercise_name'];
                    $bg_img = $_POST['bg_img'];

                    $exercise->addExercise($muscle_id, $exercise_name, $bg_img);
                    $content = $exercise->getAllExercises();
                    echo json_encode($content);
                    break;
            }
        case 'event':
            require_once 'classes/Event/Event.php';
            $event = new Event();
            switch ($action) {
                case 'add_events':
                    $start_date = $_POST['start_date'];
                    $end_date = $_POST['end_date'];
                    $user_id = $_POST['user_id'];
                    $workout_id = $_POST['workout_id'];
                    $title = $_POST['title'];

                    $event->insertEvents($start_date, $end_date, $workout_id, $user_id, $title);
                    echo json_encode($event->getEvents($user_id));
                    break;

                case 'update_events':
                    $event_id = $_POST['event_id'];
                    $user_id = $_POST['user_id'];
                    $done = $_POST['done'];
                    $event->setDone($event_id, $done);
                    echo json_encode($event->getEvents($user_id));
                    break;
            }
    }
}