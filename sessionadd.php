<?php
session_start();
$_SESSION["add"] += [
    "active" => 1
];
header("Location: index.php");
