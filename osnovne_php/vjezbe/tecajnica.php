<?php

// 2.
// Dovrsiti zadatak tecajnica.php
// napravit web formu za konverziju EUR u USD
// korisink u formu upisuje iznos u eurima i nakon submita
// vi ispisujete konvertiranu vrijdnost

function prettyPrint(array $print): void
{
    echo "<pre>";
    print_r($print);
    echo "</pre>";
}

const URL = 'https://www.hnb.hr/tecajn-eur/htecajn.htm';

$lista = file(URL);

array_shift($lista);

foreach($lista as $valutniRedak){
    if (str_contains($valutniRedak, 'USD')) {
        break;
    }
}

$usdValues = explode('       ', $valutniRedak);

$usdSrednjiTecaj = str_replace(',', '.', $usdValues[2]); // Zamjena decimalne točke

// Konverzija iz EUR u USD
function konvertirajEURuUSD($iznosEUR, $tecajEURUSD) {
    return $iznosEUR * $tecajEURUSD;
}

// Provjera je li poslana forma
if ($_POST) {
    // Provjera je li unesen iznos u EUR
    if (!empty($_POST["eur"]) && is_numeric($_POST["eur"])) {
        $iznosEUR = $_POST["eur"];
        $iznosUSD = konvertirajEURuUSD($iznosEUR, $usdSrednjiTecaj);
        // Formatiranje iznosa u USD s dvije decimale
        $iznosUSDFormatiran = number_format($iznosUSD, 2, '.', '');
        echo "Iznos od $iznosEUR EUR je jednak $iznosUSDFormatiran USD po srednjem tečaju HNB-a.";
    } else {
        echo "Molimo unesite ispravan iznos u EUR.";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Konverter valuta</title>
</head>
<body>
    <h2>Konverter valuta EUR u USD</h2>
    <form action="" method="post">
        Unesite iznos u EUR: <input type="text" name="eur"><br><br>
        <input type="submit" value="Konvertiraj">
    </form>
</body>
</html>