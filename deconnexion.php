<?php
session_start();
//fonction qui permet de supprimer une variable
unset($_SESSION["user"]);

header("Location: index.php");