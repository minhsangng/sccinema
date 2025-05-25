<?php
header("Content-Type: application/json");

include_once("../model/connect.php");
include_once("../model/mAPI.php");
include_once("../controller/cAPI.php");

$ctrlAPI = new cAPI();

if (isset($_GET["date"])) {
    $date = $_GET["date"];
    $ctrlAPI->cExportAPIShift("SELECT * FROM shifts SH JOIN staffs ST ON SH.staff_id = ST.id WHERE SH.date = '$date'");
} else
    $ctrlAPI->cExportAPIShift("SELECT * FROM shifts SH JOIN staffs ST ON SH.staff_id = ST.id");
?>