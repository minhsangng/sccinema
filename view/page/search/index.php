<!DOCTYPE html>
<html lang="en">
<?php
include_once("../../../model/connect.php");
include_once("../../../model/mAPI.php");
include_once("../../../controller/cAPI.php");

$ctrlAPI = new cAPI();

if (isset($_GET["keyword"]))
    $keyword = $_GET["keyword"];
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="../../../assets/img/logo-main.png">

    <title>SCCinema - Tìm Kiếm</title>

    <!-- CSS -->
    <link rel="stylesheet" href="../../../src/css/component.css">
    <link rel="stylesheet" href="../../../src/css/style.css">
    <link rel="stylesheet" href="../../../src/css/grid.css">

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Monoton&family=Open+Sans:ital,wght@0,400;1,300&family=Playfair+Display:wght@400;700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700&family=Shizuru&display=swap"
        rel="stylesheet">

    <!-- LINK CAROUSEL -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">

    <!-- BOX ICON  -->
    <link href="https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .logo img {
            width: 90px;
        }

        .boxoffice {
            width: 200px;
        }

        @media (max-width: 850px) {
            .logo img {
                width: 50px;
            }

            .logo {
                font-size: 1.8rem;
            }

            .boxoffice {
                width: 150px;
            }

            .search-box {
                max-width: 220px;
            }
        }

        @media (max-width: 550px) {
            .logo img {
                width: 30px;
            }

            .boxoffice {
                width: 140px;
            }
        }

        footer .section-wrapper {
            left: 200px;
        }
    </style>
</head>

<body>
    <!-- NAV TABLET -->
    <div class="menu-tablet" id="menu-tablet">
        <ul class="menu-tb-list">
            <li><a href="../../../index.php">
                    Trang chủ
                </a></li>
            <li><a href="../../../index.php?p=showtime">
                    Lịch chiếu
                </a></li>
            <li><a href="../../../index.php?p=food">
                    Bắp nước
                </a></li>
            <li><a href="../../../index.php?p=ticket">
                    Đặt vé
                </a></li>
            <li><a href="../../../index.php?p=promotion">
                    Khuyến mãi
                </a></li>
            <li><a href="../../../index.php?p=account">
                    Tài khoản
                </a></li>
        </ul>
    </div>

    <!-- PROCESS BUTTON -->
    <div class="progress-bar" id="progress-bar" style="z-index: 9999;">
        <a href="#" id="progress-val">
            <ion-icon name="arrow-up-circle-outline"></ion-icon>
        </a>
    </div>

    <?php
    if (!isset($_GET["id"])) {
        echo '<div class="nav-wrapper z-50 shadow hover:bg-red-200/25">
                <ul class="nav-menu" id="nav-menu">
                    <li class="nav-item" id="home">
                        <a href="../../../">
                                <span class="nav-icon"><ion-icon name="home-outline"></ion-icon></span>
                                Trang chủ
                        </a>
                    </li>

                    <li class="nav-item" id="showtime">
                        <a href="../../../?p=showtime">
                                <span class="nav-icon"><ion-icon name="film-outline"></ion-icon></span>
                                Lịch chiếu </a>
                    </li>
                    <li class="nav-item" id="food">
                        <a href="../../../?p=food">
                                <span class="nav-icon"><ion-icon name="fast-food-outline"></ion-icon></span>
                                Bắp nước
                        </a>
                    </li>

                    <li class="nav-item" id="ticket">
                        <a href="../../../?p=ticket">
                                <span class="nav-icon"><ion-icon name="ticket-outline"></ion-icon></span>
                                Đặt vé
                        </a>
                    </li>

                    <li class="nav-item" id="promotion">
                        <a href="../../../?p=promotion">
                                <span class="nav-icon"><ion-icon name="gift-outline"></ion-icon></span>
                                Khuyến mãi
                        </a>
                    </li>

                    <li class="nav-item" id="account">
                        <a href="../../../?p=account">
                                <span class="nav-icon"><ion-icon name="person-outline"></ion-icon></span>
                                Tài khoản
                        </a>
                    </li>

                </ul>
            </div>';
    }
    ?>

    <div class="container">
        <div class="nav flex justify-between w-screen">
            <a href="../../../" class="logo relative mr-14">
                <img style="margin-right: 10px;" src="../../../assets/img/logo-main.png" />
                <h1 class="text-3xl absolute bottom-2 -right-20 text-[#c0392c]"> Cinema</h1>
            </a>

            <select name="" id="" class="search-box boxoffice">
                <option value="" class="text-black">Chọn rạp</option>
                <option value="" class="text-black">-- -- -- --</option>
                <?php
                $responseCinema = $ctrlAPI->cCallAPI("http://localhost/SCCinema/api/exportAPICinema.php");

                if ($responseCinema) {
                    foreach ($responseCinema as $row) {
                        echo "<option class='text-black' value='" . $row->cinema_name . "'>" . $row->cinema_name . "</option>";
                    }
                } else
                    echo "Không có dữ liệu";
                ?>
            </select>

            <form action="" method="GET" class="search-box">
                <input type="text" name="keyword" value="<?= $keyword ?>"
                    placeholder="Tìm theo tên phim, diễn viên, ....." class="nav-search normal-case">
                <button type="submit">
                    <i class='bx bx-search-alt'></i>
                </button>
            </form>

            <div class="nav-sign">
                <a href="view/page/signin/index.php" class="btn btn-hover">
                    <span>Đăng nhập</span>
                </a>
            </div>
            <div class="menu-toggle">
                <ion-icon name="menu-outline" class="open"></ion-icon>
                <ion-icon name="close-outline" class="close"></ion-icon>
            </div>
        </div>
    </div>

    <div class="ml-[200px] mr-[110px] mt-8">
        <div class="section-header">
            Kết quả tìm kiếm
        </div>
        <div class="grid grid-cols-4 gap-8">
            <?php
            $response = $ctrlAPI->cCallAPI("http://localhost/SCCinema/api/exportAPIMovie.php?search=" . $keyword);

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
                echo "Không tìm thấy kết quả!";
            ?>
        </div>

        <!-- <div class="w-full flex justify-center mt-8">
            <button class="border border-red-500 px-4 py-2">Xem tất cả phim đang chiếu</button>
        </div> -->
    </div>

    <footer class="footer mb-4">
        <div class="section-wrapper static ml-[200px] mr-[110px]" style="padding: 0 22px;">
            <div class="grid grid-cols-4 border-b border-[#c0392c]">
                <div class="col-span-1 footer-header">
                    <a href="../../../" class="logo relative">
                        <img style="margin-right: 10px;" src="../../../assets/img/logo-main.png" />
                        <h1 class="text-3xl absolute bottom-2 -right-20 text-[#c0392c]"> Cinema</h1>
                    </a>

                    <p class="description uppercase" style="font-size: 1rem;">
                        Popcorn, Soda, Lights, Action!
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

                <div class="col-span-3 w-full footer-item">
                    <div class="row">
                        <div class="col-4 align-items-center">
                            <div class="content">
                                <p class="main-color" style="font-size: 1.2rem;"><b>SCCinema</b></p>
                                <ul class="footer-menu">
                                    <li><a href="#"> Giới thiệu</a></li>
                                    <li><a href="#"> Liên hệ</a></li>
                                    <li><a href="#"> Tuyển dụng</a></li>
                                </ul>
                            </div>
                        </div>


                        <div class="col-4 align-items-center">
                            <div class="content">
                                <p class="main-color" style="font-size: 1.2rem;"><b>Tài khoản</b></p>
                                <ul class="footer-menu">
                                    <li><a href="#">Đăng nhập</a></li>
                                    <li><a href="#">Đăng ký</a></li>
                                    <li><a href="#">Thẻ thành viên</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-4 align-items-center">
                            <div class="content">
                                <p class="main-color" style="font-size: 1.2rem;"><b>Xem phim</b></p>
                                <ul class="footer-menu">
                                    <li><a href="#">Phim đang chiếu</a></li>
                                    <li><a href="#">Phim sắp chiếu</a></li>
                                    <li><a href="#">Xuất chiếu đặc biệt</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-2 pt-4 pb-8">
                <div class="grid-cols-1 text-sm">
                    &copy; 2025 SCCinema. All rights reserved.
                </div>
                <div class="grid-cols-1 text-right text-sm space-x-4">
                    <a href="">Chính sách bảo mật</a>
                    <a href="">Tin tức điện ảnh</a>
                    <a href="">Hỏi và đáp</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="../../../src/js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollToPlugin.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const navItems = document.querySelectorAll(".nav-item");
            const params = new URLSearchParams(window.location.search);
            const currentPage = params.get("p") || "home";

            navItems.forEach(item => {
                item.addEventListener("mouseenter", () => {
                    item.classList.add("active");
                });

                item.addEventListener("mouseleave", () => {
                    if (item.id === currentPage) {
                        item.classList.add("active");
                    } else item.classList.remove("active");
                });

                if (item.id === currentPage) {
                    item.classList.add("active");
                }
            });

            // MOBILE MENU
            let menu_tablet = document.querySelector(".menu-tablet");
            let menu_toggle = document.querySelector(".menu-toggle");

            if (menu_toggle && menu_tablet) {
                menu_toggle.onclick = function () {
                    menu_toggle.classList.toggle("active");
                    menu_tablet.classList.toggle("active");
                };
            }

            // SLIDER
            const bigSlider = document.querySelector("#big-slider");

            if (!bigSlider) return;

            const bigSlideItems = bigSlider.querySelectorAll(".big-slide-item");
            const slideNext = bigSlider.querySelector(".slide-next");
            const slidePrev = bigSlider.querySelector(".slide-prev");

            let slideIndex = 0;
            let slidePlaying = true;

            const showSlide = (index) => {
                bigSlideItems.forEach((item, i) => {
                    item.classList.toggle("active", i === index);
                });
            };

            const nextSlide = () => {
                slideIndex = (slideIndex + 1) % bigSlideItems.length;
                showSlide(slideIndex);
            };

            const prevSlide = () => {
                slideIndex = (slideIndex - 1 + bigSlideItems.length) % bigSlideItems.length;
                showSlide(slideIndex);
            };

            if (slideNext) slideNext.addEventListener("click", nextSlide);
            if (slidePrev) slidePrev.addEventListener("click", prevSlide);

            bigSlider.addEventListener("mouseover", () => (slidePlaying = false));
            bigSlider.addEventListener("mouseleave", () => (slidePlaying = true));

            setInterval(() => {
                if (slidePlaying) nextSlide();
            }, 5000);
        });

        /* Scroll to top */
        function bindScrollButton() {
            const scrollBtn = document.getElementById("progress-val");
            if (!scrollBtn) return;

            scrollBtn.addEventListener("click", (e) => {
                e.preventDefault();
                gsap.to(window, {
                    duration: 1,
                    scrollTo: { y: 0 },
                    ease: "power2.out"
                });
            });
        }

        bindScrollButton();
    </script>
</body>

</html>