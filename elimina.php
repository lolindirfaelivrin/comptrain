<?php
session_start();

require 'app/database.class.php';
require 'config.php';

$connessione = new Database(DB_USER,DB_NAME,DB_PASS,DB_HOST);


if(isset($_GET['id'])) {

    $datiWod = [
        "wodId" => filter_var( $_GET['id'], FILTER_SANITIZE_NUMBER_INT)
    ];

    if(eliminaWod($datiWod, $connessione)) {

        $_SESSION['messaggio'] = 'Wod eliminato correttamente';

        header("Location: http://demonation.altervista.org/minisiti/comptrain/vedi.php");
    } else {
        $_SESSION['messaggio'] = 'Non è stato possibile eliminare il wod';

        header("Location: http://demonation.altervista.org/minisiti/comptrain/vedi.php");        
    }

}



function eliminaWod($datiWod, $database) {
    $database->query('DELETE FROM comptrain WHERE id = :id');

    $database->bind(':id', $datiWod['wodId']);

    if ($database->executeQuery()) {
        return true;
    } else {
        return false;
    }
  }