<title>SC Cinema - Lịch chiếu Phim</title>

<!-- SLIDE SECTION -->
<div class="ml-[200px] mr-[110px]">
    <div>
        <div class="grid grid-cols-3 gap-x-8">
            <div class="px-8 py-4 rounded-lg border border-red-500">
                <label class="text-xl font-bold mr-8 w-full flex justify-between items-center">
                    1. Chọn ngày <i class="fa-solid fa-calendar"></i>
                </label>
                <select id="dateSelect" class="text-black px-4 py-1 mt-2 rounded-lg w-full"></select>
            </div>
            <div class="p-4 rounded-lg border border-red-500">
                <label class="text-xl font-bold mr-8 w-full flex justify-between items-center">
                    2. Chọn phim <i class="fa-solid fa-film"></i>
                </label>
                <select id="movieFilter" class="text-black px-4 py-1 mt-2 rounded-lg w-full">
                    <option value="" disabled selected hidden>Chọn phim</option>
                </select>
            </div>
            <div class="p-4 rounded-lg border border-red-500">
                <label class="text-xl font-bold mr-8 w-full flex justify-between items-center">
                    3. Chọn rạp <i class="fa-solid fa-location-dot"></i>
                </label>
                <select id="cinemaFilter" class="text-black px-4 py-1 mt-2 rounded-lg w-full invalid:text-gray-200!" required>
                    <option value="" disabled selected hidden>Chọn rạp</option>
                </select>
            </div>
        </div>
        <div class="my-8" id="showtimeList"></div>
    </div>
</div>

<script>
    // --- Khởi tạo ngày chọn trong 7 ngày tới ---
    const dateSelect = document.getElementById('dateSelect');
    const movieSelect = document.getElementById('movieFilter');
    const cinemaSelect = document.getElementById('cinemaFilter');
    const showtimeContainer = document.getElementById('showtimeList');

    const daysVN = ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"];

    function initDateOptions() {
        dateSelect.innerHTML = "";
        for (let i = 0; i < 7; i++) {
            const d = new Date();
            d.setDate(d.getDate() + i);
            const weekday = daysVN[d.getDay()];
            const dateStr = `${String(d.getDate()).padStart(2,'0')}/${String(d.getMonth()+1).padStart(2,'0')}`;
            const option = document.createElement('option');
            option.value = dateStr;
            option.textContent = (i === 0 ? "Hôm nay, " : weekday + ", ") + dateStr;
            dateSelect.appendChild(option);
        }
    }

    // Chuyển dd/mm sang yyyy-mm-dd (ISO)
    function convertToISODate(ddmm) {
        const [dd, mm] = ddmm.split('/');
        const yyyy = new Date().getFullYear();
        return `${yyyy}-${mm}-${dd}`;
    }

    // Đổ option phim
    function populateMovieSelect(movies) {
        movieSelect.innerHTML = `<option value="" disabled selected hidden>Chọn phim</option>`;
        movies.forEach(m => {
            const opt = document.createElement('option');
            opt.value = m.id;
            opt.textContent = m.title;
            movieSelect.appendChild(opt);
        });
    }

    // Đổ option rạp
    function populateCinemaSelect(cinemas) {
        cinemaSelect.innerHTML = `<option value="" disabled selected hidden>Chọn rạp</option>`;
        for (const id in cinemas) {
            const opt = document.createElement('option');
            opt.value = id;
            opt.textContent = cinemas[id].name;
            cinemaSelect.appendChild(opt);
        }
    }

    // Lấy danh sách phim duy nhất từ dữ liệu lịch chiếu
    function extractMoviesFromShowtime(showtimes) {
        const movieMap = {};
        showtimes.forEach(item => {
            if (!movieMap[item.movie_id]) {
                movieMap[item.movie_id] = {
                    id: item.movie_id,
                    title: item.title
                };
            }
        });
        return Object.values(movieMap);
    }

    // Lấy danh sách rạp duy nhất từ lịch chiếu
    function extractCinemasFromShowtime(showtimes) {
        const cinemaMap = {};
        showtimes.forEach(item => {
            if (!cinemaMap[item.cinema_id]) {
                cinemaMap[item.cinema_id] = {
                    name: item.cinema_name,
                };
            }
        });
        return cinemaMap;
    }

    // Dữ liệu toàn bộ lịch chiếu hôm nay
    let rawData = [];
    // Danh sách rạp lấy từ API showtime để dùng khi không có lịch chiếu
    let allCinemas = {};

    // Load danh sách rạp toàn bộ (để sử dụng khi không có lịch chiếu ngày)
    async function loadAllCinemas() {
        // Gọi API lấy toàn bộ lịch chiếu (không lọc ngày) để lấy danh sách rạp
        const res = await fetch('http://localhost/SCCinema/api/exportAPIShowtime.php');
        const data = await res.json();
        allCinemas = extractCinemasFromShowtime(data);
    }

    // Hàm render danh sách lịch chiếu theo dữ liệu
    function renderShowtimeList(data) {
        showtimeContainer.innerHTML = "";
        if (!data || data.length === 0) {
            showtimeContainer.innerHTML = `
                <div class="text-center text-red-500 text-xl font-semibold py-12">
                  Hiện chưa có lịch chiếu.
                </div>`;
            return;
        }

        // Gom nhóm theo phim -> rạp
        const grouped = {};
        data.forEach(item => {
            const mid = item.movie_id;
            const cid = item.cinema_id;

            if (!grouped[mid]) {
                grouped[mid] = {
                    title: item.title,
                    poster_url: item.poster_url,
                    thumbnail_url: item.thumbnail_url,
                    genres: item.genres,
                    duration: item.duration,
                    country: item.country,
                    age_rating: item.age_rating,
                    cinemas: {},
                    hasShowtime: false
                };
            }

            if (item.start_time && item.show_date) {
                grouped[mid].hasShowtime = true;
                if (!grouped[mid].cinemas[cid]) {
                    grouped[mid].cinemas[cid] = {
                        name: item.cinema_name,
                        address: item.address,
                        showtimes: []
                    };
                }
                grouped[mid].cinemas[cid].showtimes.push(item.start_time.slice(0, 5));
            }
        });

        Object.values(grouped).forEach(movie => {
            let html = `
              <div class="py-4 border-t border-b border-red-400 flex justify-between space-x-4 bg-center bg-cover bg-no-repeat"
                   style="background-image: linear-gradient(to top, rgba(0, 0, 0, 0.7), rgba(0,0,0,0.7)), url(${movie.thumbnail_url});">
                  <div class="w-[30%] text-white">
                      <img src="${movie.poster_url}" alt="${movie.title}">
                      <h2 class="font-bold text-2xl mt-2 mb-4">${movie.title}</h2>
                      <ul class="space-y-2">
                          <li><i class="mr-2 fa-solid fa-tags"></i>${movie.genres}</li>
                          <li><i class="mr-2 fa-solid fa-clock"></i>${movie.duration}</li>
                          <li><i class="mr-2 fa-solid fa-earth-asia"></i>${movie.country}</li>
                          <li><i class="mr-2 fa-solid fa-user-tag"></i>${movie.age_rating}</li>
                      </ul>
                  </div>
                  <div class="w-full h-fit text-white">`;

            if (movie.hasShowtime) {
                Object.values(movie.cinemas).forEach(cinema => {
                    html += `
                      <div class="grid grid-cols-3 mb-4 pb-8 border-b border-red-200">
                          <div class="col-span-1">
                              <h3 class="font-bold text-3xl">SCCinema</h3>
                              <h4 class="font-bold text-xl">${cinema.name}</h4>
                              <p>${cinema.address}</p>
                          </div>
                          <div class="col-span-2">
                              <h4 class="mb-4">Suất chiếu</h4>`;
                    cinema.showtimes.forEach(time => {
                        html += `<button class="inline-block border border-red-300 p-2 rounded-lg w-fit mr-2 bg-white text-black font-bold hover:bg-red-500 hover:text-white">${time}</button>`;
                    });
                    html += `</div></div>`;
                });
            } else {
                html += `
                    <div class="text-center text-red-300 text-lg font-semibold py-12">
                      Hiện chưa có lịch chiếu
                    </div>`;
            }

            html += `</div></div>`;
            showtimeContainer.innerHTML += html;
        });
    }

    // Hàm load dữ liệu lịch chiếu theo ngày
    async function loadShowtimeByDate(date_ddmm) {
        const isoDate = convertToISODate(date_ddmm);
        const res = await fetch(`http://localhost/SCCinema/api/exportAPIShowtime.php?show_date=${isoDate}`);
        const data = await res.json();

        rawData = data;

        if (data.length === 0) {
            // Không có lịch chiếu ngày này
            // Lấy danh sách phim đang chiếu
            const resMovie = await fetch('http://localhost/SCCinema/api/exportAPIMovie.php?status=1');
            const movies = await resMovie.json();

            // Đổ phim vào select
            populateMovieSelect(movies);

            // Đổ rạp lấy từ allCinemas (tải 1 lần)
            populateCinemaSelect(allCinemas);

            // Hiển thị thông báo không có lịch chiếu
            showtimeContainer.innerHTML = `
              <div class="text-center text-red-500 text-xl font-semibold py-12">
                  Hiện chưa có lịch chiếu.
              </div>`;
        } else {
            // Có lịch chiếu
            // Lấy phim và rạp duy nhất từ dữ liệu
            const uniqueMovies = extractMoviesFromShowtime(data);
            const uniqueCinemas = extractCinemasFromShowtime(data);

            // Đổ option phim, rạp
            populateMovieSelect(uniqueMovies);
            populateCinemaSelect(uniqueCinemas);

            // Hiển thị danh sách lịch chiếu
            renderShowtimeList(data);
        }
    }

    // Lọc và hiển thị theo phim và rạp
    function filterAndRender() {
        const selectedMovie = movieSelect.value;
        const selectedCinema = cinemaSelect.value;

        const filtered = rawData.filter(item => {
            const movieMatch = selectedMovie ? item.movie_id == selectedMovie : true;
            const cinemaMatch = selectedCinema ? item.cinema_id == selectedCinema : true;
            return movieMatch && cinemaMatch;
        });

        renderShowtimeList(filtered);
    }

    // Event listeners
    dateSelect.addEventListener('change', () => loadShowtimeByDate(dateSelect.value));
    movieSelect.addEventListener('change', filterAndRender);
    cinemaSelect.addEventListener('change', filterAndRender);

    // --- Khởi tạo ---
    (async () => {
        initDateOptions();

        // Tải danh sách rạp toàn bộ để dùng khi không có lịch chiếu
        await loadAllCinemas();

        // Chọn ngày hôm nay mặc định và load dữ liệu
        const today = new Date();
        const todayStr = `${String(today.getDate()).padStart(2,'0')}/${String(today.getMonth()+1).padStart(2,'0')}`;
        dateSelect.value = todayStr;
        loadShowtimeByDate(todayStr);
    })();
</script>