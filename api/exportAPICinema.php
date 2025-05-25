<?php
header("Content-Type: application/json");

include_once("../model/connect.php");
include_once("../model/mAPI.php");
include_once("../controller/cAPI.php");

$ctrlAPI = new cAPI();

if (isset($_GET["cinema_id"])) {
    $cinema_id = $_GET["cinema_id"];
    $ctrlAPI->cExportAPICinema("SELECT * FROM rooms WHERE cinema_id = $cinema_id");
} else
    $ctrlAPI->cExportAPICinema("SELECT * FROM cinemas");
?>