<?php
session_start();

if (!isset($_SESSION["user"]["id"])) {
    header("Location: login.php");
}

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
    $_SESSION["add"] = [
        "add_date" => $create_date,
        "add_stage" => $stage,
        "add_pos" => $position,
        "add_price" => $price
    ];
    header("Location: sessionadd.php");
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

    <?php
    if (!$_SESSION) {
        header("Location: login.php");
    } else {
        include_once "header.php";
        include_once "nav.php";
        include_once "toast-edit.php";
        include_once "dashboard.php";
    }
    ?>

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
                <div class="btn-suppr"><button class="delete" id="suppr">Delete</button>
                </div>
                <div class="btn-cancel modal-trigger2"><button class="cancel">Cancel</button></div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_SESSION["action"]["last_del_id"])) {
        include_once "toast.php";
        echo "<script src='JS/delet-toast.js'></script>";
        unset($_SESSION["action"]);
    }
    if (isset($_SESSION["add"])) {
        if ($_SESSION["add"]["active"] === 1) {
            include_once "toast-add.php";
            echo "<script src='JS/add-toast.js'></script>";
            unset($_SESSION["add"]);
        }
    }
    ?>


    <script src="JS/modal.js"></script>
    <script src="JS/profile-menu.js"></script>
    <script src="JS/edit-toast.js"></script>
</body>

</html>