<?php
session_start();

require 'app/database.class.php';
require 'config.php';

$connessione = new Database(DB_USER,DB_NAME,DB_PASS,DB_HOST);


if(isset($_GET['id'])) {

    $datiWod = [
        "wodId" => filter_var( $_GET['id'], FILTER_SANITIZE_NUMBER_INT)
    ];

    mostraSingoloWod($datiWod, $connession);

}

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="generator" content="Ossicini"/>
  <link rel="stylesheet" href="css/stile.css">
  <title>Comptrain</title>
  <script src="js/app.js" defer></script>
</head>
<body>
<header>
	<h1>Comptrain</h1>
	<a href="vedi.php" class="btn btn-outline">Elenco WOD</a>
</header>
<main>
	<section class="comptrain">
		<section class="comptrain__messaggio">
		</section>
		<form id="form" method="post" action="salva.php">
			<div class="form-gruppo">
				<label for="wod-data">Data</label>
				<input type="date" id="wod-data" name="wod-data">
				<span class="nascosto" id="errore-data">Campo </span>
			</div>
			<div class="form-gruppo">
				<label for="wod-data-riferimento">Confronta con quello in data </label>
				<input type="date" id="wod-data-riferimento" name="wod-data-riferimento">
				<span class="nascosto" id="errore-data-riferiento">Campo </span>
			</div>
			<div class="form-gruppo">
				<label for="wod-titolo">Nome del Wod</label>
				<input type="input" id="wod-titolo" name="wod-titolo">
				<span class="nascosto" id="errore-titolo">Campo </span>
			</div>
			<div class="form-gruppo">
				<label for="wod-testo">Wod</label>
				<textarea id="wod-testo" name="wod-testo" cols="30" rows="10"></textarea>
				<span class="nascosto" id="errore-testo">Campo </span>
			</div>
			<input class="btn btn-nero" type="submit" name="salva" value="salva" id="salva">
		</form>
	</section>
</main>
<footer class="footer">
	Versione: 0.1.8
</footer>
</body>
</html>


<?php

function mostraSingoloWod($datiWod, $database) {
    $database->query('SELECT * FROM comptrain WHERE id=:id');

    $database->bind(':id', $datiWod['wodId']);

    return $database->singleRow();

  }

  ?>