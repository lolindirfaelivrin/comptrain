<?php


require 'app/database.class.php';
require 'config.php';

$connessione = new Database(DB_USER,DB_NAME,DB_PASS,DB_HOST);


if(isset($_POST['salva'])) {

    $dati = [
        "wodData" => $_POST['wod-data'],
        "wodTitolo" => $_POST['wod-titolo'],
        "wodTesto" => $_POST['wod-testo']
    ];

    if(salvaWod($data)) {
        header("Location: http://demonation.altervista.org/minisiti/comptrain/");
    }

}



function salvaWod($data) {
    $connessione->query('INSERT INTO comptrain (giorno,titolo,testo) VALUES(:giorno, :titolo, :testo)');

    $connessione->bind(':giorno', $data['wodData']);
    $connessione->bind(':titolo', $data['wodTitolo']);
    $connessione->bind(':testo', $data['wodTesto']);

    if ($connessione->executeQuery()) {
        return true;
    } else {
        return false;
    }
  }




