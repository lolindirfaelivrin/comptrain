<?php
session_start();

require 'app/database.class.php';
require 'config.php';


$connessione = new Database(DB_USER,DB_NAME,DB_PASS,DB_HOST);

$sql = $connessione->query("SELECT * FROM comptrain");

$dati = $connessione->resultSet($sql);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vedi i WOD di Comptrain</title>
    <link rel="stylesheet" href="css/stile.css">
</head>
<body>
<header>
	<h1>Comptrain</h1>
	<a href="index.html" class="btn btn-outline">Aggiungi</a>
</header>
<section class="messaggio">
    <?php if(!empty($_SESSION['messaggio'])): ?>
        <p class="messaggio__testo messaggio__testo-successo"><?php echo $_SESSION['messaggio'];  unset($_SESSION['messaggio']);?></p>
    <?php endif; ?>
</section>
<section class="tabella">
<table class="tabella__dati">
        <thead>
            <tr>
                <th>Data</th>
                <th>Titolo</th>
                <th colspan="3">Azioni</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($dati as $wod):  ?>
                <tr>
                    <td><?php echo $wod->giorno   ?></td>
                    <td><?php echo $wod->titolo ?></td>
                    <td><a href="modifica.php?id=<?php echo $wod->id ?>" data-id="<?php echo $wod->id ?>">Modifica</a></td>
                    <td><a href="elimina.php?id=<?php echo $wod->id ?>" data-id="<?php echo $wod->id ?>">Elimina</a></td>
                    <td><a href="dettaglio.php?id=<?php echo $wod->id ?>" data-id="<?php echo $wod->id ?>">Dettaglio</a></td>
                </tr>
            <?php endforeach;   ?>    
        </tbody>
    </table>
</section>

</body>
</html>