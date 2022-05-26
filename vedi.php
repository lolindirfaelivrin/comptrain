<?php


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
<section class="tabella">
<table class="tabella__dati">
        <thead>
            <tr>
                <th>Data</th>
                <th>Titolo</th>
                <th>Azioni</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($dati as $wod):  ?>
                <tr>
                    <td><?php echo $wod->giorno   ?></td>
                    <td><?php echo $wod->titolo ?></td>
                    <td><a href="# <?php echo $wod->id ?>" data-id="<?php $wod->id ?>">Vedi</a></td>
                </tr>
            <?php endforeach;   ?>    
        </tbody>
    </table>
</section>

</body>
</html>