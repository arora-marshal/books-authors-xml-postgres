<?php

include_once "./Controllers/Xml.php";
include_once "./Models/Book.php";


// created book object from Book model
$bookModel = new \Models\Book();

// if search is set decode it and check for author match in database and send json result and exit the code execution
if (isset($_GET['search'])) {
    $words = urldecode($_GET['search']);
    if (trim($words)) {
        $results = $bookModel->searchAuthor($words);
    } else {
        $results = [];
    }
    echo json_encode($results);
    exit;
}

// get all the books from xml files inside xmls directory
$directory = 'xmls';
if (is_dir($directory)) {
    $di = new RecursiveDirectoryIterator('xmls');
}
if (isset($di)) {
    foreach (new RecursiveIteratorIterator($di) as $filename) {
        if ($filename->isDir()) {
            continue;
        }
        $xmlsPath[] = str_replace("\\", "/", $filename->getPathname());
    }
}
$xml = new Controllers\Xml();
if (isset($xmlsPath)) {
    $filesContent = $xml->getFilesContentFromXml($xmlsPath);
}
if (isset($filesContent)) {
    $books = $xml->getBooksFromContent($filesContent);
}

// if we have books from xml check if the book is already there in the database or not, if it already exists update it otherwise create it
if (isset($books)) {
    $books = call_user_func_array('array_merge', $books);

    foreach ($books as $book) {
        $authorName = $book['author'];
        $authorExists = $bookModel->checkAuthorExists($authorName);

        if ($authorExists) {
            $row = $bookModel->getRow($authorName);

            if (trim($row['name']) == trim($book['name'])) {
                $bookModel->updateBook($row['id']);
            }
        } else {
            $bookModel->addBook($book);
        }
    }
}

// fetch all books to show listing on homepage
$allBooks = $bookModel->getAllBooks();

echo json_encode($allBooks);
