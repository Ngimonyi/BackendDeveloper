<?php

// 3.
// Napraviti kalkulator koji koristi 4 osnovne
// matematicke funkcije koristenjem web formi

    const OPERATORS = ['/','*','+','-','%'];

    function calculate($input)
    {
        $num1 = null;
        $num2 = null;

        foreach (OPERATORS as $operator) {
            if (str_contains($input, $operator)) {
                $operands = explode($operator, $input);
                $num1 = $operands[0];
                $num2 = $operands[1];
                break;
            }
        }

        if ($num1 === null) {
            return "Please input a correct mathemalical expression";
        }        

        switch ($operator) {
            case "+":
                $result = $num1 + $num2;
                break;
            case "-":
                $result = $num1 - $num2;
                break;
            case "*":
                $result = $num1 * $num2;
                break;
            case "%":
                $result = $num1 % $num2;
                break;
            case "/":
                if ($num2 != 0) {
                    $result = $num1 / $num2;
                } else {
                    $result = "Nije moguće dijeliti s nulom";
                }
                break;
            default:
                $result = "Nepoznata operacija";
        }

        return $result;
    }

?>

<!DOCTYPE html>
<html>
<body>

    <h2>Kalkulator</h2>

    <form method="POST">

        <label for="input">Unesite izraz</label><br>
        <input type="text" id="input" name="input">
        <?php

            if (!empty($_POST['input'])) {
                echo " = " . calculate($_POST['input']);
            }

        ?>
        <br><br>
        <input type="submit" value="Izracunaj">

    </form> 

</body>
</html>