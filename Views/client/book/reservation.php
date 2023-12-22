<?php

// include __DIR__ . '/../../../App/Models/User.php';
include __DIR__ . '/../../../vendor/autoload.php';


use App\Controllers\BookController;

$id=$_GET['reserverId'];
$bookController = new BookController();
$Book = $bookController->selectBookById($id);

?>

  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  </head>
  <body>
             <form method="POST" action="../../../App/Controllers/ReservationController.php" enctype="multipart/form-data" style="width:50vw; min-width:300px;">
                <div class="mb-3">
                    <label class="form-label">Choose a book:</label>
                    <select name="book" class="form-select" required>
                            <option value="<?= $Book['id']; ?>"><?= $Book['title']; ?></option>
                    </select>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">Reservation date:</label>
                        <input type="date" class="form-control" name="reservation_date" required>
                    </div>
                    <div class="col">
                        <label class="form-label">Return date:</label>
                        <input type="date" class="form-control" name="return_date" required max="<?php echo date('Y-m-d', strtotime('+15 days')); ?>">
                    </div>
                </div>



                <div class="row ms-1 mt-4 justify-content-center">
                    <button type="submit" name="add_reservation_submit" class="btn btn-success col-3 me-3">Save changes</button>
                    <a href="showBooks.php" class="btn btn-danger col-3">Cancel</a>
                </div>

            </form>
  </body>
  </html>

