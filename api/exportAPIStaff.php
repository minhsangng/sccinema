<?php
header("Content-Type: application/json");

include_once("../model/connect.php");
include_once("../model/mAPI.php");
include_once("../controller/cAPI.php");

$ctrlAPI = new cAPI();

if (isset($_GET["staff_id"])) {
    $staff_id = $_GET["staff_id"];
    $ctrlAPI->cExportAPIStaff("SELECT * FROM staffs WHERE id = '$staff_id'");
} else
    $ctrlAPI->cExportAPIStaff("SELECT * FROM staffs");
?>