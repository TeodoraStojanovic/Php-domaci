<?php

require "../dbbroker.php";
require "../model/book.php";

if (isset($_POST['id'])) {
    $obj = new Book($_POST['id']);
    $status = $obj->deleteById($conn);
}

