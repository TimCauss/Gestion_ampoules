<?php
session_start();
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] === 0) {
    header("Location: index.php");
}
require_once("connect.php");

$id = strip_tags($_GET["id"]);
$create_date = strip_tags($_GET["create_date"]);
$stage = strip_tags($_GET["stage"]);
$position = strip_tags($_GET["position"]);
$price = strip_tags($_GET["price"]);

$sql = "UPDATE ampoules SET
    create_date = :create_date,
    stage = :stage,
    position = :position,
    price = :price
    WHERE id=:id
    ";

$query = $db->prepare($sql);
$query->bindValue(":id", $id, PDO::PARAM_INT);
$query->bindValue(":create_date", $create_date);
$query->bindValue(":stage", $stage, PDO::PARAM_INT);
$query->bindValue(":position", $position);
$query->bindValue(":price", $price);
$query->execute();
require_once("close.php");
$_SESSION["action"] = [
    "last_edit_id" => $id
];
echo "<script>window.close();</script>";
