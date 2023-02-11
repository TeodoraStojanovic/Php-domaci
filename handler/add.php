<?php

require "../dbbroker.php";
require "../model/book.php";

if (isset($_POST['naslov']) && isset($_POST['autor']) && isset($_POST['zanr']) && isset($_POST['cena'])) {
    $book = new Book(null, $_POST['naslov'], $_POST['autor'], $_POST['zanr'], $_POST['cena'], $_POST['username']);
    $status = Book::add($book, $conn);
}