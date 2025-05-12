<title>SC Cinema | Đặt vé xem phim trực tuyến</title>

<style>
     .item-content-wrapper {
          width: 100%;
     }
</style>

<!-- SLIDE SECTION -->
<div class="ml-[200px] mr-[110px]" id="big-section">
     <!-- BIG SLIDES -->
     <div class="big-slider" id="big-slider">
          <?php
          $response = $ctrlAPI->cCallAPI("http://localhost/SCCinema/api/exportAPIMovie.php?status=1&top=true");

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
                                        <span>" . $movie->age_rating . "</span>
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

          <ul class="slide-control ml-[200px] mr-[110px]">
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
<div class="mt-24">
     <div class="pl-[200px] pr-[110px]">
          <div class="section-header">
               Phim đang chiếu
          </div>

          <div class="grid grid-cols-4 gap-8">
               <?php
               $response = $ctrlAPI->cCallAPI("http://localhost/SCCinema/api/exportAPIMovie.php?status=1");

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
                              echo "<a href='view/page/component/?id=" . $movie->id . "' class='movie-item s-11 m-0 w-auto to-top show-on-scroll'>
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
                                                       <span>" . $movie->age_rating . "</span>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   
                                   <div class='movie-item-overlay'></div>
                              </a>";
                              $index++;
                         }

                         if ($index > 7)
                              break;
                    }
               } else
                    echo "Không có dữ liệu";
               ?>
          </div>
          
          <div class="w-full flex justify-center mt-8">
               <button class="border border-red-500 px-4 py-2">Xem tất cả phim đang chiếu</button>
          </div>
     </div>
</div>
<!-- END PLAYING SERIES -->

<!-- COMING SERIES -->
<div class="mt-24">
     <div class="pl-[200px] pr-[110px]">
          <div class="section-header">
               Phim sắp chiếu
          </div>

          <div class="grid grid-cols-4 gap-8">
               <?php
               $response = $ctrlAPI->cCallAPI("http://localhost/SCCinema/api/exportAPIMovie.php?status=2");

               if ($response) {
                    $now = date("Y-m-d");
                    $n = 0;
                    foreach ($response as $movie) {
                         $movieDate = (int) strtotime($movie->release_date);
                         $currentDate = (int) strtotime($now);

                         if ($movieDate > $currentDate) {
                              echo "<a href='view/page/component/?id=" . $movie->id . "' class='movie-item s-11 m-0 w-auto to-top show-on-scroll'>
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
                              $n++;
                         }

                         if ($n > 4)
                              break;
                    }
               } else
                    echo "Không có dữ liệu";
               ?>
          </div>
     </div>
</div>
<!-- END COMING SERIES -->