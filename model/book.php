<?php

class Book
{
    public $id;
    public $naziv;
    public $autor;
    public $zanr;
    public $cena;
    public $username;

    public function __construct($id = null, $naziv = null, $autor = null, $zanr = null, $cena = null, $username = null)
    {
        $this->id = $id;
        $this->naziv = $naziv;
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

}