<link rel="stylesheet" href="CSS/header.css">

<header>
    <div class="hd-ctn">
        <h1>Bulbs Manager</h1>
        <div class="login-ctn">
            <img src="img/icon_user_alt.png" alt="Icon d'utilisateur par défault">
            <p><?= $_SESSION["user"]["name"] ?></p>
        </div>
    </div>

    <div class="disconnect-session">
        <a href="deconnexion.php">Disconnect</a>
    </div>
</header>