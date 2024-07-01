<?php

$books = file_get_contents(__DIR__ . '/podaci/knjige.json');

var_dump($books);

$books = json_decode($books, true);

var_dump($books);