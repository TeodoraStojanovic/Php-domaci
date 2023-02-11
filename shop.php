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
                    <td><?php echo $red["naslov"] ?></td>
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
<a href="logout.php" class="label label-danger" style="font-size:16px; background-color: rgb(63, 44, 44); position: fixed; bottom:0; right:0; float:right">Logout</a>
 </div>
</div>
<!-- dodaj -->

<div class="modal fade" id="dodajModal" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="#" method="post" id="dodajForm">
                            <h3 style="color: black; text-align:left">Dodaj knjigu</h3>
                            <div class="row">
                                <div class="col-md-11 ">
                                    <div class="form-group" style="display: none;">
                                        <input id="username" type="text" name="username" class="form-control" value="<?php echo $_SESSION['user_admin'] ?>" readonly />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Naslov</label>
                                        <input type="text" style="border: 1px solid black margin-left: 30px " name="naslov" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Autor</label>
                                        <input type="text" style="border: 1px solid black" name="autor" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Zanr</label>
                                        <input type="text" style="border: 1px solid black" name="zanr" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label for="">Cena</label>
                                        <input type="text" style="border: 1px solid black" name="cena" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <button id="btnDodaj" type="submit" class="btn btn-success btn-block" style="background-color:  rgb(63, 44, 44); border: 1px solid black;">Dodaj</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- izmeni -->
    <div class="modal fade" id="izmeniModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="#" method="post" id="izmeniForm">
                            <h3 style="color: black">Izmeni proizvod</h3>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input id="username" type="text" name="username" class="form-control" value="<?php echo $_SESSION['user_admin'] ?>" readonly />
                                    </div>
                                    <div class="form-group">
                                        <input id="id" type="text" name="id" class="form-control" placeholder="Id *" value="" readonly />
                                    </div>
                                    <div class="form-group">
                                        <input id="naslov" type="text" name="naslov" class="form-control" placeholder="Naslov*" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input id="autor" type="text" name="autor" class="form-control" placeholder="Autor *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input id="zanr" type="text" name="zanr" class="form-control" placeholder="Zanr *" value="" />
                                    </div>
                                    <div class="form-group">
                                        <input id="cena" type="text" name="cena" class="form-control" placeholder="Cena *" value="" />
                                    </div>
                                    <div class="form-group">
                                    <div class="form-group">
                                        <button id="btnIzmeni" type="submit" class="btn btn-success btn-block" style="color: white; background-color:  rgb(63, 44, 44); border: 1px solid white"> Izmeni</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 

     <script src="js/script.js"></script>
</body>
</html>