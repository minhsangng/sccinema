<?php
header("Content-Type: application/json");

include_once("../model/connect.php");
include_once("../model/mAPI.php");
include_once("../controller/cAPI.php");

$ctrlAPI = new cAPI();

$cinemaId = isset($_GET['cinema_id']) ? (int) $_GET['cinema_id'] : null;
$movieId = isset($_GET['movie_id']) ? (int) $_GET['movie_id'] : null;
$date = isset($_GET['show_date']) ? $_GET['show_date'] : null;

// Trường hợp: lấy giờ chiếu cụ thể theo rạp + phim + ngày
if ($cinemaId && $movieId && $date) {
    $query = "SELECT ST.id AS showtime_id, ST.movie_id AS movie_id, ST.show_date, ST.start_time, M.*
              FROM showtimes ST
              JOIN rooms R ON R.id = ST.room_id
              JOIN movies M ON M.id = ST.movie_id
              WHERE R.cinema_id = $cinemaId AND ST.movie_id = $movieId AND ST.show_date = '$date'";
    $ctrlAPI->cExportAPIShowtime($query);
    exit;
}

// Trường hợp: lấy ngày chiếu theo rạp + phim
if ($cinemaId && $movieId && !$date) {
    $query = "SELECT DISTINCT ST.show_date, ST.id 
              FROM showtimes ST
              JOIN rooms R ON R.id = ST.room_id
              WHERE R.cinema_id = $cinemaId AND ST.movie_id = $movieId
              ORDER BY ST.show_date ASC";
    $ctrlAPI->cExportAPIShowtime($query);
    exit;
}

// Trường hợp: lấy danh sách phim đang chiếu tại rạp
if ($cinemaId) {
    $query = "SELECT DISTINCT M.id, M.title 
              FROM movies M
              JOIN showtimes ST ON ST.movie_id = M.id
              JOIN rooms R ON R.id = ST.room_id
              WHERE R.cinema_id = '$cinemaId' AND M.status = 1";
    $ctrlAPI->cExportAPIShowtime($query);
    exit;
}

// Trường hợp: có date → hiển thị các phim có suất chiếu hôm đó (sẵn)
if ($date) {
    $query = "SELECT 
                ST.id AS showtime_id,
                ST.start_time,
                ST.show_date,
                ST.movie_id,
                M.title,
                M.poster_url,
                M.thumbnail_url,
                M.genres,
                M.duration,
                M.country,
                M.age_rating,
                R.cinema_id,
                C.name AS cinema_name,
                C.address
              FROM showtimes ST
              JOIN movies M ON M.id = ST.movie_id
              JOIN rooms R ON R.id = ST.room_id
              JOIN cinemas C ON C.id = R.cinema_id
              WHERE ST.show_date = '$date'
              ORDER BY M.id, R.cinema_id, ST.start_time ASC";
    $ctrlAPI->cExportAPIShowtime($query);
    exit;
}


// Mặc định: trả toàn bộ showtimes
$query = "SELECT *, ST.status, ST.id 
          FROM showtimes ST 
          JOIN movies M ON ST.movie_id = M.id 
          JOIN rooms R ON R.id = ST.room_id 
          JOIN cinemas C ON C.id = R.cinema_id";
$ctrlAPI->cExportAPIShowtime($query);
