<?php

//on vérifie si le formulaire a été envoyé
if (!empty($_POST)) {
    //formulaire envoyé
    //On vérifie les champs requis
    if (
        isset($_POST["user_name"], $_POST["pass"])
        && !empty($_POST["user_name"]) && !empty($_POST["pass"])
    ) {
        //Le formulaire est complet
        //on récupère les données en les protégeant
        $user_name = strip_tags($_POST["user_name"]);

        //on se connecte à la BDD
        require_once "connect.php";
        $sql = "SELECT id, user_name, pass, is_admin, email FROM users WHERE user_name = :user_name";
        $query = $db->prepare($sql);
        $query->bindValue(":user_name", $user_name, PDO::PARAM_STR);
        $query->execute();

        $user = $query->fetch();

        //on test pour savoir si un user existe
        if (!$user) {
            die("User and/or password does not exist");
        }
        //on test si le mdp est bon
        if (!password_verify($_POST["pass"], $user["pass"])) {
            die("User and/or password does not exist");
        }

        //ici l'user et le mot de passe sont corrects
        //On ouvre la session (on connecte l'utilisateur)

        
        //on démarre la session PHP:
        session_start();
        //on stocke dans $_SESSION les informations de l'utilisateur
        $_SESSION["user"] = [
            "id" => $user["id"],
            "name" => $user["user_name"],
            "email" => $user["email"],
            "role" => $user["is_admin"]
        ];
        //on redirige vers le dashboard
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
    <title>Login : Bulb Manager </title>
</head>

<body class="body-login">
    <main>
        <div class="form-container">
            <div class="form-header">
                <h1>Login Page</h1>
            </div>
            <form method="POST">
                <div class="form-main">
                    <div>
                        <input type="text" name="user_name" id="user_name" placeholder="Username">
                    </div>
                    <div>
                        <input type="password" name="pass" id="pass" placeholder="Password">
                    </div>
                    <div class="action-ctn">
                        <div class="subm-ctn">
                            <button class="login-btn" type="submit">login</button>
                        </div>
                        <div class="subm-ctn forgt">
                            <a href="#">Forgot Password ?</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
</body>

</html>