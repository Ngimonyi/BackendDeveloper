<?php

$podaci = $_POST;

// var_dump($_POST);

if( !empty($podaci) ){
    echo 'Kliknuto na Posalji<br><br>';

    $ime = $podaci['first_name'];
    $prezime = $podaci['last_name'];

    if (empty($ime)){
        die('Polje Ime je obavezno');
    }

    if ($prezime === ''){
        echo 'Polje Prezime je obavezno';
    }

    echo "Vase ime je $ime a przime $prezime.";

}else{
    echo 'Nije Kliknuto na Posalji';
}

?>