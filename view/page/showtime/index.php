<title>SC Cinema - Lịch chiếu Phim</title>

<!-- SLIDE SECTION -->
<div class="ml-[200px] mr-[110px]">
    <div class="">
        <div class="grid grid-cols-3 gap-x-8">
            <div class="px-8 py-4 rounded-lg border border-red-500">
                <label for="" class="text-xl font-bold mr-8 w-full flex justify-between items-center">1. Chọn ngày <i
                        class="fa-solid fa-calendar"></i></label>
                <select name="" id="" class="text-black px-4 py-1 mt-2 rounded-lg w-full">
                    <?php
                    $days = ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"];

                    for ($i = 0; $i < 7; $i++) {
                        $day = new DateTime();
                        $day->modify("+$i day");
                        $weekday = $days[$day->format("w")];
                        $date = $day->format("d/m");

                        if ($i == 0) {
                            echo "<option value='{$date}'>Hôm nay, $date</option>";
                        } else {
                            echo "<option value='{$date}'>$weekday, $date</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="p-4 rounded-lg border border-red-500">
                <label for="" class="text-xl font-bold mr-8 w-full flex justify-between items-center">2. Chọn phim <i
                        class="fa-solid fa-film"></i></label>
                <select name="" id="" class="text-black px-4 py-1 mt-2 rounded-lg w-full">
                    <option value="" disabled selected hidden>Chọn phim</option>
                    <?php
                    $responseMovie = $ctrlAPI->cCallAPI("http://localhost/SCCinema/api/exportAPIMovie.php?status=1");
                    
                    if ($responseMovie) {
                        foreach ($responseMovie as $row) {
                            echo "<option value='" . $row->movie_id . "'>" . $row->title . ($row->age_rating != "P" && $row->age_rating != "K" ? " (".$row->age_rating.")" : "")."</option>";
                        }
                    } else
                        echo "Không có dữ liệu";
                    ?>
                </select>
            </div>

            <div class="p-4 rounded-lg border border-red-500">
                <label for="" class="text-xl font-bold mr-8 w-full flex justify-between items-center">3. Chọn rạp <i
                        class="fa-solid fa-location-dot"></i></label>
                <select name="" id="" class="text-black px-4 py-1 mt-2 rounded-lg w-full invalid:text-gray-200!" required>
                    <option value="" disabled selected hidden>Chọn rạp</option>
                    <?php
                    $responseCinema = $ctrlAPI->cCallAPI("http://localhost/SCCinema/api/exportAPICinema.php");

                    $cinemaMap = [];
                    if ($responseCinema) {
                        foreach ($responseCinema as $row) {
                            $cinemaMap[$row->cinema_id] = [
                                "cinema_name" => $row->cinema_name,
                                "address" => $row->address
                            ];

                            echo "<option value='" . $row->cinema_name . "'>" . $row->cinema_name . "</option>";
                        }
                    } else
                        echo "Không có dữ liệu";
                    ?>
                </select>
            </div>
        </div>
        <div class="my-8">
            <?php
            $date = date("Y-m-d", strtotime("-2 days"));
            $response = $ctrlAPI->cCallAPI("http://localhost/SCCinema/api/exportAPIShowtime.php?date=". $date);
            
            if ($response) {
                foreach ($response as $row) {
                    $cinemas = [];

                    $showtimes = explode(",", $row->showtimes);
                    foreach ($showtimes as $showtime) {
                        list($cinema_id, $start_time) = explode("-", trim($showtime));

                        $cinemas[$cinema_id]["start_times"][] = $start_time;
                    }

                    echo '<div class="py-4 border-t border-b border-red-400 flex justify-between space-x-4 bg-center bg-cover bg-no-repeat" style="background-image: linear-gradient(to top, rgba(0, 0, 0, 0.7) 0%, rgba(0,0,0,0.7) 100%), url(' . $row->thumbnail_url . ');">
                            <div class="w-[30%]">
                                <img src="' . $row->poster_url . '" alt="' . $row->title . '">
                                <h2 class="font-bold text-2xl mt-2 mb-4">' . $row->title . '</h2>
                                <ul class="space-y-2">
                                    <li><i class="mr-2 fa-solid fa-tags"></i>' . $row->genres . '</li>
                                    <li><i class="mr-2 fa-solid fa-clock"></i>' . $row->duration . '</li>
                                    <li><i class="mr-2 fa-solid fa-earth-asia"></i>' . $row->country . '</li>
                                    <li><i class="mr-2 fa-solid fa-user-tag"></i>' . $row->age_rating . '</li>
                                </ul>
                            </div>
                        <div class="w-full h-fit">';

                    foreach ($cinemas as $cinema_id => $data) {
                        $cinema_name = $cinemaMap[(int) $cinema_id]["cinema_name"];
                        $address = $cinemaMap[(int) $cinema_id]["address"];

                        if (empty($data["start_times"]))
                            echo '<p class="inline-block border border-red-300 p-2 rounded-lg w-full text-left mr-2">
                                        <i class="mr-2 fa-solid fa-clapperboard"></i>Chưa có xuất chiếu
                                    </p>';
                        else {
                            echo '<div class="grid grid-cols-3 mb-4 pb-8 border-b border-red-200">
                                    <div class="col-span-1">
                                        <h3 class="font-bold text-3xl">SCCinema</h3>
                                        <h4 class="font-bold text-xl">' . $cinema_name . '</h4>
                                        <p>' . $address . '</p>
                                    </div>
                                    <div class="col-span-2">
                                        <h4 class="mb-4">Suất chiếu</h4>';

                            foreach ($data["start_times"] as $time) {
                                echo '<button class="inline-block border border-red-300 p-2 rounded-lg w-fit mr-2">' . substr($time, 0, 6) . '</button>';
                            }

                            echo '</div></div>';
                        }
                    }

                    echo '</div></div>';
                }
            } else
                echo "Không có dữ liệu";
            ?>
        </div>
    </div>
</div>