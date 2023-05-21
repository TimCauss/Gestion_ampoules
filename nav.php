<nav>
    <button class="modal-trigger" href="add.php">Add Entry</button>

    <?php
    if ($_SESSION["user"]["role"] === 1) {
        include_once "button_create_user.php";
    }
    ?>
</nav>