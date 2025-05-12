<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="<?= (isset($_GET["id"]) ? "../../../" : "") ?>assets/img/logo-main.png">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= (isset($_GET["id"]) ? "../../../" : "") ?>src/css/component.css">
    <link rel="stylesheet" href="<?= (isset($_GET["id"]) ? "../../../" : "") ?>src/css/style.css">
    <link rel="stylesheet" href="<?= (isset($_GET["id"]) ? "../../../" : "") ?>src/css/grid.css">

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
            <li><a href="index.php">
                    Trang chủ
                </a></li>
            <li><a href="index.php?p=showtime">
                    Lịch chiếu
                </a></li>
            <li><a href="index.php?p=food">
                    Bắp nước
                </a></li>
            <li><a href="index.php?p=ticket">
                    Đặt vé
                </a></li>
            <li><a href="index.php?p=promotion">
                    Khuyến mãi
                </a></li>
            <li><a href="index.php?p=account">
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
                        <a href="">
                                <span class="nav-icon"><ion-icon name="home-outline"></ion-icon></span>
                                Trang chủ
                        </a>
                    </li>

                    <li class="nav-item" id="showtime">
                        <a href="?p=showtime">
                                <span class="nav-icon"><ion-icon name="film-outline"></ion-icon></span>
                                Lịch chiếu </a>
                    </li>
                    <li class="nav-item" id="food">
                        <a href="?p=food">
                                <span class="nav-icon"><ion-icon name="fast-food-outline"></ion-icon></span>
                                Bắp nước
                        </a>
                    </li>

                    <li class="nav-item" id="ticket">
                        <a href="?p=ticket">
                                <span class="nav-icon"><ion-icon name="ticket-outline"></ion-icon></span>
                                Đặt vé
                        </a>
                    </li>

                    <li class="nav-item" id="promotion">
                        <a href="?p=promotion">
                                <span class="nav-icon"><ion-icon name="gift-outline"></ion-icon></span>
                                Khuyến mãi
                        </a>
                    </li>

                    <li class="nav-item" id="account">
                        <a href="?p=account">
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
            <a href="index.php" class="logo relative mr-14">
                <img style="margin-right: 10px;"
                    src="<?= (isset($_GET["id"]) ? "../../../" : "") ?>assets/img/logo-main.png" />
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

            <form action="view/page/search/" method="GET" class="search-box">
                <input type="text" name="keyword" placeholder="Tìm theo tên phim, diễn viên, ....." class="nav-search normal-case">
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