<?php

// var_dump($_REQUEST);
// var_dump($_POST);
var_dump($_GET);

?>

<!-- primjer URL-a sa get parametrima -->
<!-- get.php?objekt=stolica&subjekt=predavac&tko%20je%20zao=Microsoft -->

<!DOCTYPE html>
<html>
<body>

    <h2>GET Superglobal</h2>

    <form>

        <label for="first_name">Ime:</label><br>
        <input type="text" id="first_name" name="first_name"><br>

        <label for="last_name">Prezime:</label><br>
        <input type="text" id="last_name" name="last_name"><br><br>

        <input type="submit" value="Pošalji">

    </form> 

</body>
</html>