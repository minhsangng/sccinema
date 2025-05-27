<title>SC Cinema - Mua Vé Xem Phim</title>

<!-- SLIDE SECTION -->
<div class="ml-[200px] mr-[110px]">
    <div class="bg-[#e6ecf9] rounded-md p-3 flex flex-wrap items-center justify-center gap-2 sm:gap-4 mb-10 text-black">
        <div class="text-[#2e2e2e] font-bold mr-8">
            <h3 style="font-size: 1.6rem;">ĐẶT VÉ NHANH</h3>
        </div>
        <select id="cinema"
            class="w-[180px] text-xl sm:text-base border border-gray-300 font-semibold rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#6b46c1] cursor-pointer"
            aria-label="Chọn Rạp">
            <option hidden value="">1. Chọn Rạp</option>
            <?php
            $response = $ctrlAPI->cCallAPI("http://localhost/SCCinema/api/exportAPICinema.php");

            if ($response) {
                foreach ($response as $row) {
                    echo '<option value="' . $row->id . '">' . $row->name . '</option>';
                }
            } else echo '<option>Không có dữ liệu</option>';
            ?>
        </select>
        <select id="movie" disabled
            class="w-[180px] text-xl sm:text-base border border-gray-300 font-semibold rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#6b46c1] cursor-pointer"
            aria-label="Chọn Phim">
            <option hidden value="">2. Chọn Phim</option>
            <?php
            $response = $ctrlAPI->cCallAPI("http://localhost/SCCinema/api/exportAPIMovie.php?status=1");

            if ($response) {
                foreach ($response as $row) {
                    echo '<option value="' . $row->id . '">' . $row->title . ' (' . $row->age_rating . ')</option>';
                }
            } else echo '<option>Không có dữ liệu</option>';
            ?>
        </select>
        <select id="date" disabled
            class="w-[180px] text-xl sm:text-base border border-gray-300 font-semibold rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#6b46c1] cursor-pointer"
            aria-label="Chọn Ngày">
            <option hidden value="">3. Chọn Ngày</option>
        </select>
        <select id="time" disabled
            class="w-[180px] text-xl sm:text-base border border-gray-300 font-semibold rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#6b46c1] cursor-pointer"
            aria-label="Chọn Suất">
            <option hidden value="">4. Chọn Suất</option>
        </select>
        <button id="ordernow"
            class="bg-[#6b46c1] text-white font-bold text-xl sm:text-base px-4 py-2 rounded whitespace-nowrap hover:bg-[#553c9a] transition">
            ĐẶT NGAY
        </button>
    </div>
    <div class="my-8">
        <h2
            class="text-center text-3xl text-white font-extrabold mb-8">
            PHIM ĐANG CHIẾU
        </h2>
        <div class="flex items-center">
            <div class="relative w-full">

                <button onclick="prevSlide()" class="absolute left-0 top-1/2 -translate-y-1/2 bg-black/60 text-white px-3 py-2 z-10">❮</button>

                <div id="carousel-wrapper" class="overflow-hidden">
                    <div id="carousel-slides" class="flex transition-transform duration-500 ease-in-out" style="transform: translateX(0%)">
                        <?php
                        $response = $ctrlAPI->cCallAPI("http://localhost/SCCinema/api/exportAPIMovie.php?status=1");
                        $total = count($response);
                        $perSlide = 4;
                        for ($i = 0; $i < $total; $i += $perSlide) {
                            echo '<div class="w-full shrink-0 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 px-4">';
                            for ($j = $i; $j < $i + $perSlide && $j < $total; $j++) {
                                $row = $response[$j];
                                echo '
                                    <div class="relative bg-[#101935] text-white rounded shadow">
                                        <div class="absolute top-0 left-1 flex items-center text-center">
                                            <div class="bg-[#ffb600] text-black text-md w-10 font-bold py-2 shadow rounded-bl-md">2D</div>
                                            <div class="bg-[#d81e06] text-white text-md w-10 font-bold py-2 shadow rounded-br-md">' . $row->age_rating . '</div>
                                        </div>
                                        <img src="' . $row->poster_url . '" alt="' . $row->title . '" class="w-full h-[300px] object-cover rounded-t">
                                        <div class="px-2 pt-2 pb-6">
                                            <h2 class="font-bold text-center text-yellow-400 text-base uppercase min-h-[48px]">' . $row->title . ' (' . $row->age_rating . ')</h2>
                                            <div class="flex justify-between gap-2 px-4 mt-2">
                                                <a href="view/page/component/?id=' . $row->id . '#trailer" class="text-white text-sm flex items-center gap-1">
                                                    <i class="fas fa-play-circle text-red-500 text-2xl mr-2"></i> Xem Trailer
                                                </a>
                                                <a href="view/page/component/?id=' . $row->id . '" class="bg-yellow-400 text-black font-bold px-6 py-1 text-sm rounded">ĐẶT VÉ</a>
                                            </div>
                                        </div>
                                    </div>';
                            }
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>

                <button onclick="nextSlide()" class="absolute right-0 top-1/2 -translate-y-1/2 bg-black/60 text-white px-3 py-2 z-10">❯</button>

                <div class="flex justify-center mt-4 gap-2">
                    <?php
                    $numSlides = ceil($total / $perSlide);
                    for ($i = 0; $i < $numSlides; $i++) {
                        echo '<div class="dot w-3 h-3 rounded-full bg-white/40 cursor-pointer" onclick="goToSlide(' . $i . ')"></div>';
                    }
                    ?>
                </div>
            </div>

        </div>
        <div class="mt-6 flex justify-center">
            <button
                class="border border-[#f7e71d] text-[#f7e71d] text-[14px] font-bold px-8 py-2 rounded-sm tracking-widest hover:bg-[#f7e71d] hover:text-black transition">
                XEM THÊM
            </button>
        </div>

        <hr class="border-white mt-20 mb-10">

        <h2
            class="text-center text-3xl text-white font-extrabold mb-8 mt-4">
            PHIM SẮP CHIẾU
        </h2>
        <div class="flex items-center">
            <div class="relative w-full">
                <button onclick="prevSlide()" class="absolute left-0 top-1/2 -translate-y-1/2 bg-black/60 text-white px-3 py-2 z-10">❮</button>

                <div id="carousel-wrapper" class="overflow-hidden">
                    <div id="carousel-slides" class="flex transition-transform duration-500 ease-in-out" style="transform: translateX(0%)">
                        <?php
                        $response = $ctrlAPI->cCallAPI("http://localhost/SCCinema/api/exportAPIMovie.php?status=2");
                        $total = count($response);
                        $perSlide = 4;
                        for ($i = 0; $i < $total; $i += $perSlide) {
                            echo '<div class="w-full shrink-0 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 px-4">';
                            for ($j = $i; $j < $i + $perSlide && $j < $total; $j++) {
                                $row = $response[$j];
                                echo '
                                    <div class="relative bg-[#101935] text-white rounded shadow">
                                        <div class="absolute top-0 left-1 flex items-center text-center">
                                            <div class="bg-[#ffb600] text-black text-md w-10 font-bold py-2 shadow rounded-bl-md">2D</div>
                                            <div class="bg-[#d81e06] text-white text-md w-10 font-bold py-2 shadow rounded-br-md">' . $row->age_rating . '</div>
                                        </div>
                                        <img src="' . $row->poster_url . '" alt="' . $row->title . '" class="w-full h-[300px] object-cover rounded-t">
                                        <div class="px-2 pt-2 pb-6">
                                            <h2 class="font-bold text-center text-yellow-400 text-base uppercase min-h-[48px]">' . $row->title . ' (' . $row->age_rating . ')</h2>
                                            <div class="flex justify-between gap-2 px-4 mt-2">
                                                <a href="view/page/component/?id=' . $row->id . '#trailer" class="text-white text-sm flex items-center gap-1">
                                                    <i class="fas fa-play-circle text-red-500 text-2xl mr-2"></i> Xem Trailer
                                                </a>
                                                <a href="view/page/component/?id=' . $row->id . '" class="bg-yellow-400 text-black font-bold px-6 py-1 text-sm rounded">TÌM HIỂU</a>
                                            </div>
                                        </div>
                                    </div>';
                            }
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>

                <button onclick="nextSlide()" class="absolute right-0 top-1/2 -translate-y-1/2 bg-black/60 text-white px-3 py-2 z-10">❯</button>

                <div class="flex justify-center mt-4 gap-2">
                    <?php
                    $numSlides = ceil($total / $perSlide);
                    for ($i = 0; $i < $numSlides; $i++) {
                        echo '<div class="dot w-3 h-3 rounded-full bg-white/40 cursor-pointer" onclick="goToSlide(' . $i . ')"></div>';
                    }
                    ?>
                </div>
            </div>

        </div>
        <div class="mt-6 flex justify-center">
            <button
                class="border border-[#f7e71d] text-[#f7e71d] text-[14px] font-bold px-8 py-2 rounded-sm tracking-widest hover:bg-[#f7e71d] hover:text-black transition">
                XEM THÊM
            </button>
        </div>
    </div>
</div>
</div>
</div>

<script>
    const slides = document.getElementById("carousel-slides");
    const dots = document.querySelectorAll(".dot");
    const totalSlides = <?= ceil($total / $perSlide) ?>;
    let currentSlide = 0;

    function updateSlide() {
        slides.style.transform = `translateX(-${currentSlide * 100}%)`;
        dots.forEach((dot, i) => {
            dot.classList.toggle("bg-white", i === currentSlide);
            dot.classList.toggle("bg-white/40", i !== currentSlide);
        });
    }

    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        updateSlide();
    }

    function prevSlide() {
        currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
        updateSlide();
    }

    function goToSlide(index) {
        currentSlide = index;
        updateSlide();
    }

    setInterval(() => {
        nextSlide();
    }, 4000);

    updateSlide();


    const cinemaSelect = document.getElementById('cinema');
    const movieSelect = document.getElementById('movie');
    const dateSelect = document.getElementById('date');
    const timeSelect = document.getElementById('time');
    const bookBtn = document.querySelector('button');

    cinemaSelect.addEventListener('change', () => {
        movieSelect.disabled = false;
    });

    movieSelect.addEventListener('change', async () => {
        const cid = cinemaSelect.value;
        const mid = movieSelect.value;

        // Lấy danh sách ngày có suất chiếu
        const res = await fetch(`http://localhost/SCCinema/api/exportAPIShowtime.php?cinema_id=${cid}&movie_id=${mid}`);
        const dates = await res.json();

        dates.forEach(d => {
            if (d.show_date != null) {
                const opt = document.createElement('option');
                opt.value = d.show_date;
                opt.textContent = formatDateLabel(d.show_date);
                dateSelect.appendChild(opt);
            }
        });

        dateSelect.disabled = false;
        timeSelect.disabled = true;
    });

    dateSelect.addEventListener('change', async () => {
        const cid = cinemaSelect.value;
        const mid = movieSelect.value;
        const date = dateSelect.value;

        // Lấy giờ chiếu theo ngày
        const res = await fetch(`http://localhost/SCCinema/api/exportAPIShowtime.php?cinema_id=${cid}&movie_id=${mid}&show_date=${date}`);
        const times = await res.json();

        times.forEach(t => {
            if (t.start_time != null) {
                t.start_time = t.start_time.slice(0, 5);
            }
        });

        updateOptions(timeSelect, times, 'showtime_id', 'start_time');
        timeSelect.disabled = false;
    });

    function updateOptions(select, data, valueKey, labelKey) {
        data.forEach(item => {
            if (item[valueKey] != null) {
                const opt = document.createElement('option');
                opt.value = item[valueKey];
                opt.textContent = item[labelKey];
                select.appendChild(opt);
            }
        });
    }

    function formatDateLabel(dateStr) {
        const days = ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"];
        const now = new Date();
        const todayStr = now.toISOString().split('T')[0];

        const date = new Date(dateStr);
        const dayName = days[date.getDay()];
        const formatted = `${String(date.getDate()).padStart(2, '0')}/${String(date.getMonth() + 1).padStart(2, '0')}`;

        if (dateStr === todayStr) {
            return `Hôm nay, ${formatted}`;
        } else {
            return `${dayName}, ${formatted}`;
        }
    }

    const ordernow = document.getElementById("ordernow");

    ordernow.addEventListener('click', () => {
        const movieId = movieSelect.value;
        const cinemaId = cinemaSelect.value;
        const showDate = dateSelect.value;
        const showtime = timeSelect.value;

        if (
            cinemaId &&
            movieId &&
            showDate &&
            showtime
        ) {
            const url = `view/page/component/?id=${movieId}&showtime_id=${showtime}`;
            window.location.href = url;
        } else {
            alert("Vui lòng chọn đầy đủ RẠP, PHIM, NGÀY và GIỜ chiếu trước khi đặt vé.");
        }
    });
</script>