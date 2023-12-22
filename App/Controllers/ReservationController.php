<?php
namespace App\Controllers;
include __DIR__ . '/../../vendor/autoload.php';
use App\Models\Reservation;
use App\Models\Book;

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

    // public function addReservation($description, $reservation_date, $return_date, $user_id, $book_id)
    // {
    //   // Your existing code remains the same until you retrieve data from the query result
    //         $book = new Book('', '', '', '', '', '', '', '');
    //         $bookData = $book->getBookById($book_id);

    //         if ($bookData && $bookData->num_rows > 0) {
    //             $bookInfo = $bookData->fetch_assoc();
    //             if ($bookInfo['available_copies'] > 0) {
    //                 $reservation = new Reservation new Reservation('', '', '', '', '', '');
    //                 $reservation->add();
                    
    //                 return true; // Reservation successful
    //             } else {
    //                 echo "No available copies of the book.";
    //                 return false; // Reservation unsuccessful
    //             }
    //         } else {
    //             echo "Book not found.";
    //             return false; // Book not found
    //         }

    //             }
}

if (isset($_POST['reserve'])) {
    $description='reserved';
    $user_id = $_POST['user_id'];
    $book_id = $_POST['book'];
    $reservation_date = $_POST['reservation_date'];
    $return_date = $_POST['return_date'];
    
    // Create an instance of ReservationController or use static methods
    $reservationController = new ReservationController();

    // Call a method to handle the reservation creation
    $result = $reservationController->addReservation($description, $reservation_date, $return_date, 0, $user_id, $book_id);
var_dump($result);
die();
    if ($result === true) {
        // Redirect to a success page or handle success message
        header("location:../../views/client/book/show.php");
        exit();
    } else {
        // Handle the failure to add reservation
        echo "Failed to add reservation.";
    }
} else {
    echo "Form not submitted properly.";
}
// if (isset($_POST['reserve'])) {
//     $reservation_date=date('Y-m-d');
//     var_dump($_POST['reservation_date'], $_POST['return_date'],0,$_POST['user_id'],$_POST['book']);
//     die();
//     $reserveController = new ReservationController();
//     $reserveController->addReservation('reserved',
//     $_POST['reservation_date'],
//     $_POST['return_date'],
//     0,
//     $_POST['user_id'],
//     $_POST['book']
//     );
    
//     header("location:../../views/client/book/show.php");
// }

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
