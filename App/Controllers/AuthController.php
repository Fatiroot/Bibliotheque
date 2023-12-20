<?php
namespace App\Controllers;
include __DIR__ . '/../../vendor/autoload.php';
use App\Models\User;

session_start();

class AuthController {
    
    public function register($fullname, $lastname, $email, $phone, $password, $confirmPassword) {
        $error = '';
    
        if (empty($fullname) || empty($lastname) || empty($email) || empty($phone) || empty($password) || empty($confirmPassword)) {
            $error = 'Fullname, Lastname, Email, and Password are required';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Invalid email';
        } elseif ($password !== $confirmPassword) {
            $error = 'Passwords do not match';
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $user = new User(null,$fullname, $lastname, $email, $hashedPassword, $phone);
            $check = $user->getUserByEmailName();
            
            if ($check->num_rows > 0) {
                $error = 'Username or email has already been taken';
            } else {

                $user->insertUser();

                header("Location: ../../Views/auth/login.php");
                exit();
            }
        }
        
        $_SESSION['error'] = $error;
        header("Location: ../../Views/auth/register.php");
        exit();
    }
    
    
    public function login($email, $password) {
        $error = '';
        $user = new User(null,null,null,$email,null,null);
        $result = $user->getUserByEmailName();
        
        if ($result->num_rows > 0) {
            $userData = $result->fetch_assoc();
            if (password_verify($password, $userData['password'])) {
                $_SESSION['user_id'] = $userData['id'];
                $_SESSION['role'] = $userData['role_id']; 
                 $role=$_SESSION['role'] ;
                if ($role == 1) {
                    header("Location: ../../views/admin/dashboard.php");
                    exit();
                } else {
                    header('Location: ../../views/user/dashboard.php');
                    exit();
                }
            } else {
                $error = 'Incorrect password';
            }
        } else {
            $error = 'User not found';
        }
        $_SESSION['error'] = $error;
        header("Location: ../../views/auth/login.php");
        exit();
    }
    
    //  public function logout() { 
    //         session_destroy(); 
    //         header("Location: ../../views/auth/login.php");
    //         exit();
    //     }
       
    
}


if (isset($_POST['register'])) {
    $register = new AuthController();
    $register->register($_POST['fullname'], $_POST['lastname'], $_POST['email'],$_POST['phone'], $_POST['password'], $_POST['c_password']);
}

if (isset($_POST['login'])){
    $loginController = new AuthController();
    $loginController->login($_POST['email'], $_POST['password']);
}




// $authController = new AuthController();
// $authController->logout();
?>
