<?php


require 'app/database.class.php';
require 'config.php';

$connessione = new Database(DB_USER,DB_NAME,DB_PASS,DB_HOST);


if(isset($_POST['salva'])) {

    $dati = [
        "data" => $_POST['data'],
        "titolo" => $_POST['titolo'],
        "testo" => $_POST['testo']
    ];

    register($data);

}



function register($data) {
    $this->connessione->query('INSERT INTO comptrain (data,titolo,testo) VALUES(:data, :titolo, :testo)');

    $this->db->bind(':data', $data['data']);
    $this->db->bind(':titolo', $data['titolo']);
    $this->db->bind(':testo', $data['testo']);

    if ($this->connessione->executeQuery()) {
        return true;
    } else {
        return false;
    }
  }




