<?php
error_reporting(1);

include_once("../../layout/header.php");

include_once("../../../model/connect.php");
include_once("../../../model/mAPI.php");
include_once("../../../controller/cAPI.php");

$ctrlAPI = new cAPI();

if (isset($_GET["id"]))
     $id = $_GET["id"];

$response = $ctrlAPI->cCallAPI("http://localhost/SCCinema/api/exportAPIMovie.php?id=" . $id);

echo "<title>" . (!empty($response[0]) ? $response[0]->title : "") . "</title>";
?>

<style>
     .boxoffice {
          width: auto;
     }

     .movie-card-content h2 {
          line-height: 60px;
          margin-bottom: 20px;
     }

     .calendar {
          min-height: 100%;
     }

     footer .section-wrapper {
          width: 80%;
          margin: 0 auto;
          position: inherit;
     }
</style>

<!-- SECTIONS -->
<section class="movie-banner">
     <div class="hero-wrapper">
          <div class="movie-banner-item">
               <img <?php echo "src='" . $response[0]->thumbnail_url . "' alt='" . $response[0]->title . "'"; ?> />
          </div>

          <div class="movie-card">
               <img <?php echo "src='" . $response[0]->poster_url . "' alt='" . $response[0]->title . "'"; ?> />

               <div class="movie-card-content">
                    <h2><?php echo $response[0]->title; ?></h2>

                    <ul class="movie-card-btns">
                         <?php
                         foreach (explode(", ", $response[0]->genres) as $g) {
                              echo "<li class='movie-card-btn'>
                                             " . $g . "
                                        </li>";
                         }
                         ?>
                    </ul>

                    <p class="movie-card-description">
                         <?php echo $response[0]->summary; ?>
                    </p>

                    <h3 style="font-size: 1.5rem; margin-bottom: 2px; margin-top: 8px;">Diễn viên</h3>
                    <div class="movie-casts">
                         <?php
                         echo $response[0]->actors;
                         ?>
                    </div>
                    
                    <h3 style="font-size: 1.5rem; margin-bottom: 2px; margin-top: 8px;">Đạo diễn</h3>
                    <div class="movie-casts">
                         <?php
                         echo $response[0]->director;
                         ?>
                    </div>
               </div>
          </div>

     </div>
</section>

<section class="calendar international-trailer margin" style="margin-top: 18rem;" id="trailer">
     <div class="trailer-title">
          <h3>Lịch chiếu phim</h3>
     </div>
     <div class="movie-casts" style="display: grid; grid-template-columns: repeat(7, 1fr); column-gap: 16px;">
          <div class="movie-cast-item main-color"
               style="border: 2px dashed; border-radius: 10px; display: flex; justify-content: center; align-items: center; text-align: center;">
               <?php
               $daysOfWeek = ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"];
               echo "<a href=''>" . date("d/m") . "<br><br>" . $daysOfWeek[date('w')] . "</a>";
               ?>
          </div>
          <div class="movie-cast-item"
               style="border: 2px dashed; border-radius: 10px; display: flex; justify-content: center; align-items: center; text-align: center;">
               <?php echo "<a href=''>" . date("d/m", strtotime('+1 day')) . "<br><br>" . $daysOfWeek[date("w", strtotime("+1 day"))] . "</a>"; ?>
          </div>
          <div class="movie-cast-item"
               style="border: 2px dashed; border-radius: 10px; display: flex; justify-content: center; align-items: center; text-align: center;">
               <?php echo "<a href=''>" . date("d/m", strtotime("+2 day")) . "<br><br>" . $daysOfWeek[date("w", strtotime("+2 day"))] . "</a>"; ?>
          </div>
          <div class="movie-cast-item"
               style="border: 2px dashed; border-radius: 10px; display: flex; justify-content: center; align-items: center; text-align: center;">
               <?php echo "<a href=''>" . date("d/m", strtotime("+3 day")) . "<br><br>" . $daysOfWeek[date("w", strtotime("+3 day"))] . "</a>"; ?>
          </div>
          <div class="movie-cast-item"
               style="border: 2px dashed; border-radius: 10px; display: flex; justify-content: center; align-items: center; text-align: center;">
               <?php echo "<a href=''>" . date("d/m", strtotime("+4 day")) . "<br><br>" . $daysOfWeek[date("w", strtotime("+4 day"))] . "</a>"; ?>
          </div>
          <div class="movie-cast-item"
               style="border: 2px dashed; border-radius: 10px; display: flex; justify-content: center; align-items: center; text-align: center;">
               <?php echo "<a href=''>" . date("d/m", strtotime("+5 day")) . "<br><br>" . $daysOfWeek[date("w", strtotime("+4 day"))] . "</a>"; ?>
          </div>
          <div class="movie-cast-item"
               style="border: 2px dashed; border-radius: 10px; display: flex; justify-content: center; align-items: center; text-align: center;">
               <?php echo "<a href=''>" . date("d/m", strtotime("+6 day")) . "<br><br>" . $daysOfWeek[date("w", strtotime("+4 day"))] . "</a>"; ?>
          </div>
     </div>
</section>

<section class="international-trailer margin" style="margin-top: 4rem;" id="trailer">
     <div class="trailer-title">
          <h3>Official trailer</h3>
     </div>
     <iframe width="560" height="315"
          src="<?php echo str_replace("https://youtu.be/", "https://www.youtube.com/embed/", $response[0]->trailer_url); ?>"
          title="<?= $result[0]->title ?>" frameborder="0"
          allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen></iframe>
</section>

<?php
include_once("../../layout/footer.php");
?>