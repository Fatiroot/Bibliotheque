<?php
namespace APP\Models;
include __DIR__ . '/../../vendor/autoload.php';
use App\Database\Database;

class Book
{
    protected $database;
    private $id;
    private $title;
    private $author;
    private $genre;
    private $description;
    private $publication_year;
    private $total_copies;
    private $available_copies;

    public function __construct($id,$title,$author,$genre,$description,$publication_year,$total_copies,$available_copies){
        $this->database = Database::Connection();
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->genre = $genre;
        $this->description = $description;
        $this->publication_year = $publication_year;
        $this->total_copies = $total_copies;
        $this->available_copies = $available_copies;
    }
    public function getId() {
        return $this->id;
    }


    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor($author) {
        $this->author = $author;
    }

    public function getGenre() {
        return $this->genre;
    }

    public function setGenre($genre) {
        $this->genre = $genre;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getPublicationYear() {
        return $this->publication_year;
    }

    public function setPublicationYear($publication_year) {
        $this->publication_year = $publication_year;
    }

    public function getTotalCopies() {
        return $this->total_copies;
    }

    public function setTotalCopies($total_copies) {
        $this->total_copies = $total_copies;
    }

    public function getAvailableCopies() {
        return $this->available_copies;
    }

    public function setAvailableCopies($available_copies) {
        $this->available_copies = $available_copies;
    }

    public function add()
    {
        $query = "INSERT into book (`title`, `author`, `genre`, `description`, `publication_year`, `total_copies`, `available_copies`)
        VALUES ('$this->title','$this->author','$this->genre','$this->description','$this->publication_year','$this->total_copies','$this->available_copies')";
        $result = mysqli_query($this->database, $query);
 return $result;    
    }
    public function getBooks(){
        $query = "SELECT * FROM `book`";
        $result = mysqli_query($this->database, $query);
        $books = array();
        while($row = $result->fetch_assoc()){
            $book = new Book($row['id'],$row['title'],$row['author'],$row['genre'],$row['description'],$row['publication_year'],$row['total_copies'],$row['available_copies']);
            $books[] = $book;
        }
        
        return $books;
    }
    
        public function delete(){
            $querydelete="DELETE From `book` WHERE id= {$this->id}";
            $result = mysqli_query($this->database, $querydelete);
            return $result;
          }
          public function getBookById($id){
            $query="SELECT * From `book` WHERE id= {$this->id}";
            $result = mysqli_query($this->database, $query);
            return $result; 
          }
          public function edit()
{
                $query = "UPDATE `book` SET `title`=?, `author`=?, `genre`=?, `description`=?, `publication_year`=?, `total_copies`=?, `available_copies`=? WHERE id=?";
                $statement = $this->database->prepare($query);
                $statement->bind_param('sssssiii', $this->title, $this->author, $this->genre, $this->description, $this->publication_year, $this->total_copies, $this->available_copies, $this->id);
                $statement->execute();
                }

        //   public function edit(){
        //     $queryupdate="UPDATE `book` SET `title`={$this->title},`author`={$this->author},`genre`={$this->genre},`description`={$this->description},`publication_year`={$this->publication_year},`total_copies`={$this->total_copies},`available_copies`={$this->available_copies} WHERE id= {$this->id}";
        //     $result = mysqli_query($this->database,$queryupdate);
        //     return $result;
        //   }

}

?>