<?php

namespace Session;

include_once $_SERVER['DOCUMENT_ROOT'].'/services/classes/Db.class.php';

class Session extends \Db
{
    function setUser($user, $id = null){
        session_start();
        $_SESSION['user']['user_id'] = $id;
        $_SESSION['user']['first_name'] = $user->getFirstName();
        $_SESSION['user']['last_name'] = $user->getLastName();
        $_SESSION['user']['email'] = $user->getEmail();
        $_SESSION['user']['language'] = $user->getLanguage($id);
        $_SESSION['user']['user_name'] = $user->getUserName($id);
        $_SESSION['user']['street'] = $user->getStreet();
        $_SESSION['user']['plz'] = $user->getPlz();
        $_SESSION['user']['ort'] = $user->getOrt();
        $_SESSION['user']['house_nr'] = $user->getHouseNr();
        $_SESSION['user']['logged_in'] = 1;
    }

    function removeLogIn($message) {
        $_SESSION['user']['logged_in'] = 0;
        $this->sendNotification($message);
        $this->destroy();
    }

    function sendNotification($message) {
        $_SESSION['user']['message'] = $message;
    }

    function isLoggedIn() {
        session_start();
        if($_SESSION['user']['logged_in'] == 1) {
            return true;
        }else{
            return false;
        }
    }
    function destroy() {
        session_start();
        session_destroy();
    }

    public function getUser($login_name, $password) {
        $sql = "SELECT COUNT(id) AS 'AMOUNT_USERS' FROM users WHERE user_name = ?";
        $count = $this->execute($sql, [$login_name]);
        if($count[0]['AMOUNT_USERS'] == 1){
            $pw = "SELECT password FROM users WHERE user_name = ?";
            $count = $this->execute($pw, [$login_name]);
            if (password_verify($password, $count[0]['password'])) {
                $user_init_sql = "SELECT * FROM users WHERE user_name = ?";
                $user_data = $this->execute($user_init_sql, [$login_name]);
                return new \User($user_data[0]['user_name'], $user_data[0]['password'], $user_data[0]['email'], $user_data[0]['first_name'], $user_data[0]['last_name'], $user_data[0]['street'], null, $user_data[0]['plz'], $user_data[0]['ort']);
            }
        }else{
            return false;
        }
    }

    public function checkLoginData($login_name, $password)
    {
        $sql = "SELECT COUNT(id) AS 'AMOUNT_USERS' FROM users WHERE user_name = ?";
        $count = $this->execute($sql, [$login_name]);
        if($count[0]['AMOUNT_USERS'] == 1){
            $pw = "SELECT password FROM users WHERE user_name = ?";
            $count = $this->execute($pw, [$login_name]);
            if (password_verify($password, $count[0]['password'])) {
                $user_init_sql = "SELECT * FROM users WHERE user_name = ?";
                $user_data = $this->execute($user_init_sql, [$login_name]);
                return true;
            }
        }else{
            return false;
        }
    }

    private function getUserId($username)
    {
        $sql = "SELECT id FROM users WHERE user_name = ?";
        $res = $this->execute($sql, [$username]);
        return $res[0]['id'];
    }
}