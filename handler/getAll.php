<?php

require "../dbbroker.php";
require "../model/book.php";

$rezultat = Book::getAll($conn);


if ($rezultat) {
    while ($red = $rezultat->fetch_array()) {
        echo json_encode($red);
    }
} else {
    echo "Failed";
}
