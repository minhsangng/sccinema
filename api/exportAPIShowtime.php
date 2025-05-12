<?php
    header("Content-Type: application/json");
    
    include_once("../model/connect.php");
    include_once("../model/mAPI.php");
    include_once("../controller/cAPI.php");
    
    $ctrlAPI = new cAPI();
    
    if (isset($_GET["date"])) {
        $date = $_GET["date"];
        $ctrlAPI->cExportAPIShowtime("SELECT *, ST.status, ST.id, GROUP_CONCAT(CONCAT(R.cinema_id, ' - ', ST.start_time) SEPARATOR ', ') AS showtimes FROM showtimes ST JOIN movies M ON ST.movie_id = M.id JOIN rooms R ON R.id = ST.room_id JOIN cinemas C ON C.id = R.cinema_id WHERE ST.show_date = '$date' GROUP BY ST.movie_id");
    } else
        $ctrlAPI->cExportAPIShowtime("SELECT *, ST.status, ST.id FROM showtimes ST JOIN movies M ON ST.movie_id = M.id JOIN rooms R ON R.id = ST.room_id");
?>