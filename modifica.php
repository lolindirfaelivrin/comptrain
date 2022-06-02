<?php
session_start();

require 'app/database.class.php';
require 'config.php';

$connessione = new Database(DB_USER,DB_NAME,DB_PASS,DB_HOST);

if(isset($_GET['id'])) {
    $datiWod = [
        "wodId" => filter_var( $_GET['id'], FILTER_SANITIZE_NUMBER_INT)
    ];    

    $_SESSION['wodIdModificato'] = $datiWod['wodId'];

    $wod = mostraSingoloWod($datiWod->wodId, $connessione);
}

// ! DAFARE Pulire i campi inviati dal form
if(isset($_POST[])) {

    $datiWod = [
        "wodData" => $_POST['wod-data'],
        "wodTitolo" => $_POST['wod-titolo'],
        "wodTesto" => $_POST['wod-testo'],
        "wodRiferimento" => "Vuoto"
    ];

    if(modificaWod($datiWod, $connessione)) {

        $_SESSION['messaggio'] = 'Wod modificato correttamente';

        header("Location: http://demonation.altervista.org/minisiti/comptrain/vedi.php");
    }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifica i WOD di Comptrain</title>
    <link rel="stylesheet" href="css/stile.css">
</head>
<body>
<header>
	<h1>Comptrain</h1>
	<a href="vedi.php" class="btn btn-outline">elenco wod</a>
</header>
<section class="messaggio">
    <?php if(!empty($_SESSION['messaggio'])): ?>
        <p class="messaggio__testo messaggio__testo-successo"><?php echo $_SESSION['messaggio'];  unset($_SESSION['messaggio']);?></p>
    <?php endif; ?>
</section>
<main>
	<section class="comptrain">
		<section class="comptrain__messaggio">
		</section>
		<form id="form" method="post" action="modifica.php">
			<div class="form-gruppo">
				<label for="wod-data">Data</label>
				<input type="date" id="wod-data" name="wod-data" value="<?php echo $wod->giorno; ?>">
				<span class="nascosto" id="errore-data">Messaggio</span>
			</div>
			<div class="form-gruppo">
				<label for="wod-data-riferimento">Fatto il </label>
				<input type="date" id="wod-data-riferimento" name="wod-data-riferimento">
				<span class="nascosto" id="errore-data-riferiento">Messaggio</span>
			</div>
			<div class="form-gruppo">
				<label for="wod-titolo">Wod Titolo</label>
				<input type="input" id="wod-titolo" name="wod-titolo" value="<?php echo $wod->titolo; ?>">
				<span class="nascosto" id="errore-titolo">Messaggio</span>
			</div>
			<div class="form-gruppo">
				<label for="wod-testo">Wod</label>
				<textarea id="wod-testo" name="wod-testo" cols="30" rows="10"><?php echo $wod->testo; ?></textarea>
				<span class="nascosto" id="errore-testo">Messaggio</span>
			</div>
			<input class="btn btn-nero" type="submit" name="salva" value="modifica wod" id="salva">
		</form>
	</section>
</main>
<footer class="footer">
	Versione: 0.1.3
</footer>

</body>
</html>


<?php

function mostraSingoloWod($datiWod, $database) {
    $database->query('SELECT * FROM comptrain WHERE id=:id');

    $database->bind(':id', $datiWod['wodId']);

    return $database->singleRow();

  }

function modificaWod($datiWod, $database) {
    $database->query('UPDATE comptrain SET giorno = :giorno, titlo = :titolo, testo = :testo WHERE id=:id');

    $database->bind(':giorno', $datiWod['wodData']);
    $satabase->bind(':titolo', $datiWod['wodTitolo']);
    $database->bind(':testo', $datiWod['wodTesto']);
    $database->bind(':id', $datiWod['wodId']);

    if ($database->executeQuery()) {
        return true;
    } else {
        return false;
    }

}


?>