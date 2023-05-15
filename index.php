<?php



require_once("connect.php");

$sql = "SELECT * FROM ampoules";
$query = $db->prepare($sql);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);



if (
    $_POST && isset($_POST["create_date"])
    && isset($_POST["stage"])
    && isset($_POST["position"])
    && isset($_POST["price"])
) {

    $create_date = strip_tags($_POST["create_date"]);
    $stage = strip_tags($_POST["stage"]);
    $position = strip_tags($_POST["position"]);
    $price = strip_tags($_POST["price"]);

    $sql_add = "INSERT INTO ampoules
        (create_date, stage, position, price) VALUES
        (:create_date, :stage, :position, :price)";

    $query_add = $db->prepare($sql_add);
    $query_add->bindValue(":create_date", $create_date);
    $query_add->bindValue(":stage", $stage, PDO::PARAM_INT);
    $query_add->bindValue(":position", $position, PDO::PARAM_STR);
    $query_add->bindValue(":price", $price);

    $query_add->execute();
    header("Location: index.php");
}
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
        <nav><button class="modal-trigger" href="add.php">Add</button></nav>
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
                    <tr>
                        <td>
                            <?php
                                $format_date = new DateTime($row["create_date"]);
                                $change_date = $format_date->format('d/m/Y');
                                echo $change_date;
                            ?>
                        </td>
                        <td><?= $row["stage"] ?></td>
                        <td><?= $row["position"] ?></td>
                        <td><?= $row["price"] . " $" ?></td>
                        <td>
                                <svg class="modal-trigger2" width="11" height="13" viewBox="0 0 11 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.78571 0.785713C4 0.785713 3.35714 1.42857 3.35714 2.21428H1.92857C1.14286 2.21428 0.5 2.85714 0.5 3.64286H10.5C10.5 2.85714 9.85714 2.21428 9.07143 2.21428H7.64286C7.64286 1.42857 7 0.785713 6.21429 0.785713H4.78571ZM1.92857 5.07143V11.9429C1.92857 12.1 2.04286 12.2143 2.2 12.2143H8.81429C8.97143 12.2143 9.08571 12.1 9.08571 11.9429V5.07143H7.65714V10.0714C7.65714 10.4714 7.34286 10.7857 6.94286 10.7857C6.54286 10.7857 6.22857 10.4714 6.22857 10.0714V5.07143H4.8V10.0714C4.8 10.4714 4.48571 10.7857 4.08571 10.7857C3.68571 10.7857 3.37143 10.4714 3.37143 10.0714V5.07143H1.94286H1.92857Z" />
                                </svg>
                            <a href="edit.php?id=<?= $row["id"] ?>">
                                <svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 0.5L6.75 1.75L9.25 4.25L10.5 3L8 0.5ZM5.5 3L0.5 8V10.5H3L8 5.5L5.5 3Z" />
                                </svg>
                            </a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </main>

    <!-- ! Début modal -->
    <div class="modal-container">
        <div class="overlay modal-trigger"></div>
        <div class="modal">
            <button class="close-modal modal-trigger">X</button>
            <h1>Add</h1>
            <form method="POST">
                <div class="add-ampoule-ctn">
                    <div class="input-container">
                        <input type="date" name="create_date" required>
                    </div>
                    <div class="input-container">
                        <input type="number" name="stage" min="0" max="8" placeholder="Stage (0-8)" required>
                    </div>
                    <div class="input-container">
                        <select name="position" required>
                            <option value="">--Position (North, South...)</option>
                            <option value="North">North</option>
                            <option value="South">South</option>
                            <option value="East">East</option>
                            <option value="West">West</option>
                        </select>

                    </div>
                    <div class="input-container">
                        <input type="text" name="price" placeholder="Price">
                    </div>
                    <div class="btn-ajouter-ctn">
                        <input type="submit" value="Add">
                    </div>
            </form>
        </div>
    </div>
    </div>


    <div class="modal-container2">
        <div class="overlay modal-trigger2">
        </div>
        <div class="modal">
            <div class="modal-msg">
                <p>Etes vous sûr de vouloir supprimer cette entrée ?</p>
            </div>
            <div class="modal-btn-ctn">
                <div class="btn-suppr"><a href="del.php?id=<?=$row["id"]?>"><button>Supprimer</button</a></div>
                <div class="btn-cancel modal-trigger2"><button>Cancel</button></div>
            </div>
        </div>
    </div>


    <script src="JS/modal.js"></script>
</body>

</html>