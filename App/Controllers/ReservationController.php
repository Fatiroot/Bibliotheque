<?php
namespace App\Controllers;
include __DIR__ . '/../../vendor/autoload.php';
use App\Models\Book;
use App\Models\Reservation;


class ReservationController {
    public function addReservation($description, $reservation_date, $return_date, $is_returned, $user_id, $book_id)
{
    $bookModel = new Book('', '', '', '', '', '', '', '');
    $bookResult = $bookModel->getBookById($book_id);

    // Check if the query executed successfully
    if ($bookResult  && $bookResult->num_rows > 0) {
        $book = $bookResult->fetch_assoc(); // Fetch the book details

        if ($book['available_copies'] > 0) {
            $newAvailableCopies = $book['available_copies'] - 1;
            $bookModel->updateAvailableCopies($book_id, $newAvailableCopies);

            $reservationModel = new Reservation($description, $reservation_date, $return_date, $is_returned, $user_id , $book_id);
             
            if ($reservationModel->addReservation()) {
                return "Reservation added successfully!";
            } else {
                $bookModel->updateAvailableCopies($book_id, $book['available_copies']);
                return "Error adding reservation!";
            }
        } else {
            return "No available copies of the book.";
        }
    } else {
        return "Book not found or query failed.";
    }
}
}

if (isset($_POST['reserve'])) {
    $description='reserved';
    $user_id = $_POST['user_id'];
    $book_id = $_POST['book'];
    $reservation_date = $_POST['reservation_date'];
    $return_date = $_POST['return_date'];
    
    $reservationController = new ReservationController();

    $result = $reservationController->addReservation($description, $reservation_date, $return_date, 0, $user_id, $book_id);
var_dump($result);
die();
    if ($result === true) {
        header("location:../../views/client/book/show.php");
        exit();
    } else {
        echo "Failed to add reservation.";
    }
} else {
    echo "Form not submitted properly.";
}
?>
