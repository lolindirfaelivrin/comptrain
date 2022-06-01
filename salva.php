<?php
session_start();

require 'app/database.class.php';
require 'config.php';

$connessione = new Database(DB_USER,DB_NAME,DB_PASS,DB_HOST);

// ! DAFARE Pulire i campi inviati dal form
if(isset($_POST[])) {

    $datiWod = [
        "wodData" => $_POST['wod-data'],
        "wodTitolo" => $_POST['wod-titolo'],
        "wodTesto" => $_POST['wod-testo'],
        "wodRiferimento" => "Vuoto"
    ];

    if(salvaWod($datiWod, $connessione)) {

        $_SESSION['messaggio'] = 'Wod salvato correttamente';

        header("Location: http://demonation.altervista.org/minisiti/comptrain/vedi.php");
    }

}


// ! DAFARE Aggiungi campo wod riferito ad altra data
function salvaWod($datiWod, $database) {
    $database->query('INSERT INTO comptrain (giorno,titolo,testo) VALUES(:giorno, :titolo, :testo)');

    $database->bind(':giorno', $datiWod['wodData']);
    $database->bind(':titolo', $datiWod['wodTitolo']);
    $database->bind(':testo', $datiWod['wodTesto']);

    if ($database->executeQuery()) {
        return true;
    } else {
        return false;
    }
  }




