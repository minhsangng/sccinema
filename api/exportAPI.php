<?php
    header("Content-Type: application/json");
    
    include_once("../model/connect.php");
    include_once("../model/mAPI.php");
    include_once("../controller/cAPI.php");
    
    $ctrlAPI = new cAPI();
    
    $ctrlAPI->cExportAPI();
?>