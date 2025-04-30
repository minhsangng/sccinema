<title>Lịch chiếu- SC Cinema | Đặt vé xem phim trực tuyến</title>
<?php
$date = date("Y-m-d", strtotime("+2 days"));

$response = $ctrlAPI->cCallAPI("http://localhost/SCCinema/api/exportAPIShowtime.php?date=" . $date);
?>
<!-- SLIDE SECTION -->
<div class="section">
    <div class="">
        <div class="flex justify-between space-x-8">
            <div class="w-1/2 px-8 py-4 rounded-lg border border-red-500 flex justify-between items-center">
                <label for="" class="text-xl font-bold mr-8 w-[40%]">1. Chọn ngày</label>
                <select name="" id="" class="text-black px-4 py-1 rounded-lg w-full">
                    <?php
                    if ($response) {
                        foreach ($response as $row) {
                            $date = new DateTime($row->show_date);
                            $today = new DateTime();
                            if ($date->format("Y-m-d") == $today->format("Y-m-d"))
                                echo "<option value=''>Hôm nay, " . $date->format("d/m") . "</option>";
                            else {
                                $days = ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"];
                                $weekday = $days[$date->format("w")];
                                echo "<option value=''>" . $weekday . ", " . $date->format("d/m") . "</option>";
                            }
                        }
                    } else
                        echo "<option>Không có dữ liệu</option>";
                    ?>
                </select>
            </div>
            <div class="w-1/2 p-4 rounded-lg border border-red-500 flex justify-between items-center">
                <label for="" class="text-xl font-bold mr-8 w-[40%]">2. Chọn phim</label>
                <select name="" id="" class="text-black px-4 py-1 rounded-lg w-full">
                    <option value="" selected>Chọn phim</option>
                    <?php
                    if ($response) {
                        foreach ($response as $row) {
                            echo "<option value='" . $row->movie_id . "'>" . $row->title . "</option>";
                        }
                    } else
                        echo "Không có dữ liệu";
                    ?>
                </select>
            </div>
        </div>
        <div class="my-8">
            <div class="px-8 py-4 border-t border-b border-red-400 flex justify-between space-x-4">
                <div class="w-[30%]">
                    <img src="assets/img/ico.png" alt="">
                    <h2>Tìm xác: Ma không đầu</h2>
                    <ul>
                        <li>Hài, Kinh dị</li>
                        <li>109 phút</li>
                        <li>Việt Nam</li>
                        <li>T18: Phim dành cho người từ 18 tuổi trở lên</li>
                    </ul>
                </div>
                <div class="w-full">
                    <div class="grid grid-cols-3">
                        <div class="col-span-1">
                            a
                        </div>
                        <div class="col-span-2">
                            b
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if ($response) {
                foreach ($response as $row) {

                }
            } else
                echo "Không có dữ liệu";
            ?>
        </div>
    </div>
</div>