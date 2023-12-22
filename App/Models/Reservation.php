
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

    public function setUserId($user_id){
        $this->user_id = $user_id;
    }

    public function setBookId($book_id){
        $this->book_id = $book_id;
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
                $this->setId(mysqli_insert_id($this->database));
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
// ?>
