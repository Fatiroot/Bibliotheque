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
    private $role;
   

    public function __construct($fullname,$lastname,$email, $password, $phone) {
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
    public function setRole($role) {
        $this->role = $role;
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
        return $this->phone;
    }
    public function getRole() {
        return $this->role;
    }

    public function getUserByEmailName(){
        // $select = "SELECT * FROM `User` WHERE `email` = '$this->email' OR `fullname`='$this->fullname' OR `lastname`='$this->lastname'";
        $query = "SELECT u.*, ur.role_id, r.name FROM user AS u INNER JOIN use_role AS ur ON u.id = ur.user_id INNER JOIN role AS r ON ur.role_id = r.id WHERE  `email` = '$this->email' OR `fullname`='$this->fullname' OR `lastname`='$this->lastname'";
        $result = mysqli_query($this->database, $query);
        return $result;

    }
    public function insertUser(){
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);
        $query = "INSERT INTO `User`(`fullname`, `lastname`, `email`, `password`, `phone`) VALUES ('$this->fullname','$this->lastname','$this->email','$this->password','$this->phone')";
        $result = mysqli_query($this->database, $query);
        // return $result;
        if ($result) {
            $lastId = mysqli_insert_id($this->database);
            $queryRole = "INSERT INTO use_role (user_id, role_id) VALUES ($lastId, 2)";
            $resultRole = mysqli_query($this->database, $queryRole);

            if ($resultRole) {
                return true;
            } else {
                echo "Error adding user role";
            }

            return false;
    }
}

public function getUsers(){
    $query = "SELECT u.*, ur.role_id, r.name FROM user AS u INNER JOIN use_role AS ur ON u.id = ur.user_id INNER JOIN role AS r ON ur.role_id = r.id";
    $result = mysqli_query($this->database, $query);
    $users = array();
    while($row = $result->fetch_assoc()){
        $user = new User($row['fullname'], $row['lastname'], $row['email'], $row['password'],$row['phone']);
        $user->setRole($row['name']);
        $users[] = $user;
    }
    
    return $users;
}

public function deleteUser(){
    $id=$_GET['id'];
    $query="DELETE From user WHERE 'id'=$id"
}
}
?>