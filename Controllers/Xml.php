<?php

namespace Controllers;


class Xml
{
    public function getFilesContentFromXml($xmlsPath) {
        foreach ($xmlsPath as $xml) {
            $filesContent[] = simplexml_load_file($xml);
        }

        return $filesContent;
    }

    public function getBooksFromContent($filesContent) {
        foreach ($filesContent as $file) {
            $obEn = json_encode($file);
            $obDec = json_decode($obEn, true);
            $books[] = $obDec['book'];
        }

        return $books;
    }
}