<?php
    header("Content-Type: application/json");
    
    include_once("../model/connect.php");
    include_once("../model/mAPI.php");
    include_once("../controller/cAPI.php");
    
    $ctrlAPI = new cAPI();
    
    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        $ctrlAPI->cExportAPIMovie("SELECT * FROM movies WHERE id = $id");
    } else $ctrlAPI->cExportAPIMovie("SELECT * FROM movies");
?>