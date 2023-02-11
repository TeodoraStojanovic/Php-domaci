<?php

require "../dbbroker.php";
require "../model/book.php";

if (isset($_POST['id'])) {
    $status = Book::getById($_POST['id'], $conn);
    if ($status) {
        echo json_encode($status);
    } else {
        echo "Failed";
    }
}
