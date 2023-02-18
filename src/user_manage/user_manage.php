<?php
class UserLogin
{
    private $username;
    private $password;

    function __construct($username, $password)
    {
        $this->$username = $username;
        $this->$password = $password;
    }
}

class UserRegister extends UserLogin
{

    private $email;
    private $first_name;
    private $last_name;
    private $gender;
    private $birthday;
    private $married;

    function __construct($username, $password, $first_name, $last_name, $gender, $birthday, $married)
    {
        $this->$username = $username;
        $this->$password = $password;
        $this->$first_name = $first_name;
        $this->$last_name = $last_name;
        $this->$gender = $gender;
        $this->$birthday = $birthday;
        $this->$married = $married;
    }

}
