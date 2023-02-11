<?php

class Book
{
    public $id;
    public $naslov;
    public $autor;
    public $zanr;
    public $cena;
    public $username;

    public function __construct($id = null, $naslov = null, $autor = null, $zanr = null, $cena = null, $username = null)
    {
        $this->id = $id;
        $this->naslov = $naslov;
        $this->autor= $autor;
        $this->zanr = $zanr;
        $this->cena = $cena;
        $this->username = $username;
    }

    public static function getAll($conn)
    {
        $query = "SELECT * FROM books";
        return $conn->query($query);
    }

    public function deleteById(mysqli $conn)
    {
        $query = "DELETE FROM books WHERE id=$this->id";
        return $conn->query($query);
    }

    public static function add(Book $bookQ, mysqli $conn)
    {
        $query = "INSERT INTO books (naslov,autor,zanr,cena,username) VALUES ('$bookQ->naslov', '$bookQ->autor', '$bookQ->zanr', '$bookQ->cena', '$bookQ->username')";
        return $conn->query($query);
    }
    public static function update($idU, $naslovU, $autorU, $zanrU, $cenaU,$usernameU, mysqli $conn)
    {
        $query = "UPDATE books SET naslov='$naslovU', autor='$autorU', zanr='$zanrU',cena='$cenaU',username='$usernameU' WHERE id='$idU'";
        return $conn->query($query);
    }
    public static function sort(mysqli $conn)
    {
        $query = "SELECT * FROM books ORDER BY naslov ASC";
        return $conn->query($query);
    }

    public static function getById($id, mysqli $conn)
    {
        $query = "SELECT * FROM books WHERE id=$id";
        $array = array();
        if ($result = $conn->query($query)) {

            while ($row = $result->fetch_array(1)) {
                $array[] = $row;
            }
        }
        return $array;
    }
}