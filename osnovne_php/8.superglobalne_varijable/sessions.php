<?php

session_start();

$_SESSION['user'] = [
    'ime' => 'Aleksandar',
    'adresa' => 5+6
];


var_dump($_SESSION);
