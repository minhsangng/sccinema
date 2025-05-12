<title>SC Cinema - Đặt Bắp Nước</title>

<div class="ml-[200px] mr-[110px] mt-8">
    <div class="grid grid-cols-1">
        <h2 class="uppercase">Chọn rạp gần bạn</h2>
        <select name="" id="">
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
    </div>
    <div class="grid grid-cols-4 gap-8">

    </div>
</div>