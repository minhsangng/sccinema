<!DOCTYPE html>
<html lang="en">
<?php
error_reporting(1);
session_start();

include_once("../../../model/connect.php");
include_once("../../../model/mAPI.php");
include_once("../../../model/mLogin.php");
include_once("../../../controller/cAPI.php");
include_once("../../../controller/cLogin.php");

$ctrlAPI = new cAPI();
$ctrlLogin = new cLogin();

if ($ctrlLogin->cConfirmLogin($_SESSION["user"][0][2], $_SESSION["user"][0][3]) == 0) {
    echo '<script>window.location.href = "../../../?p=login";</script>';
}
?>

<head>
    <meta charset="utf-8">
    <title>Trang Quản Trị </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="../../../assets/img/logo-main.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- CDN Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        #progress-bar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            position: fixed;
            bottom: 30px;
            right: 25px;
            box-shadow: 0 0 12px rgba(255, 255, 255, 0.2);
            display: grid;
            place-items: center;
            z-index: 200;
            cursor: pointer;
        }

        #progress-val {
            width: calc(100% - 5px);
            height: calc(100% - 5px);
            background-color: #3a3a3a;
            border-radius: 50%;
            font-weight: 700;
            font-size: 1.4rem;
            display: grid;
            place-items: center;
        }
    </style>
</head>

<body>
    <!-- Back to Top -->
    <div id="progress-bar" style="z-index: 9999;">
        <a href="javascript:void(0)" id="progress-val" onclick="
                  let scrollInterval = setInterval(function () {
                       if (window.scrollY !== 0) window.scrollBy(0, -window.scrollY / 10);
                       else clearInterval(scrollInterval);
                  }, 10);">
            <ion-icon name="arrow-up-circle-outline"></ion-icon>
        </a>
    </div>

    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="index.html" class="navbar-brand relative mx-4 mb-3">
                    <img src="../../../assets/img/logo-main.png" style="width: 50px;" alt="">
                    <h1 class="text-2xl absolute bottom-1 -right-20 text-[#c0392c]"> Cinema</h1>
                </a>

                <div class="navbar-nav w-100">
                    <a href="index.php" class="nav-item nav-link active" id="home"><i class="fa fa-tachometer-alt me-2"></i>Tổng quan</a>
                    <a href="?p=update" class="nav-item nav-link" id="update"><i class="fa fa-laptop me-2"></i>Quản lý phim</a>
                    <a href="?p=cinema" class="nav-item nav-link" id="cinema"><i class="fa fa-keyboard me-2"></i>Quản lý rạp</a>
                    <a href="?p=staff" class="nav-item nav-link" id="staff"><i class="fa fa-users me-2"></i></i>Quản lý nhân viên</a>
                    <a href="?p=shift" class="nav-item nav-link" id="shift"><i class="fa fa-chart-bar me-2"></i>Lịch làm việc</a>
            </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars text-[#bc1212]"></i>
                </a>
                <form class="d-none d-md-flex ms-4">
                    <input class="form-control bg-dark border-0" type="search" name="s" placeholder="Search">
                </form>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Thông báo</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-center">Tất cả thông báo</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle flex items-center" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="../../../assets/img/others/user-logo.png" alt="User Logo"
                                style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex"><?= $_SESSION["user"][0][1] ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item">Tài khoản</a>
                            <a href="#" class="dropdown-item">Cài đặt</a>
                            <a href="../logout/" class="dropdown-item">Đăng xuất</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <?php
            $page = isset($_GET["p"]) ? $_GET["p"] : "home";

            include_once("../../../view/page/admin/" . $page . ".php");
            ?>

            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">SCCinema</a>, All Right Reserved.
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            Phát triển bởi <a href="#" class="text-[#bc1212]">Nguyễn Minh Sang</a> - <a href="#" class="text-[#bc1212]">Võ Ngọc Châu</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

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


        const navItems = document.querySelectorAll(".nav-item");
        const params = new URLSearchParams(window.location.search);
        const currentPage = params.get("p") || "home";

        navItems.forEach(item => {
            item.classList.remove("active");

            item.addEventListener("click", () => {
                item.classList.add("active");
            });

            item.addEventListener("mouseleave", () => {
                if (item.id === currentPage) {
                    item.classList.add("active");
                }
            });

            if (item.id === currentPage) {
                item.classList.add("active");
            }
        });

        $(document).ready(function() {
            const calendar = $("#calender").datetimepicker({
                inline: true,
                format: "L",
                defaultDate: moment(), // tự chọn ngày hôm nay
            });

            function loadShiftForDate(dateMoment) {
                const selectedDate = dateMoment.format("YYYY/MM/DD");
                const displayDate = dateMoment.format("YYYY-MM-DD");

                $("#shifts").html(`<p class="text-muted">Đang tải dữ liệu cho ngày <strong>${displayDate}</strong>...</p>`);

                $.ajax({
                    url: `http://localhost/SCCinema/api/exportAPIShift.php?date=${selectedDate}`,
                    method: "GET",
                    dataType: "json",
                    success: function(data) {
                        if (!Array.isArray(data) || data.length === 0) {
                            $("#shifts").html(`<div class="flex items-center"><p class="text-danger">Chưa có dữ liệu</p><button class="ml-3 text-sm btn btn-primary">Thêm ca</button></div>`);
                            return;
                        }

                        let html = `<div class="flex justify-between items-center"><h5 class="mb-3">Danh sách ca làm ngày <strong>${displayDate}</strong>:</h5><button class="mb-3 text-sm btn btn-primary">Thêm ca</button></div>`;
                        html += `<div class="list-group">`;

                        data.forEach((shift) => {
                            html += `
                                <div class="list-group-item list-group-item-action mb-2 shadow-sm rounded border">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1 text-primary">${shift.shift_name}</h6>
                                            <p class="mb-0"><strong>Mã nhân viên:</strong> ${shift.staff_id}</p>
                                            <p class="mb-0"><strong>Tên nhân viên:</strong> ${shift.full_name}</p>
                                        </div>
                                        <div class="grid grid-cols-1 gap-y-2">
                                            <p class="badge bg-success">${shift.start_time.slice(0, 5)} - ${shift.end_time.slice(0, 5)}</p>
                                            <button class="pb-1 rounded border-b border-gray-400 text-sm">Xóa ca</button>
                                        </div>
                                    </div>
                                </div>
                                `;
                        });

                        html += `</div>`;
                        $("#shifts").html(html);
                    },
                    error: function(err) {
                        console.error("Lỗi khi gọi API:", err);
                        $("#shifts").html(`<p class="text-danger">Không thể tải dữ liệu. Vui lòng thử lại.</p>`);
                    },
                });
            }

            // Bắt sự kiện chọn ngày từ calendar
            $("#calender").on("change.datetimepicker", function(e) {
                if (e.date) {
                    loadShiftForDate(e.date);
                }
            });

            // Gọi dữ liệu của hôm nay ngay khi trang vừa load
            loadShiftForDate(moment());
        });
    </script>
</body>

</html>