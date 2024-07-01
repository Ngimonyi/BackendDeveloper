
<?php

$connection = mysqli_connect('localhost', 'algebra', 'algebra', 'videoteka');

if($connection === false){
    die("Connection failed: ". mysqli_connect_error());
}

$sql = "SELECT
    f.naslov AS naslov_filma,
    f.godina AS godina_filma,
    z.ime AS zanr,
    COUNT(f.id) AS broj_posudbi
FROM
    filmovi f
    JOIN zanrovi z ON f.zanr_id = z.id
    JOIN kopija k ON k.film_id = f.id
    JOIN posudba_kopija pk ON pk.kopija_id = k.id
    JOIN posudba ps ON pk.posudba_id = ps.id
WHERE ps.datum_posudbe > '2024-01-01'
GROUP BY k.film_id
ORDER BY broj_posudbi DESC
LIMIT 3;";

$result = mysqli_query($connection, $sql);

if (mysqli_num_rows($result) === 0) {
    die("There are no results for this query in our datbase!");
}

$popularMovies = mysqli_fetch_all($result, MYSQLI_ASSOC);

$sqlZanrovi = "SELECT f.*, z.ime as zanr from filmovi f JOIN zanrovi z ON f.zanr_id = z.id;";
$result = mysqli_query($connection, $sqlZanrovi);

if (mysqli_num_rows($result) === 0) {
    die("There are no results for this query in our datbase!");
}
$filmoviPoZanrovima = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_close($connection);
var_dump($filmoviPoZanrovima); die();

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Members</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="stylesheet" href="assets/styles.css">
    </head>
    <body>
        <header class="p-3 text-body-secondary">
            <div class="container">
                <div class="d-flex gap-2 flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <a href="/" class="d-flex align-items-center text-body-emphasis text-decoration-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="32" class="me-2" viewBox="0 0 118 94" role="img"><title>Bootstrap</title><path fill-rule="evenodd" clip-rule="evenodd" d="M24.509 0c-6.733 0-11.715 5.893-11.492 12.284.214 6.14-.064 14.092-2.066 20.577C8.943 39.365 5.547 43.485 0 44.014v5.972c5.547.529 8.943 4.649 10.951 11.153 2.002 6.485 2.28 14.437 2.066 20.577C12.794 88.106 17.776 94 24.51 94H93.5c6.733 0 11.714-5.893 11.491-12.284-.214-6.14.064-14.092 2.066-20.577 2.009-6.504 5.396-10.624 10.943-11.153v-5.972c-5.547-.529-8.934-4.649-10.943-11.153-2.002-6.484-2.28-14.437-2.066-20.577C105.214 5.894 100.233 0 93.5 0H24.508zM80 57.863C80 66.663 73.436 72 62.543 72H44a2 2 0 01-2-2V24a2 2 0 012-2h18.437c9.083 0 15.044 4.92 15.044 12.474 0 5.302-4.01 10.049-9.119 10.88v.277C75.317 46.394 80 51.21 80 57.863zM60.521 28.34H49.948v14.934h8.905c6.884 0 10.68-2.772 10.68-7.727 0-4.643-3.264-7.207-9.012-7.207zM49.948 49.2v16.458H60.91c7.167 0 10.964-2.876 10.964-8.281 0-5.406-3.903-8.178-11.425-8.178H49.948z" fill="currentColor"></path></svg>
                        <span class="fs-4">Videoteka</span>
                    </a>
                    
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0 flex-grow-1">
                        <li><a href="#" class="nav-link px-2 text-secondary">Home</a></li>
                        <li><a href="#" class="nav-link px-2 text-dark">Features</a></li>
                        <li><a href="#" class="nav-link px-2 text-dark">Pricing</a></li>
                        <li><a href="#" class="nav-link px-2 text-dark">FAQs</a></li>
                        <li><a href="#" class="nav-link px-2 text-dark">About</a></li>
                    </ul>
                    <div class="text-end">
                        <button type="button" class="btn btn-primary me-2">Login</button>
                        <button type="button" class="btn btn-warning">Sign-up</button>
                    </div>
                </div>
            </div>
        </header>
        <main>
            <div class="container py-4">
                <div class="p-5 mb-4 bg-body-tertiary rounded-3">
                    <div class="container-fluid py-5">
                        <h1 class="display-5 fw-bold">Najpopularniji filmovi</h1>

                        <ul class="list-group my-3">
                            <?php foreach ($popularMovies as $movie): ?>
                                <li class="list-group-item">
                                    <?= $movie['naslov_filma'] ?> (<?= $movie['godina_filma'] ?>) - <?= $movie['zanr'] ?>
                                    <span class="badge text-bg-primary float-end">Hit</span>
                                </li>
                            <?php endforeach ?>
                        </ul>

                        <button class="btn btn-primary btn-lg" type="button">Vidi sve!</button>
                    </div>
                </div>

                <div class="row align-items-md-stretch">
                    <div class="col-md-6">
                        <div class="h-100 p-5 text-bg-dark rounded-3">
                        <h2>Change the background</h2>
                        <p>Swap the background-color utility and add a `.text-*` color utility to mix up the jumbotron look. Then, mix and match with additional component themes and more.</p>
                        <button class="btn btn-outline-light" type="button">Example button</button>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="h-100 p-5 bg-body-tertiary border rounded-3">
                        <h2>Add borders</h2>
                        <p>Or, keep it light and add a border for some added definition to the boundaries of your content. Be sure to look under the hood at the source HTML here as we've adjusted the alignment and sizing of both column's content for equal-height.</p>
                        <button class="btn btn-outline-secondary" type="button">Example button</button>
                        </div>
                    </div>
                </div>

                <footer class="py-3">
                    <ul class="nav justify-content-center border-bottom pb-3 mb-3">
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-secondary">Home</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-secondary">Features</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-secondary">Pricing</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-secondary">FAQs</a></li>
                        <li class="nav-item"><a href="#" class="nav-link px-2 text-secondary">About</a></li>
                    </ul>
                    <p class="text-center text-secondary">© 2024 Company, Inc</p>
                </footer>
            </div>
        </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="assets/main.js"></script>
</body>
</html>