<title>SC Cinema - Đặt Bắp Nước</title>

<div class="ml-[200px] mr-[110px] mt-8 mb-20">
    <div class="grid grid-cols-1">
        <h2 class="uppercase text-center text-2xl">Chọn rạp gần bạn</h2>
        <select name="" id="" class="w-1/2 mx-auto mt-4 rounded-lg text-black px-8 py-2">
            <?php
            $responseCinema = $ctrlAPI->cCallAPI("http://localhost/SCCinema/api/exportAPICinema.php");

            if ($responseCinema) {
                foreach ($responseCinema as $row) {
                    echo "<option class='text-black' value='" . $row->cinema_name . "'>" . $row->cinema_name . "</option>";
                }
            } else
                echo "<option>Không có dữ liệu</option>";
            ?>
        </select>
    </div>
    <div class="grid grid-cols-1 mt-8">
        <h2 class="uppercase text-center text-2xl">Combo 2 ngăn</h2>
        <div class="grid grid-cols-3 gap-8 mt-4">
            <?php
            $responseFood = $ctrlAPI->cCallAPI("http://localhost/SCCinema/api/exportAPIFood.php");

            if ($responseFood) {
                foreach ($responseFood as $row) {
                    echo '
                    <div class="text-white flex justify-between space-x-4">
                        <img src="'.$row->image_url.'" class="w-36 h-44 border rounded"/>
                        <div>
                            <h2 class="uppercase text-xl">' . $row->food_name . '</h3>
                            <p class="h-14">'.$row->description.'</p>
                            <p>'.number_format($row->price, 0, ",",".").' <sup>đ</sup></p>
                            <div class="mt-4 w-fit flex bg-white text-black px-3 py-1 rounded">
                                <button class=" w-fit font-bold flex justify-center items-center" type="button">-</button>
                                <input type="number" value="0" min="0" readonly class="w-12 mx-2 pl-2 pr-1 py-1 text-lg text-right outline-none">
                                <button class="w-fit font-bold flex justify-center items-center" type="button">+</button>
                            </div>
                        </div>
                    </div>';
                }
            } else
                echo "<p>Không có dữ liệu</p>";
            ?>
        </div>
    </div>
</div>