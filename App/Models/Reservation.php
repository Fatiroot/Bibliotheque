<?php
namespace App\Models;
include __DIR__ . '/../../vendor/autoload.php';
use App\Database\Database;
use App\Models\Book;


class Reservation
{
    protected $database;
    private $id; 
    private $description; 
    private $reservation_date; 
    private $return_date; 
    private $is_returned;
    private $user_id;
    private $book_id;
    
    public function __construct($description,$reservation_date,$return_date,$is_returned,$user_id,$book_id){
        $this->database = Database::Connection();
      
        $this->description = $description;
        $this->reservation_date = $reservation_date;
        $this->return_date = $return_date;
        $this->is_returned = $is_returned;
        $this->user_id = $user_id;
        $this->book_id = $book_id;
    }
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = mysqli_real_escape_string($this->conn, $description);
    }

    public function getReservationDate()
    {
        return $this->reservation_date;
    }

    public function setReservationDate($reservation_date)
    {
        $this->reservation_date = $reservation_date;
    }

    public function getReturnDate()
    {
        return $this->return_date;
    }

    public function setReturnDate($return_date)
    {
        $this->return_date = $return_date;
    }

    public function getIsReturned()
    {
        return $this->is_returned;
    }

    public function setIsReturned($is_returned)
    {
        $this->is_returned = $is_returned;
    }

    public function getBookId()
    {
        return $this->book_id;
    }

    public function setBookId($book_id)
    {
        $this->book_id = $book_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }

    public function addReservation()
    {
        $description = $this->getDescription();
        $reservation_date = $this->getReservationDate();
        $return_date = $this->getReturnDate();
        $is_returned = $this->getIsReturned();
        $book_id = $this->getBookId();
        $user_id = $this->getUserId();
    
        $bookModel = new Book('', '', '', '', '', '', '', ''); // Revoir la logique pour créer un livre
        $book = $bookModel->getBookById($book_id);
    
        if ($book && $book['available_copies'] > 0) {
            $newAvailableCopies = $book['available_copies'] - 1;
            $bookModel->updateAvailableCopies($book_id, $newAvailableCopies); // Vérifier que cette méthode est implémentée dans la classe Book
    
            $query = "INSERT INTO reservation (description, reservation_date, return_date, is_returned, user_id, book_id) 
                      VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($this->database, $query);
            mysqli_stmt_bind_param($stmt, 'sssiii', $description, $reservation_date, $return_date, $is_returned, $user_id, $book_id);
            $result = mysqli_stmt_execute($stmt);
            
    
            if ($result) {
                return true;
            } else {
                echo "Error adding reservation: " . mysqli_error($this->database);
    
                $bookModel->updateAvailableCopies($book_id, $book['available_copies']); // Rétablir le nombre de copies disponibles
    
                return false;
            }
        } else {
            echo "No available copies of the book.";
            return false;
        }
    }

}
?>
