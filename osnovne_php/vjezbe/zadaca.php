<?php

// 1.
// Kreirajte datoteku obrazac.php i u njoj kreirajte HTML obrazac za upload datoteke. Obrazac treba poslati podatke na obradu datoteci obrada.php.
// Kreirajte datoteku obrada.php i u njoj dohvatite datoteku te učinite sljedeće:
// Provjerite je li datoteka poslana
// Kreirajte novu mapu u koju ćete pohraniti datoteku
// Provjerite je li poslana datoteka slika
// Pohranite poslanu datoteku.

if ($_FILES && isset($_FILES["datoteka"])) {
    // Provjeri je li datoteka poslana
    if ($_FILES["datoteka"]["error"] === UPLOAD_ERR_OK) {
        // Kreiraj novu mapu ako ne postoji
        $direktorij = 'uploads/';
        if (!file_exists($direktorij)) {
            mkdir($direktorij, 0777, true);
        }


        // Provjeri je li poslana datoteka slika
        // exif_imagetype() // -> Stjepan
        $dozvoljeni_formati = array('jpg', 'jpeg', 'png', 'PNG', 'gif', 'webp');
        $datoteka_info = pathinfo($_FILES['datoteka']['name']);
        $format = strtolower($datoteka_info['extension']);

        
        if (in_array($format, $dozvoljeni_formati)) {
            // Pohrani poslanu datoteku
            $nova_datoteka = $direktorij . basename($_FILES['datoteka']['name']);
            if (move_uploaded_file($_FILES['datoteka']['tmp_name'], $nova_datoteka)) {
                echo 'Datoteka uspješno pohranjena.';
            } else {
                echo 'Došlo je do problema prilikom pohrane datoteke.';
            }
        } else {
            echo 'Dozvoljeni formati datoteka su: jpg, jpeg, png, gif';
        }
    } else {
        echo 'Nije poslana datoteka ili je došlo do greške prilikom prijenosa.';
    }
} else {
    echo 'Nije poslan $_FILES niz ili datoteka nije pravilno postavljena.';
}

 ?>


<!DOCTYPE html>
<html>
<head>
    <title>Obrazac za upload datoteke</title>
</head>
<body>
    <form method="post" enctype="multipart/form-data">
        Odaberite datoteku: <input type="file" name="datoteka">
        <input type="submit" value="Pošalji">
    </form>
</body>
</html>

