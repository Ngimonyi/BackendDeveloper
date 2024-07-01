<?php

var_dump(time());

$expiresIn = time() + 60 * 60;

setcookie('user', 'Aleksandar', $expiresIn, '/');


var_dump($_COOKIE);

setcookie('user', 'kjhkb', time() - 60 * 60, '/');