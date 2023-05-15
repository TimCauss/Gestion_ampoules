<?php 
require_once("connect.php");

$sql ="SELECT *, FROM ampoules";
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);


require_once("close.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Gestionnaire d'amoules</title>
</head>
<body>
    <header>
        <h1>GESTION DES AMPOULES</h1>
        <nav><button href="add.php">Add</button></nav>
    </header>

    <main>
    <table>

        <thead>
            <th>Date</th>
            <th>Stage</th>
            <th>Position</th>
            <th>Price</th>
        </thead>

        <tbody>
            <?php
            foreach ($result as $row) {
            ?>
                <td><?= $row["date"] ?></td>
                <td><?= $row["stage"] ?></td>
                <td><?= $row["position"] ?></td>
                <td><?= $row["price"] . " $"?></td>
            <?php
            }
            ?>
        </tbody>
    </table>

    </main>
</body>
</html>