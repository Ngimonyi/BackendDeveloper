<?php

const FILE_PATH = __DIR__ . '/words.json';

$words = file_get_contents(FILE_PATH);

var_dump($words);

$words = json_decode($words, true);

var_dump($words);

if(isset($_GET['sendWord'])){
    if(empty($_GET['word'])){
        echo "Upisite neku vrijednost";
    }else{
        $wordLen = mb_strlen($_GET['word']);
        echo $wordLen;
        $samo = izbrojiSamoglasnike($_GET['word']);
        echo $samo;
        $su = $wordLen - $samo;
        $$words = [
            "word" => $_GET['word'],
            "wordLen" => $wordLen,
            "su" => $su,
            "samo" => $samo
        ];
        $words = json_encode($words);
        file_put_contents(FILE_PATH, $words);
    }
}




function izbrojiSamoglasnike($word) {
    $pattern = '/[aeiouAEIOU]/';
    preg_match_all($pattern, $word, $matches);
    return count($matches[0]);
}





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <form action="parcijalni_ispit_PHP.php" method="get">
        <label for="word">Upišite riječ</label>    
        <input type="text" name="word">
        <input type="submit" name="sendWord" value="Pošalji">
    </form>
    <table border="1">
        <tbody >
            <tr>
                <php
                    if(){
                        foreach
                        <th>Riječ</th>
                        <th>Broj slova</th>
                        <th>Broj suglasnika</th>
                        <th>Broj samoglasnika</th>
                    }
                ?>
            </tr>
        </tbody>
    </table>
</body>
</html>