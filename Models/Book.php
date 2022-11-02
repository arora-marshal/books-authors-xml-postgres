<?php

namespace Models;

class Book
{
    private $host = 'localhost';
    private $port = 5432;
    private $dbName = 'bookpg';
    private $user = 'postgres';
    private $password = 'redhat';

    private $connection;

    public function __construct()
    {
        $this->connection = pg_connect("host=$this->host port=$this->port dbname=$this->dbName user=$this->user password=$this->password");
    }

    public function getDbConn()
    {
        return $this->connection;
    }

    public function searchAuthor($words)
    {
        $sql = "SELECT author, name FROM books WHERE author ILIKE '%$words%'";
        $query = pg_query($this->getDbConn(), $sql);
        $results = pg_fetch_all($query);
        return $results;
    }

    public function checkAuthorExists($authorName)
    {
        $sqlCheckAuthor = "SELECT author FROM books WHERE author ILIKE '%$authorName%'";
        $query = pg_query($this->getDbConn(), $sqlCheckAuthor);

        if (pg_num_rows($query) > 0) {
            return true;
        }
        return false;
    }

    public function getRow($authorName)
    {
        $sqlGetRow = "SELECT * FROM books WHERE author = '" . $authorName . "'";
        $query = pg_query($this->getDbConn(), $sqlGetRow);

        return pg_fetch_assoc($query);
    }

    public function updateBook($id)
    {
        $sqlUpdateDate = "Update books SET date_added = '" . date("Y-m-d H:i:s") . "' WHERE id = '" . (int)$id . "'";
        $query = pg_query($this->getDbConn(), $sqlUpdateDate);
    }

    public function addBook($book)
    {
        $author = $book['author'];
        $name = $book['name'];
        $time = date('Y-m-d H:i:s');

        $sqlAddBook = "INSERT INTO books(author, name, date_added) VALUES ( '$author', '$name', '$time')";

        $query = pg_query($this->getDbConn(), $sqlAddBook);
    }

    public function getAllBooks()
    {
        $results = pg_query($this->getDbConn(), 'SELECT * FROM books');

        if (pg_num_rows($results) > 0) {
            $results = pg_fetch_all($results);
        }

        return $results;
    }
}
