<?php
class Register {

    private $username;
    private $password;
    private $email;
    private $fname;
    private $lname;
    private $birthday;
    private $gender;
    private $status;

    public function __construct($username, $password, $email, $fname, $lname, $birthday, $gender, $status)
    {
        $this->$username = $username;
        $this->$password = $password;
        $this->$email = $email;
        $this->$fname = $fname;
        $this->$lname = $lname;
        $this->$birthday = $birthday;
        $this->$gender = $gender;
        $this->$status = $status;
    }

    public function register($conn)
    {
        try
        {
            $value = "";
            $sql = "INSERT INTO persons(id, first_name, last_name, gender, birthday, married) VALUES()";
            $conn -> autocommit(FALSE);
            $conn -> exec($sql);
            if (!$conn -> commit()) {
                echo "Commit transaction failed";
                exit();
            }
        }
        catch (Exception $e)
        {
            $conn -> rollback();
            echo $e;
        }
    }
}
?>