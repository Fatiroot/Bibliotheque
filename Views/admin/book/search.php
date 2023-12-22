<?php
include __DIR__ . '/../../../vendor/autoload.php';

use App\Controllers\BookController;
if (isset($_GET['searchTerm'])) {
    $searchQuery = $_GET['searchTerm'];
    $bookController = new BookController();
    $searchResults = $bookController->searchBooks($searchQuery);
    foreach($searchResults as $searchResult){
        echo "<tr>";
    
        echo "<td>" . $searchResult['title'] . "</td>";
        echo "<td>" . $searchResult['author'] . "</td>";
        echo "<td>" . $searchResult['genre'] . "</td>";
        echo "<td>" . $searchResult['description'] . "</td>";
        echo "<td>" . $searchResult['publication_year'] . "</td>";
        echo "<td>" . $searchResult['total_copies'] . "</td>";
        echo "<td>" . $searchResult['available_copies'] . "</td>";
        
       
        echo "</tr>";
       
    }

}