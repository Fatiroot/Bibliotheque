<?php
namespace App\Controllers;
include __DIR__ . '/../../vendor/autoload.php';
use App\Models\User;

session_start();

class UserController {
    public function deleteUser($id){
      $all = new User ($id, null, null, null, null, null);
      $all->delete();
    }
    public function editUser($id){
      $all = new User ($id, null, null, null, null, null);
      $all->edit();
    }
  }


    if (isset($_POST['delete'])) {
         $id = $_POST['id']; 
        //  echo $id;
        $deleteUser = new UserController();
        $deleteUser->deleteUser($id);
        header('location:../../views/admin/user/show.php');
    }
    if (isset($_POST['edit'])) {
      $id = $_POST['id']; 
    
     $editUser = new UserController();
     $editUser->editUser($id);
     header('location:../../views/admin/user/show.php');
 }