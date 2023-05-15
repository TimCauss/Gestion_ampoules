<?php 
require_once("connect.php");

$sql ="SELECT * FROM ampoules";
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
    <link rel="stylesheet" href="CSS/style.css">
    <title>Gestionnaire d'amoules</title>
</head>
<body>
    <header>
        <h1>GESTION DES AMPOULES</h1>
        <nav><button class="trigger" href="add.php">Add</button></nav>
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
                <td>
                    <a href="del?id=<?= $row["id"]?>.php">
                        <svg width="11" height="13" viewBox="0 0 11 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4.78571 0.785713C4 0.785713 3.35714 1.42857 3.35714 2.21428H1.92857C1.14286 2.21428 0.5 2.85714 0.5 3.64286H10.5C10.5 2.85714 9.85714 2.21428 9.07143 2.21428H7.64286C7.64286 1.42857 7 0.785713 6.21429 0.785713H4.78571ZM1.92857 5.07143V11.9429C1.92857 12.1 2.04286 12.2143 2.2 12.2143H8.81429C8.97143 12.2143 9.08571 12.1 9.08571 11.9429V5.07143H7.65714V10.0714C7.65714 10.4714 7.34286 10.7857 6.94286 10.7857C6.54286 10.7857 6.22857 10.4714 6.22857 10.0714V5.07143H4.8V10.0714C4.8 10.4714 4.48571 10.7857 4.08571 10.7857C3.68571 10.7857 3.37143 10.4714 3.37143 10.0714V5.07143H1.94286H1.92857Z"/>
                        </svg>
                    </a>
                    <a href="edit?id=<?= $row["id"]?>.php">
                    <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M8 0.5L6.75 1.75L9.25 4.25L10.5 3L8 0.5ZM5.5 3L0.5 8V10.5H3L8 5.5L5.5 3Z"/>
                    </svg>
                    </a>
                </td>
            <?php
            }
            ?>
        </tbody>
    </table>
    </main>

    <section class="modal">

    </section>
</body>
</html>