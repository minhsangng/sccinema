<footer class="footer mb-4">
    <div class="section-wrapper static ml-[200px] mr-[110px]" style="padding: 0 22px;">
        <div class="grid grid-cols-4 border-b border-[#c0392c]">
            <div class="col-span-1 footer-header">
                <a href="index.php" class="logo relative">
                    <img style="margin-right: 10px;"
                        src="<?= (isset($_GET["id"]) ? "../../../" : "") ?>assets/img/logo-main.png" />
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

<script src="<?= (isset($_GET["id"]) ? "../../../" : "") ?>src/js/main.js"></script>
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