<style>
    #seatMap {
        width: fit-content;
    }

    .seat {
        width: 36px;
        height: 36px;
        font-weight: bold;
        border-radius: 6px;
    }
</style>

<div class="container-fluid pt-4 px-4">
    <div class="bg-secondary rounded p-4">
        <div class="max-w-6xl mx-auto p-6 rounded-lg shadow-md">
            <h4 class="text-2xl font-bold mb-4">Quản lý ghế theo rạp & phòng</h4>

            <!-- Chọn Rạp -->
            <div class="mb-4">
                <label class="font-medium mb-1 w-40">Chọn rạp:</label>
                <?php
                $response = $ctrlAPI->cCallAPI("http://localhost/SCCinema/api/exportAPICinema.php");
                if ($response) {
                    foreach ($response as $row) {
                        echo '<input type="radio" name="cinemaSelect" value="' . $row->id . '" id="' . $row->id . '" class="mx-2"/><label for="' . $row->id . '">' . $row->name . '</label>';
                    }
                } else echo 'Không có dữ liệu';
                ?>
            </div>

            <!-- Chọn Phòng -->
            <div class="mb-4 flex">
                <label class="font-medium mb-1 w-40">Chọn phòng chiếu:</label>
                <div id="rooms">

                </div>
            </div>

            <!-- Sơ đồ ghế -->
            <div id="seatMap" class="grid grid-cols-10 gap-2 mt-6">

            </div>
            
            <div>
                <button type="button" class="bg-[#bc1212] px-3 py-2 rounded text-white mt-4">Xác nhận</button>
            </div>
        </div>
    </div>
</div>

<script>
    const cinemaSelects = document.querySelectorAll('input[name="cinemaSelect"]');
    const roomDiv = document.getElementById('rooms');
    const seatMap = document.getElementById('seatMap');

    cinemaSelects.forEach((radio) => {
        radio.addEventListener('change', async () => {
            if (radio.checked) {
                let cid = radio.value;

                let html = ``;
                const res = await fetch(`http://localhost/SCCinema/api/exportAPICinema.php?cinema_id=${cid}`);
                const rooms = await res.json();

                rooms.forEach((room) => {
                    html += `<input type="radio" name="roomSelect" value="${room.id}" data-cols="${room.seat_columns}" data-rows="${room.seat_rows}" id="room_${room.id}" class="mx-2"/>
                        <label for="room_${room.id}">${room.name}</label>`;
                });

                roomDiv.innerHTML = html;

                const roomSelects = document.querySelectorAll('input[name="roomSelect"]');
                roomSelects.forEach((room) => {
                    room.addEventListener('change', () => {
                        if (room.checked) {
                            const cols = parseInt(room.getAttribute("data-cols"));
                            const rows = parseInt(room.getAttribute("data-rows"));
                            renderSeatMap(rows, cols);
                        }
                    });
                });
            }
        });
    });

    function rowToLetter(index) {
        return String.fromCharCode(65 + index); // A = 65
    }

    function renderSeatMap(rows, cols) {
        seatMap.innerHTML = '';
        seatMap.style.display = 'grid';
        seatMap.style.gridTemplateColumns = `repeat(${cols}, 1fr)`;
        seatMap.style.gap = '0.4rem';

        for (let r = 0; r < rows; r++) {
            for (let c = 0; c < cols; c++) {
                const rowLetter = String.fromCharCode(65 + r); // A, B, C, ...
                const seatCode = `${rowLetter}${String(c + 1).padStart(2, '0')}`;

                const div = document.createElement('div');
                div.textContent = seatCode;
                div.className = `
                seat cursor-pointer rounded bg-green-500 text-white text-sm 
                flex items-center justify-center hover:bg-yellow-400 transition`;
                div.dataset.code = seatCode;

                // Click chọn ghế
                div.addEventListener('click', () => {
                    div.classList.toggle('bg-yellow-400');
                    div.classList.toggle('bg-green-500');
                });

                seatMap.appendChild(div);
            }
        }
    }
</script>