<?php
session_start();
if ($_SESSION["user"]["role"] === 0 || !isset($_SESSION["user"]["id"])) {
    header("Location: index.php");
}

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    require_once("connect.php");

    $id = strip_tags($_GET["id"]);
    $sql = "SELECT * FROM ampoules WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch();

    if (!($result)) {
        header("Location: index.php");
    }

    $_SESSION["action"] = [
        "last_del_id" => $result["id"]
    ];

    $sql = "DELETE FROM ampoules WHERE id = :id";
    $query = $db->prepare($sql);
    $query->bindValue(":id", $id, PDO::PARAM_INT);
    $query->execute();



    require_once("close.php");
    header("Location: index.php");
} else {
    header("Location: index.php");
}
