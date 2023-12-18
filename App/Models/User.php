<?php
namespace App\Models;

include __DIR__ . '/../../vendor/autoload.php';
use App\Database\Database;
class User {
    protected $database;
    private $fullname;
    private $lastname;
    private $email;
    private $password;
    private $phone;
   

    public function __construct($fullname,$lastname,$email,$phone, $password,) {
        $this->database = Database::Connection();
        $this->fullname=$fullname;
        $this->lastname=$lastname;
        $this->email=$email;
        $this->password=$password;
        $this->phone=$phone;
     

    }

        // Setters
       public function setFullName($fullname) {
        $this->fullname = $fullname;
    }
    public function setLastName($lastname) {
        $this->lastname = $lastname;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }
  

       // Getters
    public function getFullName() {
        return $this->fullname;
    }
    public function getLastName() {
        return $this->lastname;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getPhone() {
        return $this->Phone;
    }
   

    public function getUserByEmailName(){
        $select = "SELECT * FROM `User` WHERE `email` = '$this->email' OR `fullname`='$this->fullname' OR `lastname`='$this->lastname'";
        $result = mysqli_query($this->database, $select);
        return $result;

    }
    public function insertUser(){
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $query = "INSERT INTO `User`(`fullname`, `lastname`, `email`, `password`, `phone`) VALUES ('$this->fullname','$this->lastname','$this->email','$this->phone','$this->password')";
        $result = mysqli_query($this->database, $query);
        return $result;
    }

    public function getUsers(){
        $query = "SELECT * FROM `user`";
        $result = mysqli_query($this->database,  $query);
        return $result;
    }
}
?>