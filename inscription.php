<?php

//on vérifie si le formulaire a été envoyé
if(!empty($_POST)) {
    //formulaire envoé
    //On vérifie les champs requis
    if(isset($_POST["pseudo"], $_POST["email"], $_POST["password"])
    && !empty($_POST["pseudo"]) && !empty($_POST["email"]) && !empty($_POST["password"])
    ) {
        //Le formulaire est complet
        //on récupère les données en les protégeant
        $user_name = strip_tags($_POST["pseudo"]);

        //On vérifie si l'email est bien un email :
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
                die("Mail address incorrect");
            }

            //on va hasher le mot de passe
            $password = password_hash($_POST["password"], PASSWORD_ARGON2ID);
            
    
        } else {
        die("Formulaire incomplet");
    }
}


?>

<h1>Inscription</h1>

<form method="POST" >
    <div>
        <label for="pseudo">Pseudo</label>
        <input type="text" name="user_name" id="pseudo">
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" id="password">
    </div>
    <button type="submit">Create user</button>
</form>


<?php



?>