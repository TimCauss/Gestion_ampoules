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
session_start();
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
                <div class="btn-suppr"><button class="delete" id="suppr" onclick="Toasty(this.id)">Delete</button>
                </div>
                <div class="btn-cancel modal-trigger2"><button class="cancel">Cancel</button></div>
            </div>
        </div>
    </div>

    <div class="toast suppr-toast" id="supprToast">
        <div class="toast-header">
            <div>Info</div>
            <div><svg width="13" height="13" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 3c-4.969 0-9 4.031-9 9s4.031 9 9 9 9-4.031 9-9-4.031-9-9-9Zm-.281 14.25a.938.938 0 1 1 0-1.875.938.938 0 0 1 0 1.875Zm1.567-4.781c-.76.51-.864.977-.864 1.406a.656.656 0 0 1-1.313 0c0-1.027.473-1.844 1.445-2.497.904-.606 1.415-.99 1.415-1.836 0-.574-.328-1.01-1.008-1.334-.16-.076-.515-.15-.953-.145-.55.007-.976.139-1.305.403-.62.499-.672 1.042-.672 1.05a.656.656 0 1 1-1.312-.064c.005-.114.084-1.14 1.16-2.006.56-.449 1.27-.682 2.11-.693.595-.007 1.155.094 1.534.273 1.135.537 1.758 1.432 1.758 2.516 0 1.586-1.06 2.298-1.995 2.927Z"></path>
                </svg></div>
        </div>
        <div class="toast_body">
            Entry deleted in <span class="counter-display">(..)</span>
        </div>
    </div>

    <script src="JS/modal.js"></script>
    <script src="JS/toast.js"></script>
</body>

</html>