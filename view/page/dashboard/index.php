<?php
error_reporting(1);

// API Video từ YTB
$ytb_key = "AIzaSyBSKrHuvN5s7a9BZF2KSc3fp4EqsbvuMZE";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
     $data = file_get_contents("php://input");

     $all_movies = json_decode($data, true);

     if (!empty($all_movies)) {
          // Xóa nội dung file trước khi ghi dữ liệu mới
          file_put_contents("data.json", "");
          $result = file_put_contents("data.json", json_encode($all_movies, JSON_PRETTY_PRINT));

          if ($result !== false) {
               echo json_encode(["status" => "success", "message" => "Data saved successfully."]);
          } else {
               echo json_encode(["status" => "error", "message" => "Failed to save data."]);
          }
     } else {
          echo json_encode(["status" => "error", "message" => "No data received or invalid data."]);
     }
     exit();
}

$jsonData = file_get_contents("data.json");

$all_movies = json_decode($jsonData, true);

/* include_once("model/mAPI.php");
include_once("controller/cAPI.php");

$p = new cAPI; */
?>

<title>SC Cinema | Đặt vé xem phim trực tuyến</title>

<!-- SLIDE SECTION -->
<div class="big-section" id="big-section">
     <!-- BIG SLIDES -->
     <div class="big-slider" id="big-slider">
          <?php
          $index = 0;

          foreach ($all_movies as $movie) {
               echo "<div class='big-slide-item " . ($index == 0 ? "active" : "") . "'>
                    <img src='" . $movie["poster_url"] . "' alt='" . $movie["name"] . "'>

                    <div class='big-slide-item-content'>    
                         <div class='item-content-wrapper'>
                              <div class='item-content-title'>
                                   " . $movie["name"] . "
                              </div>

                              <div class='movies-infors'>
                                   <div class='movies-infor'>
                                        <ion-icon name='bookmark-outline'></ion-icon>
                                        <span>" . round($movie["vote_average"], 1) . "</span>
                                   </div>
                                   <div class='movies-infor'>
                                        <ion-icon name='time-outline'></ion-icon>
                                        <span>" . $movie["time"] . "</span>
                                   </div>
                                   <div class='movies-infor'>
                                        <ion-icon name='cube-outline'></ion-icon>
                                        <span>" . $movie["quality"] . "</span>
                                   </div>
                              </div>

                              <div class='item-content-description '>
                                   " . $movie["content"] . "
                              </div>
                         </div>
                    </div>

                    <div class='play-movies'>
                         <div class='ring'></div>
                         <a href='view/page/component/?id=".$movie["id"]."#trailer'>
                              <i class='bx bxs-right-arrow'></i>
                         </a>
                         <div class='btn-watch'>
                              <span>watch trailer</span>
                         </div>
                    </div>
               </div>";
               $index++;

               if ($index > 2)
                    break;
          }

          ?>

          <ul class="slide-control">
               <li class="slide-prev">
                    <ion-icon name="chevron-back-outline"></ion-icon>
               </li>

               <li class="slide-next">
                    <ion-icon name="chevron-forward-outline"></ion-icon>
               </li>
          </ul>

     </div>
</div>
<!--END SLIDE SECTION -->

<!-- PLAYING SERIES -->
<div class="section" id="latest-section">
     <div class="section-wrapper" id="section-wrapper">
          <div class="section-header">
               Phim đang chiếu
          </div>

          <div class="movies-slide row">
               <?php
               $now = date("d/m/y");
               foreach (array_slice($all_movies, 0, 9) as $movie) {
                    list($day, $month, $year) = explode("/", $movie["date"]);
                    list($dayNow, $monthNow, $yearNow) = explode("/", $now);

                    $day = (int) $day;
                    $month = (int) $month;
                    $year = (int) $year;

                    $dayNow = (int) $dayNow;
                    $monthNow = (int) $monthNow;
                    $yearNow = (int) ($yearNow + 2000);

                    if ($year < $yearNow || ($year == $yearNow && $month < $monthNow) || ($year == $yearNow && $month == $monthNow && $day <= $dayNow)) {
                         echo "<a href='view/page/component/?id=" . $movie["id"] . "' class='movie-item col-3-5 m-5 s-11 to-top show-on-scroll'>
                                   <div>
                                        <img src='" . $movie["thumb_url"] . "' alt='" . $movie["name"] . "'>
                                        <div class='movie-item-content'>
                                             <div class='movie-item-title'>
                                                  " . $movie["name"] . "
                                             </div>

                                             <div class='movies-infors-card'>
                                                  <div class='movies-infor'>
                                                       <ion-icon name='bookmark-outline'></ion-icon>
                                                       <span>" . round($movie["vote_average"], 1) . "</span>
                                                  </div>
                                                  <div class='movies-infor'>
                                                       <ion-icon name='time-outline'></ion-icon>
                                                       <span>" . $movie["time"] . "</span>
                                                  </div>
                                                  <div class='movies-infor'>
                                                       <ion-icon name='cube-outline'></ion-icon>
                                                       <span>" . explode("/", $movie["date"])[2] . "</span>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div class='movie-item-overlay'>
                                   </div>
                                   <div class='movie-item-act'>
                                        <i class='bx bxs-right-arrow'></i>

                                        <div>
                                             <i class='bx bxs-share-alt'></i>
                                             <i class='bx bxs-heart'></i>
                                             <i class='bx bx-plus-medical'></i>
                                        </div>
                                   </div>
                              </a>";
                         $index++;
                    }
               }
               ?>
          </div>
     </div>
</div>
<!-- END PLAYING SERIES -->

<!-- COMING SERIES -->
<div class="section-tv" id="section-tv">
     <div class="section-wrapper">
          <div class="section-header">
               Phim sắp chiếu
          </div>

          <div class="movies-slide row" id="tv-slider">
               <?php
               foreach (array_slice($all_movies, 0, 6) as $movie) {
                    list($day, $month, $year) = explode("/", $movie["date"]);

                    $day = (int) $day;
                    $month = (int) $month;
                    $year = (int) $year;

                    if ($year > $yearNow || ($year == $yearNow && $month > $monthNow) || ($year == $yearNow && $month == $monthNow && $day > $dayNow)) {
                         echo "<a href='../component/?id=" . $movie["id"] . "' class='movie-item col-3-5  m-5 s-11 to-top show-on-scroll'>
                              <div>
                                   <img src='" . $movie["thumb_url"] . "' alt='" . $movie["name"] . "'>
                                   <div class='movie-item-content'>
                                        <div class='movie-item-title'>
                                             " . $movie["name"] . "
                                        </div>

                                        <div class='movies-infors-card'>
                                             <div class='movies-infor'>
                                                  <ion-icon name='cube-outline'></ion-icon>
                                                  <span>Khởi chiếu: " . $movie["date"] . "</span>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class='movie-item-overlay'>
                              </div>
                              <div class='movie-item-act'>
                                   <i class='bx bxs-right-arrow'></i>

                                   <div>
                                        <i class='bx bxs-share-alt'></i>
                                        <i class='bx bxs-heart'></i>
                                   </div>
                              </div>

                         </a>";
                    }
               }
               ?>
          </div>
     </div>
</div>
<!-- END COMING SERIES -->