<?php
session_start();

require 'app/database.class.php';
require 'config.php';

$connessione = new Database(DB_USER,DB_NAME,DB_PASS,DB_HOST);


if(isset($_POST[])) {

    $datiWod = [
        "wodData" => $_POST['wod-data'],
        "wodTitolo" => $_POST['wod-titolo'],
        "wodTesto" => $_POST['wod-testo']
    ];

    if(salvaWod($datiWod, $connessione)) {

        $_SESSION['messaggio'] = 'Wod salvato correttamente';

        header("Location: http://demonation.altervista.org/minisiti/comptrain/vedi.php");
    }

}



function salvaWod($valori, $satabase) {
    $satabase->query('INSERT INTO comptrain (giorno,titolo,testo) VALUES(:giorno, :titolo, :testo)');

    $satabase->bind(':giorno', $valori['wodData']);
    $satabase->bind(':titolo', $valori['wodTitolo']);
    $satabase->bind(':testo', $valori['wodTesto']);

    if ($satabase->executeQuery()) {
        return true;
    } else {
        return false;
    }
  }




