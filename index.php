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

    <title>Bulb Manager</title>
</head>

<body>

    <?php include_once "header.php"; ?>
    <?php include_once "nav.php"; ?>


    <main>
        <table>

            <thead>
                <th>Date</th>
                <th>Floor</th>
                <th>Position</th>
                <th>Price</th>
                <th>Actions</th>
            </thead>

            <tbody>
                <form class="edit-form" method="POST">
                    <?php
                    foreach ($result as $row) {
                    ?>
                        <tr>
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
                            <td class="td-hover">

                                <svg class="modal-trigger2 trash" data-id="<?= $row["id"] ?>" width="13" height="13" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.25 17.25 6.75 6.75"></path>
                                    <path d="m17.25 6.75-10.5 10.5"></path>
                                </svg>

                                <svg data-id="<?= $row["id"] ?>" class="modal-trigger3" width="14" height="14" stroke-width="0.541667" stroke="currentColor" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.6691 3.75L4.9816 10.25L2.5441 7.8125" stroke-linecap="round" stroke-linejoin="round" />
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
            <h1 class="modal-title">Add</h1>
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
                <p>Are you sure you want to delete this entry?</p>
            </div>
            <div class="modal-btn-ctn">
                <div class="btn-suppr" onclick="Toasty()"><button class="delete">Delete</button>
                </div>
                <div class="btn-cancel modal-trigger2"><button>Cancel</button></div>
            </div>
        </div>
    </div>


    <script src="JS/modal.js"></script>
    <script src="JS/toast.js"></script>

</body>

</html>