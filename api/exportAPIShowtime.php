<?php
    header("Content-Type: application/json");
    
    include_once("../model/connect.php");
    include_once("../model/mAPI.php");
    include_once("../controller/cAPI.php");
    
    $ctrlAPI = new cAPI();
    
    if (isset($_GET["date"])) {
        $date = $_GET["date"];
        $ctrlAPI->cExportAPIShowtime("SELECT *, ST.status, ST.id FROM showtimes ST JOIN movies M ON ST.movie_id = M.id JOIN rooms R ON R.id = ST.movie_id WHERE ST.show_date = '$date'");
    } else
        $ctrlAPI->cExportAPIShowtime("SELECT *, ST.status, ST.id FROM showtimes ST JOIN movies M ON ST.movie_id = M.id JOIN rooms R ON R.id = ST.movie_id");
?>