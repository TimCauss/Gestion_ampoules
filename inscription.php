<?php
session_start();
if ($_SESSION["user"]["role"] === 0 || !isset($_SESSION["user"]["id"])) {
    header("Location: index.php");
}
//on vérifie si le formulaire a été envoyé
if (!empty($_POST)) {
    //formulaire envoé
    //On vérifie les champs requis
    if (
        isset($_POST["user_name"], $_POST["email"], $_POST["pass"])
        && !empty($_POST["user_name"]) && !empty($_POST["email"]) && !empty($_POST["pass"])
    ) {
        //Le formulaire est complet
        //on récupère les données en les protégeant
        $user_name = strip_tags($_POST["user_name"]);

        //On vérifie si l'email est bien un email :
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            die("Mail address incorrect");
        }

        //on va hasher le mot de passe
        $pass = password_hash($_POST["pass"], PASSWORD_ARGON2ID);

        //on enregistre en base de donnée
        require_once "connect.php";

        $sql = "INSERT INTO users(user_name, email, pass)
            VALUES (:user_name, :email, '$pass')";

        $query = $db->prepare($sql);
        $query->bindValue(":user_name", $user_name);
        $query->bindValue(":email", $_POST["email"]);
        $query->execute();

        echo '<script language="Javascript">
            alert ("User created" )
            </script>';
    } else {
        die("Formulaire incomplet");
    }
}


?>

<h1>Inscription</h1>

<form method="POST">
    <div>
        <label for="user_name">Username</label>
        <input type="text" name="user_name" id="user_name">
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
    </div>
    <div>
        <label for="pass">Password</label>
        <input type="password" name="pass" id="pass">
    </div>
    <button type="submit">Create user</button>
</form>


<?php



?>