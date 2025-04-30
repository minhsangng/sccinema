<!DOCTYPE html>
<html lang="en">

<?php
error_reporting(1);
include_once("../../../model/connect.php");
include_once("../../../model/mAPI.php");
include_once("../../../controller/cAPI.php");

$ctrlAPI = new cAPI();

if (isset($_GET["id"]))
     $id = $_GET["id"];
     
$response = $ctrlAPI->cCallAPI("http://localhost/SCCinema/api/exportAPIMovie.php?id=".$id);
?>

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">

     <title><?php echo (!empty($result[0]) ? $result[0]->title : ""); ?> - SC Cinema | Đặt vé xem phim trực tuyến</title>

     <link rel="shortcut icon" href="../../../assets/img/ico.png">

     <!-- CSS -->
     <link rel="stylesheet" href="../../../src/css/style.css">
     <link rel="stylesheet" href="../../../src/css/grid.css">
     <link rel="stylesheet" href="../../../src/css/component.css">

     <!-- GOOGLE FONTS -->
     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap"
          rel="stylesheet">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Monoton&family=Open+Sans:ital,wght@0,400;1,300&family=Playfair+Display:wght@400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&family=Shizuru&display=swap"
          rel="stylesheet">

     <!-- BOX ICON  -->
     <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
     <!-- <link rel="stylesheet" href="../../../assets/fontawesome-free-5.15.4-web/css/all.min.css"> -->
     <!-- <link rel="stylesheet" href="../../../themify-icons/themify-icons.css"> -->
     <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
     <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</head>

<body>

     <div class="progress-bar" id="progress-bar" style="z-index: 9999;">
          <a href="javascript:void(0)" id="progress-val" onclick="
                  let scrollInterval = setInterval(function () {
                       if (window.scrollY !== 0) window.scrollBy(0, -window.scrollY / 10);
                       else clearInterval(scrollInterval);
                  }, 10);">
               <ion-icon name="arrow-up-circle-outline"></ion-icon>
          </a>
     </div>

     <div class="container">
          <div class="nav bg-color">
               <a href="index.html" class="logo">
                    <img style="margin-right: 10px; width: 80px;" src="../../../assets/img/ico.png" />
               </a>

               <form action="" class="search-box">
                    <input type="text" name="search" placeholder="Tìm theo tên phim, diễn viên, ....."
                         class="nav-search">
                    <button type="password">
                         <i class='bx bx-search-alt'></i>
                    </button>
               </form>

               <div class="nav-sign">
                    <a href="#" class="btn btn-hover">
                         <span>Đăng nhập</span>
                    </a>

               </div>
               <div class="menu-toggle">
                    <ion-icon name="menu-outline" class="open"></ion-icon>
                    <ion-icon name="close-outline" class="close"></ion-icon>
               </div>
          </div>
     </div>

     <!-- SECTIONS -->
     <section class="movie-banner">
          <div class="hero-wrapper">
               <div class="movie-banner-item">
                    <img <?php echo "src='" . $response[0]->thumbnail_url . "' alt='" . $response[0]->title . "'"; ?> />
               </div>

               <div class="movie-card">
                    <img <?php echo "src='" . $response[0]->poster_url . "' alt='" .  $response[0]->title . "'"; ?> />

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

                         <h3 style="font-size: 2rem;">Lịch chiếu phim</h3>
                         <div class="movie-casts"
                              style="display: flex; justify-content: space-between; align-items: center;">
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
                         </div>
                    </div>
               </div>

          </div>
     </section>

     <section class="international-trailer margin" style="margin-top: 18rem;" id="trailer">
          <div class="trailer-title">
               <h3>official trailer</h3>
          </div>
          <iframe width="560" height="315" src="<?php echo str_replace("https://youtu.be/", "https://www.youtube.com/embed/", $response[0]->trailer_url); ?>" title="<?=$result[0]->title?>"
               frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
               allowfullscreen></iframe>
     </section>

     <footer class="footer">
          <div class="section-wrapper trailer">
               <div class="row">
                    <div class="col-6 footer-header">
                         <a href="#" class="logo">
                              <img style="margin-right: 10px; width: 80px;" src="../../../assets/img/ico.png" />
                         </a>

                         <p class="description">
                              Lorem ipsum dolor sit amet consectetur adipisicing elit.
                              Quas, possimus eius. Deserunt non odit, cum vero reprehenderit
                              laudantium odio vitae autem quam, incidunt molestias ratione mollitia accusantium,
                              facere ab suscipit.
                         </p>
                         <div class="social-list">
                              <a href="#" class="social-item">
                                   <i class="bx bxl-facebook"></i>
                              </a>
                              <a href="#" class="social-item">
                                   <i class="bx bxl-instagram"></i>
                              </a>
                              <a href="#" class="social-item">
                                   <i class="bx bxl-twitter"></i>
                              </a>
                         </div>
                    </div>

                    <div class="col-12 footer-item">
                         <div class="row">
                              <div class="col-4 align-items-center">
                                   <div class="content">
                                        <p class="main-color" style="font-size: 1.2rem;"><b>Flix</b></p>
                                        <ul class="footer-menu">
                                             <li><a href="#"> About us</a></li>
                                             <li><a href="#"> My profile</a></li>
                                             <li><a href="#"> Pricing plans</a></li>
                                             <li><a href="#"> Contacts</a></li>
                                        </ul>
                                   </div>
                              </div>


                              <div class="col-4 align-items-center">
                                   <div class="content">
                                        <p class="main-color" style="font-size: 1.2rem;"><b>Browse</b></p>
                                        <ul class="footer-menu">
                                             <li><a href="#">Live TV</a></li>
                                             <li><a href="#">Live Movies</a></li>
                                             <li><a href="#">Live Series</a></li>
                                             <li><a href="#">Streaming Library</a></li>
                                        </ul>
                                   </div>
                              </div>

                              <div class="col-4 align-items-center">
                                   <div class="content">
                                        <p class="main-color" style="font-size: 1.2rem;"><b>Help</b></p>
                                        <ul class="footer-menu">
                                             <li><a href="#">Account & Billing</a></li>
                                             <li><a href="#">Plans & Pricing</a></li>
                                             <li><a href="#">Supported devices</a></li>
                                             <li><a href="#">Accessibility</a></li>
                                        </ul>
                                   </div>
                              </div>

                         </div>
                    </div>
               </div>
          </div>
     </footer>

     <script>
          // PROGRESS BAR
          let scrollPrecentage = () => {
               let scrollProgress = document.getElementById("progress-bar");
               /* let progressVal = document.getElementById("progress-val") */
               let pos = document.documentElement.scrollTop;
               let calcHeight =
                    document.documentElement.scrollHeight -
                    document.documentElement.clientHeight;
               let scrollVal = Math.round((pos * 100) / calcHeight);
               scrollProgress.style.background = `conic-gradient(#e70634 ${scrollVal}%, #2b2f38 ${scrollVal}%)`;
          };

          window.onload = scrollPrecentage;
          window.onscroll = scrollPrecentage;
     </script>
</body>

</html>