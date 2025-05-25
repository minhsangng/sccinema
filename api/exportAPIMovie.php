<?php
header("Content-Type: application/json");

include_once("../model/connect.php");
include_once("../model/mAPI.php");
include_once("../controller/cAPI.php");

$ctrlAPI = new cAPI();

$where = [];

if (isset($_GET["id"])) {
    $id = (int) $_GET["id"];
    $sql = "SELECT * FROM movies WHERE id = $id";
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