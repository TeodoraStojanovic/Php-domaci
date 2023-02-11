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
}