<?php
// 1. Pročitajte podatke iz datoteke polaznici.json, te ih ispišite u HTML tablicu.
// 2. Dodajte novog polaznika u datoteku polaznici.json, te podatke iz nje ponovo ispišite.


$polaznici = file_get_contents(__DIR__ . '/podaci/polaznici.json');
$polazniciArray = json_decode($polaznici, true);

function ispisPolaznika($polazniciArray)
{
?>
    <table border="1px">
        <tr>
            <th> Ime </th>
            <th> Prezime </th>
            <th> Godine </th>
            <th> Email </th>
            <th> Telefon </th>
        </tr>
        <?php foreach ($polazniciArray as $polaznik) : ?>
            <tr>
                <td> <?php echo $polaznik['name']; ?> </td>
                <td> <?php echo $polaznik['surname']; ?> </td>
                <td> <?php echo $polaznik['age']; ?> </td>
                <td> <?php echo $polaznik['email']; ?> </td>
                <td> <?php echo $polaznik['phone']; ?> </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php
};
ispisPolaznika($polazniciArray);

$polazniciArray[] = [
    'name' => 'Sanja',
    'surname' => 'Sanjic',
    'age' => 42,
    'email' => 'sanja.sanjic@gmail.com',
    'phone' => '38598123456',
];

$polaznici = json_encode($polazniciArray);
file_put_contents(__DIR__ . '/podaci/polaznici.json', $polaznici, FILE_APPEND);

ispisPolaznika($polazniciArray);