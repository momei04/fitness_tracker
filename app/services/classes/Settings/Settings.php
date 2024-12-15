<?php

namespace Settings;
include_once $_SERVER['DOCUMENT_ROOT'] . '/services/classes/Db.class.php';
class Settings extends \Db
{
    public function setUserData($id, $user_name, $user_fname, $user_lname, $user_email, $user_ort, $user_password, $user_language){
        $sql="UPDATE `users` SET user_name=?,`first_name`=?,`last_name`=?,`email`=?,`ort`=?,`street`=?,`plz`=?,`password`=?,`language_id`=? WHERE id = ?";
        return $this->execute($sql, [$user_name, $user_fname, $user_lname, $user_email, $user_ort, $user_password, $user_language, $id]);
    }

    public function updateUsername($id, $user_name){
        $sql="UPDATE `users` SET `user_name`=? WHERE id = ?";
        return $this->execute($sql, [$user_name, $id]);
    }

    public function updateFirstName($id, $user_first){
        $sql="UPDATE `users` SET `first_name`=? WHERE id = ?";
        return $this->execute($sql, [$user_first, $id]);
    }

    public function updateLastName($id, $user_last){
        $sql="UPDATE `users` SET `last_name`=? WHERE id = ?";
        return $this->execute($sql, [$user_last, $id]);
    }

    public function updateEmail($id, $email){
        $sql="UPDATE `users` SET `email`=? WHERE id = ?";
        return $this->execute($sql, [$email, $id]);
    }

    public function updateOrt($id, $ort){
        $sql="UPDATE `users` SET `ort`=? WHERE id = ?";
        return $this->execute($sql, [$ort, $id]);
    }

    public function updateHouseNr($id, $house_nr){
        $sql="UPDATE `users` SET `house_nr`=? WHERE id = ?";
        return $this->execute($sql, [$house_nr, $id]);
    }

    public function updateStreet($id, $street){
        $sql="UPDATE `users` SET `street`=? WHERE id = ?";
        return $this->execute($sql, [$street, $id]);
    }

    public function updateLanguage($id, $language){
        $sql="UPDATE `users` SET `language_id`=? WHERE id = ?";
        return $this->execute($sql, [$language, $id]);
    }
}