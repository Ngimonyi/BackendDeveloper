<?php

$uploadDir = __DIR__ . '/uploads';

if (!empty($_FILES)) {
    if (is_dir($uploadDir) === false) {
        mkdir($uploadDir);
    }

    $file = $_FILES['datoteka']['name'];
    $fileName = $uploadDir . '/' . $file;

    if (move_uploaded_file($_FILES['datoteka']['tmp_name'], $fileName)) {
        echo 'File dodan';
        echo "<a href=uploads/$file>Prikazi</a>";
    }else {
        echo 'Problem kod file uploada.';
    }
}
?>

<!DOCTYPE html>
<html>
<body>

    <h2>File Upload</h2>

    <form method="POST" enctype="multipart/form-data">

        <label for="datoteka">Datoteka:</label><br>
        <input type="file" id="datoteka" name="datoteka"><br>

        <input type="submit" value="Pošalji">

    </form> 

</body>
</html>