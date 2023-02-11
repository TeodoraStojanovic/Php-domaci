<?php

require "../dbbroker.php";
require "../model/book.php";

if (isset($_POST['id']) && isset($_POST['naslov']) && isset($_POST['autor']) && isset($_POST['zanr']) && isset($_POST['cena'])) {
    $status = Book::update($_POST['id'], $_POST['naslov'], $_POST['autor'], $_POST['zanr'], $_POST['cena'], $_POST['username'], $conn);
    if ($status) {
        echo "Success";
    } else {
        echo $status;
        echo "Failed";
    }
}