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

    <?php include_once "header.php"; ?>


    <main>
        <table>

            <thead>
                <th>ID</th>
                <th>Date</th>
                <th>Floor</th>
                <th>Position</th>
                <th>Price</th>
            </thead>

            <tbody>
                <form class="edit-form" method="POST">
                    <?php
                    foreach ($result as $row) {
                    ?>
                        <tr>
                            <td class="td-hover td-small"><?= $row["id"] ?></td>
                            <td class="td-hover">
                                <input class="edit_input date_<?= $row['id'] ?>" type="date" name="edit_date" value='<?= $row["create_date"] ?>'>
                            </td>
                            <td class="td-hover td-small">
                                <input class="edit_input stage_<?= $row['id'] ?>" name="edit_stage" type="number" min="0" max="8" value="<?= $row['stage'] ?>">
                            </td>
                            <td class="td-hover td-position">
                                <select class="edit_input position_<?= $row['id'] ?>" name="edit_position">
                                    <option value="<?= $row["position"] ?>"><?= $row["position"] ?></option>
                                    <option value="North">North</option>
                                    <option value="South">South</option>
                                    <option value="East">East</option>
                                    <option value="West">West</option>
                                </select>
                            </td>
                            <td class="td-hover td-small">
                                <input class="edit_input price_<?= $row['id'] ?>" type="text" name="edit_price" value='<?= $row["price"] . " $" ?>'>
                            </td>
                            <td class="td-icon">
                                <svg class="modal-trigger2 trash" data-id="<?= $row["id"] ?>" width="11" height="13" viewBox="0 0 11 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M4.78571 0.785713C4 0.785713 3.35714 1.42857 3.35714 2.21428H1.92857C1.14286 2.21428 0.5 2.85714 0.5 3.64286H10.5C10.5 2.85714 9.85714 2.21428 9.07143 2.21428H7.64286C7.64286 1.42857 7 0.785713 6.21429 0.785713H4.78571ZM1.92857 5.07143V11.9429C1.92857 12.1 2.04286 12.2143 2.2 12.2143H8.81429C8.97143 12.2143 9.08571 12.1 9.08571 11.9429V5.07143H7.65714V10.0714C7.65714 10.4714 7.34286 10.7857 6.94286 10.7857C6.54286 10.7857 6.22857 10.4714 6.22857 10.0714V5.07143H4.8V10.0714C4.8 10.4714 4.48571 10.7857 4.08571 10.7857C3.68571 10.7857 3.37143 10.4714 3.37143 10.0714V5.07143H1.94286H1.92857Z" />
                                </svg>

                                <svg width="20" height="20" data-id="<?= $row["id"] ?>" class="modal-trigger3" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M20.048 6.352a1.2 1.2 0 0 1 0 1.696l-9.6 9.6a1.2 1.2 0 0 1-1.696 0l-4.8-4.8a1.2 1.2 0 0 1 1.696-1.696L9.6 15.103l8.752-8.751a1.2 1.2 0 0 1 1.696 0Z" clip-rule="evenodd"></path>
                                </svg>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </form>
            </tbody>
        </table>
    </main>

    <!-- ! Début modal -->
    <?php ?>
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
                            <option value="">--Position (North, South...)--</option>
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
                        <input class="btn-add" type="submit" value="Add">
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
                <div class="btn-suppr"><button class="delete">Supprimer</button>
                </div>
                <div class="btn-cancel modal-trigger2"><button>Cancel</button></div>
            </div>
        </div>
    </div>


    <script src="JS/modal.js"></script>
</body>

</html>