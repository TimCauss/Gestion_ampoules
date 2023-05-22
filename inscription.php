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
        header("Location: index.php");
    } else {
        die("Formulaire incomplet");
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <title>Document</title>
</head>

<body>

    <main>
        <div class="form-container">
            <div class="form-header">
                <h1>Register</h1>
            </div>
            <form method="POST">
                <div class="form-main register-page">
                    <div>
                        <input type="text" name="user_name" id="user_name" placeholder="Username">
                    </div>
                    <div>
                        <input type="email" name="email" id="email" placeholder="Email">
                    </div>
                    <div>
                        <input type="password" name="pass" id="pass" placeholder="Password">
                    </div>
                </div>
                <div class="regctn">
                    <button class="register-btn" type="submit">Create user</button>
                </div>
            </form>
        </div>
    </main>
</body>

</html>