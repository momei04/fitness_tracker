<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/services/classes/Db.class.php';

class User extends Db
{
    private $id;
    private $username;
    private $password;
    private $email;
    private $first_name;
    private $last_name;
    private $street;
    private $house_nr;
    private $plz;
    private $ort;

    public function __construct($username, $password, $email, $first_name, $last_name, $street, $house_nr, $plz, $ort)
    {
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->street = $street;
        $this->house_nr = $house_nr;
        $this->plz = $plz;
        $this->ort = $ort;
        parent::__construct();
    }

    public function getId($user_name) {
        $sql = "SELECT id FROM users WHERE user_name = ?;";
        $return = $this->execute($sql, [$user_name]);

        if (empty($return)) {
            return null;
        } else {
            return $return[0]['id'];
        }
    }


    public function getUsername($id)
    {
        $sql = "SELECT user_name FROM users WHERE id = ?;";
        $return = $this->execute($sql, [$id]);

        if (empty($return)) {
            return null;
        } else {
            return $return[0]['user_name'];
        }
    }


    public function getPassword($id)
    {
        $sql = "SELECT password FROM users WHERE id = ?;";
        $return = $this->execute($sql, [$id]);
            if (empty($return)) {
                return null;
            } else {
                return $return[0]['password'];
            }
        }


    public function setPassword($password)
    {
        $this->password = $password;
    }


    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function getHouseNr()
    {
        return $this->house_nr;
    }

    public function getPlz()
    {
        return $this->plz;
    }

    public function getOrt()
    {
        return $this->ort;
    }

    public function validatePassword($password)
    {
        if (strlen($password) < 8) {
            $upperCase = preg_match('/[A-Z]/', $password);
            $lowerCase = preg_match('/[a-z]/', $password);
            $specialChar = preg_match('/[^A-Za-z0-9]/', $password);
            $numericVal = preg_match('/[0-9]/', $password);

            if ($upperCase && $lowerCase && $specialChar && $numericVal) {
                return true;
            } else {
                return 'Password doesnt meet all requirements';
            }
        } else {
            return 'Password is too short';
        }
    }

    public function save($user_name, $first_name, $last_name, $email, $street, $plz, $ort, $password)
    {
        $sql = "INSERT INTO users(user_name, email, first_name, last_name, ort, plz, street, password) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?);";
        return $this->execute($sql, [$user_name, $email, $first_name, $last_name, $ort, $plz, $street, $password]);
    }

    public function isValidEmail($email)
    {
        return true;/*filter_var($email, FILTER_VALIDATE_EMAIL) === $email;*/
        /*&& preg_match('/@.+\./', $email);*/
    }

    public function getLanguage($user_id)
    {
        $sql = "SELECT language_id FROM users WHERE id = ?;";
        $return = $this->execute($sql, [$user_id]);

        if (empty($return)) {
            return null;
        } else {
            return $return[0]['language_id'];
        }
    }

    public function getUserId($user_name)
    {
        $sql = "SELECT id FROM users WHERE user_name = ?;";
        $return = $this->execute($sql, [$user_name]);
        var_dump($return);
        if (empty($return)) {
            return null;
        } else {
            return $return[0]['id'];
        }

    }

    function isLoggedIn()
    {
        if (isset($_SESSION['user']['user_id']) && isset($_SESSION['user']['logged_in'])) {
            return true;
        } else {
            return false;
        }
    }
}
