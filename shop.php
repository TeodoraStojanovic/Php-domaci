<?php

require 'dbbroker.php';
require 'model/book.php';

session_start();
if (!isset($_SESSION['user_admin'])) {
    header('Location: index.php');
    exit();
}

$rezultat = Book::getAll($conn);

if (!$rezultat) {
    echo "Nastala je greska prilikom preuzimanja podataka!";
    die();
}
if ($rezultat->num_rows == 0) {
    echo "Nema proizvoda!";
    die();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/shop.css">
    <title>Shop</title>
</head>
<body>

<div class="jumbotron" style="color: black;">
        <h1>Bookshop</h1>
    </div>

    <div id="pregled" class="panel panel-success" style="margin-top: 1%;">

<div class="panel-body">
    <table id="myTable" class="table sortable table-hover table-striped" style="color: black; background-color: rgb(109, 79, 79); margin-bottom: 0px;">
        <thead class="thead">
            <tr>
                <th scope="col">Naslov</th>
                <th scope="col">Autor</th>
                <th scope="col">Zanr</th>
                <th scope="col">Cena</th>
             

            </tr>
        </thead>
        <tbody id="tableBody">
            <?php
            while ($red = $rezultat->fetch_array()) {
            ?>
                <tr id="tr-<?php echo $red["id"] ?>">
                    <td><?php echo $red["naziv"] ?></td>
                    <td><?php echo $red["autor"] ?></td>
                    <td><?php echo $red["zanr"] ?></td>
                    <td><?php echo $red["cena"] ?></td>
                    <td>
                        <label class="custom-radio-btn">
                            <input type="radio" name="cekiran" value=<?php echo $red["id"] ?>>
                            <span class="checkmark"></span>
                        </label>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<div class="col-md-3" style="text-align: right;">
    <button id="btn-dodaj" class="btn btn-primary btn-block" data-toggle="modal" data-target="#dodajModal ">Dodaj</button>
</div>

<div class=" col-md-3" style="text-align: right">
    <button id="btn-izmeni" class="btn btn-primary btn-block" onclick="postaviPodatke()" data-toggle="modal" data-target="#izmeniModal">Izmeni</button>
</div>

<div class="col-md-3" style="text-align: right">
    <button id="btn-obrisi" class="btn btn-primary btn-block">Obrisi</button>
</div>

<div class=" col-md-3" style="text-align: right;">
    <button id="btn-sortiraj" class="btn btn-primary btn-block" onclick="sortTable()">Sortiraj</button>
</div>

</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>