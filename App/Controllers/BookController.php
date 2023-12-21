<?php
namespace App\Controllers;
include __DIR__ . '/../../vendor/autoload.php';
use App\Models\book;
session_start();
class BookController {
    public function addBook($title,$author,$genre,$description,$publication_year,$total_copies,$available_copies) {
        $book = new Book(null,$title,$author,$genre,$description,$publication_year,$total_copies,$available_copies);
        $book->add();
    }
    public function deleteBook($id){
        $book = new Book ($id, null, null, null, null, null, null, null);
        $book->delete();
      }
      public function updateBook($id,$title, $author, $genre, $description, $publication_year, $total_copies, $available_copies)
      {
          $allBooks = new Book($id,$title, $author, $genre, $description, $publication_year, $total_copies, $available_copies);
           $allBooks->edit();
      }

}
if(isset($_POST['add'])){
    $bookCon = new BookController();
    $bookCon->addBook($_POST['title'],$_POST['author'],$_POST['genre'],$_POST['description'],$_POST['publication_year'],$_POST['total_copies'],$_POST['available_copies']);
    header('../../Views/admin/book/show.php');
}
if (isset($_POST['delete'])) {
    $id = $_POST['id']; 

   $deleteBook = new BookController();
   $deleteBook->deleteBook($id);
   header('location:../../views/admin/book/show.php');
}
if (isset($_POST['edit'])) {
    $id = $_POST['id']; 
    $editBook = new BookController();
    $editBook->updateBook($id,$_POST['title'],$_POST['author'],$_POST['genre'],$_POST['description'],$_POST['publication_year'],$_POST['total_copies'],$_POST['available_copies']);
    header('location:../../Views/admin/book/show.php');
}