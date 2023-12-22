<?php
namespace App\Controllers;

include __DIR__ . '/../../vendor/autoload.php';

use App\Models\Reservation;
use App\Models\Book;

class ReservationController {

    public function addReservation($description, $reservation_date, $return_date, $user_id, $book_id)
    {
      // Your existing code remains the same until you retrieve data from the query result
            $book = new Book('','','','','','','','');
            $bookData = $book->getBookById($book_id);

            if ($bookData && $bookData->num_rows > 0) {
                $bookInfo = $bookData->fetch_assoc();
                if ($bookInfo['available_copies'] > 0) {
                    $reservation = new Reservation($description, $reservation_date, $return_date, $user_id, $book_id);
                    $reservation->add();
                    
                    return true; // Reservation successful
                } else {
                    echo "No available copies of the book.";
                    return false; // Reservation unsuccessful
                }
            } else {
                echo "Book not found.";
                return false; // Book not found
            }

                }
}

if (isset($_POST['reserve'])) {
    $reservation_date=date('Y-m-d');
    $reserveController = new ReservationController();
    $reserveController->addReservation($description,$reservation_date, $return_date, $user_id, $book_id);
    header("location:../../views/client/book/show.php");
}

// if (isset($_POST['reserve'])) {
//     // Assuming $description, $return_date, $user_id, and $book_id are defined elsewhere in your code
//     $description = ''; // Replace with actual value
//     $return_date = ''; // Replace with actual value
//     $user_id = ''; // Replace with actual value
//     $book_id = ''; // Replace with actual value
    
//     $reservation_date = date('Y-m-d');
//     $registerController = new ReservationController();
//     $reservationSuccessful = $registerController->addReservation($description, $reservation_date, $return_date, $user_id, $book_id);
    
//     if ($reservationSuccessful) {
//         echo '<script>alert("Reservation successful!");</script>';
//     } else {
//         echo '<script>alert("No available copies of the book.");</script>';
//     }
//     // Redirect to appropriate page after reservation
//     // header("location:../../views/client/home/index.php");
// }
?>
