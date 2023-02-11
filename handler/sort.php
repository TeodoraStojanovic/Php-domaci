<?php

require "../dbbroker.php";
require "../model/book.php";

$rezultat = Book::sort($conn);

if (!$rezultat->num_rows == 0) {
    while ($red = $rezultat->fetch_array()) {
        echo json_encode($red);
    }
} else {
    echo "Failed";
}
