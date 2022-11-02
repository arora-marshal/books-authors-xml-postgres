Problem : 

There is a tree of start folder, it&#39;s subfolders, their subfolders, etc...
In each folder, subfolder, etc… there are same structured XML files stored.

1. Read XML parsed content into a data base table:
* PHP script should read XML files information and add it to PostgreSQL two
database tables: “authors” and “books”  
2. XML files should contain Cyrilic, Korean and Japanese symbols.
3. Create simple page with a search form (should search by author only from data base).
Result should be printed right after search form.

Please do database connectivity in file /Models/Book.php before working.


1. index.html is the first page loaded.
2. It will hit ajax request to books.php on root, where all the xmls files are read and the array of books and its author is created, which is further checked in db if present updated else created records in pg database.
3. Now fetch all the records from pg database and returned as json which is then parsed and displayed on homepage ( indes.html )
4. There is search form in the right side of this display records in table.
5. you can search by author name, and it will display all the books related to that author.

/public/css/style.css -  it has basic css for table design
/public/js/custom.js - it has ajax requests which are called on index.html
Controllers/Xml.php -  it has code to read content from xml files
/Models/Book.php -  it has all the logic for add, update or search records from pg db

![alt text](https://github.com/arora-marshal/books-authors-xml-postgres/blob/main/screenshot1.png)
![alt text](https://github.com/arora-marshal/books-authors-xml-postgres/blob/main/screenshot2.png)
![alt text](https://github.com/arora-marshal/books-authors-xml-postgres/blob/main/screenshot3.png)
