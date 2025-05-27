<?php
header("Content-Type: application/json");

include_once("../model/connect.php");
include_once("../model/mAPI.php");
include_once("../controller/cAPI.php");

$ctrlAPI = new cAPI();

$where = [];

if (isset($_GET["id"])) {
    $id = (int) $_GET["id"];
    if (isset($_GET["showtime_id"])) {
        $showtime_id = (int) $_GET["showtime_id"];
        $sql = "SELECT ST.id AS showtime_id, C.id AS cinema_id, R.id AS room_id, M.id AS movie_id, ST.show_date, M.*, C.name, C.address FROM showtimes ST JOIN movies M ON ST.movie_id = M.id JOIN rooms R ON R.id = ST.room_id JOIN cinemas C ON C.id = R.cinema_id WHERE ST.id = $showtime_id";
    } else $sql = "SELECT * FROM movies WHERE id = $id";
} else if (isset($_GET["status"])) {
    $status = (int) $_GET["status"];
    if ($status == 1 && isset($_GET["top"]) && $_GET["top"] == true) {
        $sql = "SELECT *, COUNT(ST.movie_id) AS quantity FROM movies M JOIN showtimes ST ON M.id = ST.movie_id JOIN tickets T ON ST.id  = T.showtime_id WHERE M.status = $status GROUP BY ST.movie_id ORDER BY quantity DESC LIMIT 3";
    } else
        $sql = "SELECT * FROM movies WHERE status = $status";
} else if (!isset($_GET["id"]) && !isset($_GET["status"]) && !isset($_GET["top"]) && !isset($_GET["status"]) && isset($_GET["search"])) {
    $keyword = isset($_GET["search"]) ? trim($_GET["search"]) : '';
    $keyword = urldecode($keyword);
    $words = explode(" ", $keyword);

    // xây dựng câu truy vấn như đã sửa trước đó:
    $sql = "SELECT * FROM movies WHERE ";
    $conditions = [];
    foreach ($words as $word) {
        $word = trim($word);
        if ($word !== "") {
            $conditions[] = "title LIKE '%$word%'";
        }
    }
    $sql .= implode(" OR ", $conditions);

} else {
    $sql = "SELECT * FROM movies".(isset($_GET["sort"]) ? " ORDER BY id ".$_GET["sort"] : "");
}
$ctrlAPI->cExportAPIMovie($sql);
?>