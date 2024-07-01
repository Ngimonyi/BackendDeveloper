<?php

// napravit funkciju koja prima ime,prezime (pErO,pReIc) i kao rezulata vraca P. Preic

function formatName(string $name)
{
    $nameArray = explode(',', $name);

    $name = $nameArray[0];
    $surname = $nameArray[1];
    $surname = ucfirst(mb_strtolower($surname));

    $firstLetter = substr($name, 0, 1);
    $firstLetter = mb_strtoupper($firstLetter);

    return "$firstLetter. $surname";
}

$formattedName = formatName('pErO,pErIć');

echo $formattedName;



function prettyPrint(array $print): void
{
    echo "<pre>";
    print_r($print);
    echo "</pre>";
}