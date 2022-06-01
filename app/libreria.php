<?php

/**
 * FUNZIONI DI GESTIONE:
 * 
 *  - salvaWod($datiWod, $database)
 *  - mostraSingoloWod($datiWod, $database)
 *  - modificaWod($datiWod, $database)
 *  - eliminaWod($datiWod, $database)
 */


/**
 * @param array $datiWod array con i dati del wod
 * @param string $database link di connessione al database
 * @return bool
 */
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

 /**
 * @param array $datiWod array con i dati del wod
 * @param string $database link di connessione al database
 * @return array
 */ 
  function mostraSingoloWod($datiWod, $database) {
    $database->query('SELECT * FROM comptrain WHERE id=:id');

    $database->bind(':id', $datiWod['wodId']);

    return $database->singleRow();

  }

/**
 * @param array $datiWod array con i dati del wod
 * @param string $database link di connessione al database
 * @return bool
 */
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

/**
 * @param array $datiWod array con i dati del wod
 * @param string $database link di connessione al database
 * @return bool
 */
function eliminaWod($datiWod, $database) {
    $database->query('DELETE FROM comptrain WHERE id = :id');

    $satabase->bind(':id', $datiWod['wodId']);

    if ($database->executeQuery()) {
        return true;
    } else {
        return false;
    }
  }