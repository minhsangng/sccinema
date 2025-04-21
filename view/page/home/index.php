<title>SC Cinema | Đặt vé xem phim trực tuyến</title>

<style>
     .item-content-wrapper {
          width: 100%;
     }
</style>

<!-- SLIDE SECTION -->
<div class="big-section" id="big-section">
     <!-- BIG SLIDES -->
     <div class="big-slider" id="big-slider">
          <?php
          $response = $ctrlAPI->cCallAPI("http://localhost/SCCinema/api/exportAPI.php");

          if ($response) {
               $index = 0;

               foreach ($response as $movie) {
                    echo "<div class='big-slide-item " . ($index == 0 ? "active" : "") . "'>
                    <img src='" . $movie->thumbnail_url . "' alt='" . $movie->title . "'>

                    <div class='big-slide-item-content'>    
                         <div class='item-content-wrapper'>
                              <div class='item-content-title'>
                                   " . $movie->title . "
                              </div>

                              <div class='movies-infors'>
                                   <div class='movies-infor'>
                                        <ion-icon name='star-outline'></ion-icon>
                                        <span>" . round($movie->vote_average, 1) . "</span>
                                   </div>
                                   <div class='movies-infor'>
                                        <ion-icon name='time-outline'></ion-icon>
                                        <span>" . $movie->duration . "</span>
                                   </div>
                                   <div class='movies-infor'>
                                        <ion-icon name='cube-outline'></ion-icon>
                                        <span>" . $movie->release_date . "</span>
                                   </div>
                              </div>

                              <div class='item-content-description '>
                                   " . $movie->summary . "
                              </div>
                         </div>
                    </div>

                    <div class='play-movies'>
                         <div class='ring'></div>
                         <a href='view/page/component/?id=" . $movie->id . "#trailer'>
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
          } else
               echo "Không có dữ liệu";

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
               /* $response = $ctrlAPI->cCallAPI("http://localhost/SCCinema/api/exportAPI.php"); */

               if ($response) {
                    $now = date("d/m/y");
                    $index = 0;
                    foreach ($response as $movie) {
                         list($year, $month, $day) = explode("-", $movie->release_date);
                         list($dayNow, $monthNow, $yearNow) = explode("/", $now);

                         $day = (int) $day;
                         $month = (int) $month;
                         $year = (int) $year;

                         $dayNow = (int) $dayNow;
                         $monthNow = (int) $monthNow;
                         $yearNow = (int) ($yearNow + 2000);

                         if ($year < $yearNow || ($year == $yearNow && $month < $monthNow) || ($year == $yearNow && $month == $monthNow && $day <= $dayNow)) {
                              echo "<a href='view/page/component/?id=" . $movie->id . "' class='movie-item col-3-5 m-5 s-11 to-top show-on-scroll'>
                                   <div>
                                        <img src='" . $movie->poster_url . "' alt='" . $movie->title . "'>
                                        <div class='movie-item-content'>
                                             <div class='movie-item-title'>
                                                  " . $movie->title . "
                                             </div>

                                             <div class='movies-infors-card'>
                                                  <div class='movies-infor'>
                                                       <ion-icon name='star-outline'></ion-icon>
                                                       <span>" . round($movie->vote_average, 1) . "</span>
                                                  </div>
                                                  <div class='movies-infor'>
                                                       <ion-icon name='time-outline'></ion-icon>
                                                       <span>" . $movie->duration . "</span>
                                                  </div>
                                                  <div class='movies-infor'>
                                                       <ion-icon name='cube-outline'></ion-icon>
                                                       <span>" . explode("-", $movie->release_date)[0] . "</span>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   
                                   <div class='movie-item-overlay'></div>
                              </a>";
                              $index++;
                         }

                         if ($index > 8)
                              break;
                    }
               } else
                    echo "Không có dữ liệu";
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
               /* $response = $ctrlAPI->cCallAPI("http://localhost/SCCinema/api/exportAPI.php"); */

               if ($response) {
                    $now = date("Y-m-d");
                    $index = 0;
                    foreach ($response as $movie) {
                         $movieDate = (int) strtotime($movie->release_date);
                         $currentDate = (int) strtotime($now);
                         
                         if ($movieDate > $currentDate) {
                              echo "<a href='../component/?id=" . $movie->id . "' class='movie-item col-3-5  m-5 s-11 to-top show-on-scroll'>
                                        <div>
                                             <img src='" . $movie->poster_url . "' alt='" . $movie->title . "'>
                                             <div class='movie-item-content'>
                                                  <div class='movie-item-title'>
                                                       " . $movie->title . "
                                                  </div>
          
                                                  <div class='movies-infors-card'>
                                                       <div class='movies-infor'>
                                                            <ion-icon name='calendar-outline'></ion-icon>
                                                            <span>Khởi chiếu: " . $movie->release_date . "</span>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                        
                                        <div class='movie-item-overlay'></div>
                                   </a>";
                              $index++;
                         }

                         if ($index > 5)
                              break;
                    }
                    
                    if ($index <= 5) {
                         echo "Không có dữ liệu";
                    }
               } else
                    echo "Không có dữ liệu";
               ?>
          </div>
     </div>
</div>
<!-- END COMING SERIES -->

<script>
     let rows1 = document.querySelectorAll("#latest-section .row");
     let totalHeight1 = 0;

     rows1.forEach(row => {
          totalHeight1 += row.offsetHeight;
     });

     let latest_section = document.getElementById("latest-section");
     latest_section.style.maxHeight = totalHeight1 + "px";

     let rows2 = document.querySelectorAll("#section-tv .row");
     let totalHeight2 = 0;

     rows2.forEach(row => {
          totalHeight2 += row.offsetHeight;
     });

     let section_tv = document.getElementById("section-tv");
     section_tv.style.maxHeight = totalHeight2 + "px";
</script>