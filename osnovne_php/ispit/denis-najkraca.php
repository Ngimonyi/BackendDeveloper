<?php

const FILE_PATH = __DIR__ . "/Podaci/words.json";

$words = [];

if (file_exists(FILE_PATH)) {
    $existingData = file_get_contents(FILE_PATH);
    $words = json_decode($existingData, true);
}

$wordList = $words;

if (!empty($_POST['input'])) {
    $input = $_POST['input'];
    $wordList = wordManipulation($input, $words);
}

function wordManipulation($input, $words)
{
    if (ctype_alpha($input)) {
        $length = strlen($input);
        $vowels = preg_match_all('/[aeiou]/i', $input);
        $consonants = $length - $vowels;

        $word = [
            'word' => $input,
            'length' => $length,
            'vowels' => $vowels,
            'consonants' => $consonants
        ];

        $words[] = $word; 
        $encodedWords = json_encode($words);
        file_put_contents(FILE_PATH, $encodedWords);
    }

    return $words; 
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>probni parcijalni</title>
</head>

<body>
    <form method="post">
        <label>Upišite riječ:</label>
        <br>
        <input type="text" name="input">
        <br>
        <br>
        <input type="submit" value="Pošalji">
        <br>
    </form>

    <table border="1">
        <thead>
            <tr>
                <th>Riječ</th>
                <th>Broj slova</th>
                <th>Broj suglasnika</th>
                <th>Broj samoglasnika</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($wordList)) : ?>
                <?php foreach ($wordList as $rijec) : ?>
                    <tr>
                        <td><?= $rijec['word']; ?></td>
                        <td><?= $rijec['length']; ?></td>
                        <td><?= $rijec['consonants']; ?></td>
                        <td><?= $rijec['vowels']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="4">Niste uspisali nijednu riječ</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>