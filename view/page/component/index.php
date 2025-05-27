<?php
error_reporting(1);

include_once("../../layout/header.php");

include_once("../../../model/connect.php");
include_once("../../../model/mAPI.php");
include_once("../../../controller/cAPI.php");

$ctrlAPI = new cAPI();

if (isset($_GET["id"]))
     $id = $_GET["id"];

$response = $ctrlAPI->cCallAPI("http://localhost/SCCinema/api/exportAPIMovie.php?id=" . $id . (isset($_GET["showtime_id"]) ? "&showtime_id=" . $_GET["showtime_id"] : ""));

echo "<title>" . (!empty($response[0]) ? $response[0]->title : "") . "</title>";
?>

<style>
     .boxoffice {
          width: auto;
     }

     .movie-card-content h2 {
          line-height: 60px;
          margin-bottom: 20px;
     }

     .calendar {
          min-height: 100%;
     }

     footer {
          margin-top: 12rem;
     }

     footer .section-wrapper {
          width: 80%;
          margin: 0 auto;
          position: inherit;
     }

     #paymentModal {
          display: none;
          position: fixed;
          inset: 0;
          background-color: rgba(0, 0, 0, 0.5);
          justify-content: center;
          align-items: center;
          z-index: 9999;
     }

     #paymentModal.flex {
          display: flex;
     }
</style>

<!-- SECTIONS -->
<section class="movie-banner">
     <div class="hero-wrapper">
          <div class="movie-banner-item">
               <img <?php echo "src='" . $response[0]->thumbnail_url . "' alt='" . $response[0]->title . "'"; ?> />
          </div>

          <div class="movie-card">
               <img <?php echo "src='" . $response[0]->poster_url . "' alt='" . $response[0]->title . "'"; ?> />

               <div class="movie-card-content">
                    <h2><?php echo $response[0]->title . " (" . $response[0]->age_rating . ")"; ?></h2>

                    <ul class="movie-card-btns">
                         <?php
                         foreach (explode(", ", $response[0]->genres) as $g) {
                              echo "<li class='movie-card-btn'>
                                             " . $g . "
                                        </li>";
                         }
                         ?>
                    </ul>

                    <p class="movie-card-description">
                         <?php echo $response[0]->summary; ?>
                    </p>

                    <h3 style="font-size: 1.5rem; margin-bottom: 2px; margin-top: 8px;">Diễn viên</h3>
                    <div class="movie-casts">
                         <?php
                         echo $response[0]->actors;
                         ?>
                    </div>

                    <h3 style="font-size: 1.5rem; margin-bottom: 2px; margin-top: 8px;">Đạo diễn</h3>
                    <div class="movie-casts">
                         <?php
                         echo $response[0]->director;
                         ?>
                    </div>
               </div>
          </div>

     </div>
</section>

<section class="calendar max-w-[1200px] mx-auto" style="margin-top: 18rem;">
     <div class="trailer-title">
          <h3>Lịch chiếu phim</h3>
     </div>
     <div class="movie-casts" style="display: grid; grid-template-columns: repeat(7, 1fr); column-gap: 16px;">
          <?php
          if ($response != null) {
               $showtime_id = $response[0]->showtime_id;

               $responseShowtime = $ctrlAPI->cCallAPI("http://localhost/SCCinema/api/exportAPIShowtime.php?showtime_id=" . $showtime_id);

               $daysOfWeek = ["Chủ nhật", "Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy"];

               for ($i = 0; $i < 7; $i++) {
                    $currentDate = date("Y-m-d", strtotime("+$i days"));
                    $showDate = $responseShowtime[0]->show_date ?? '';

                    $labelDate = date("d/m", strtotime("+$i days"));
                    $dayName = $daysOfWeek[date("w", strtotime("+$i days"))];

                    // Kiểm tra ngày hiện tại có trùng ngày suất chiếu không
                    if ($currentDate == $showDate) {
                         echo '<div class="movie-cast-item"
                                   style="border: 2px dashed red; background: red; color: white; border-radius: 10px; display: flex; justify-content: center; align-items: center; text-align: center; padding: 10px;">
                                   <a href="#" style="color: white; text-decoration: none;">' . $labelDate . '<br><br>' . $dayName . '</a>
                              </div>';
                    } else {
                         echo '<div class="movie-cast-item"
                                   style="border: 2px dashed gray; border-radius: 10px; display: flex; justify-content: center; align-items: center; text-align: center; padding: 10px;">
                                   <a href="#" style="color: white; text-decoration: none;">' . $labelDate . '<br><br>' . $dayName . '</a>
                              </div>';
                    }
               }
          } else {
               echo 'Không có dữ liệu';
          }
          ?>
     </div>
</section>

<section class="max-w-[1200px] mx-auto" style="margin-top: 1rem;">
     <div class="trailer-title">
          <h3>DANH SÁCH RẠP</h3>
     </div>

     <div>
          <?php
          $cinemas = [];
          $response = $ctrlAPI->cCallAPI("http://localhost/SCCinema/api/exportAPIShowtime.php?movie_id=" . $id . (isset($_GET["showtime_id"]) ? "&showtime_id=" . $_GET["showtime_id"] : ""));

          foreach ($response as $row) {
               $cinemaId = $row->cinema_id;
               $roomId = $row->room_id;
               $groupKey = $cinemaId . '_' . $roomId;

               if (!isset($cinemas[$groupKey])) {
                    $cinemas[$groupKey] = [
                         "cinema_id" => $cinemaId,
                         "cinema_name" => $row->name,
                         "address" => $row->address,
                         "showtime_id" => $row->showtime_id,
                         "start_times" => [],
                         "seats" => [$row->seat_rows, $row->seat_columns]
                    ];
               }

               // Thêm start_time vào nhóm
               $cinemas[$groupKey]["start_times"][] = substr($row->start_time, 0, 5);
          }

          // Hiển thị
          foreach ($cinemas as $value) {
               echo '<div class="bg-white w-1/2 mx-auto px-8 py-4 rounded text-black mb-5">
                         <h4 class="font-bold text-2xl mb-3 text-red-600">' . $value["cinema_name"] . '</h4>
                         <p class="mb-2">' . $value["address"] . '</p>';

               foreach ($value["start_times"] as $start_time) {
                    echo '<button data-id="' . $value["showtime_id"] . '" data-rooms="' . $value["seats"][0] . ',' . $value["seats"][1] . '" class="rounded border border-red-500 text-red-500 hover:bg-red-500 hover:text-white w-fit px-2 py-1 mr-2 mb-2">' . $start_time . '</button>';
               }

               echo '</div>';
          }
          ?>
     </div>
</section>

<?php
function renderSeatMap($rows, $cols)
{
     $output = '<div class="grid" style="display: grid; grid-template-columns: repeat(' . $cols . ', 1fr); gap: 0.4rem;">';

     for ($r = 0; $r < $rows; $r++) {
          $rowLetter = chr(65 + $r); // A, B, C, ...
          for ($c = 1; $c <= $cols; $c++) {
               $seatCode = $rowLetter . str_pad($c, 2, "0", STR_PAD_LEFT);

               $output .= '
                         <div class="seat cursor-pointer rounded bg-green-500 text-white text-sm 
                                   flex items-center justify-center hover:bg-yellow-400 transition"
                              data-code="' . $seatCode . '">
                         ' . $seatCode . '
                         </div>';
          }
     }

     $output .= '</div>';
     return $output;
}

if (isset($_GET["showtime_id"])) {
     echo '<section class="max-w-[1200px] mx-auto" style="margin-top: 1rem;">
     <div class="trailer-title">
          <h3>CHỌN GHẾ</h3>
     </div>
     
     <div id="seats">';

     foreach ($cinemas as $value) {
          echo renderSeatMap($value["seats"][0], $value["seats"][1]);
     }
     echo '</div>
</section>';
} else echo '<section id="seat" class="max-w-[1200px] mx-auto" style="margin-top: 1rem;">
          </section>';
?>

<!-- Modal -->
<div id="paymentModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
     <div class="bg-white p-6 rounded-lg shadow-lg text-black max-w-md w-full relative">
          <h2 class="text-xl font-bold text-red-600 mb-4">Thanh Toán</h2>
          <p class="mb-2 text-center">Quét mã QR để thanh toán:</p>

          <!-- QR Code -->
          <div class="text-center mb-4">
               <img src="https://img.vietqr.io/image/MBBank-0941802624-compact.png?amount=1000&addInfo=Dat Ve Xem Phim SCCinema" alt="QR Code thanh toán" class="mx-auto w-60 h-60" />
               <p class="text-sm text-gray-500 mt-2">Ngân hàng: MBBank – STK: 0941802624</p>
          </div>

          <!-- Nút đóng -->
          <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-500 hover:text-red-500">
               ✕
          </button>
     </div>
</div>

<section class="international-trailer margin" style="margin-top: 4rem;" id="trailer">
     <div class="trailer-title">
          <h3>Official trailer</h3>
     </div>
     <iframe width="560" height="315"
          src="<?php echo str_replace("https://youtu.be/", "https://www.youtube.com/embed/", $response[0]->trailer_url); ?>"
          title="<?= $result[0]->title ?>" frameborder="0"
          allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
          allowfullscreen></iframe>
</section>

<?php
include_once("../../layout/footer.php");
?>

<script>
     document.addEventListener("DOMContentLoaded", function() {
          const seatContainer = document.getElementById("seat");
          const seats = document.createElement("div");
          let title = document.createElement("div");
          let h3 = document.createElement("h3");
          let btn = document.createElement("button");

          const timeButtons = document.querySelectorAll("button[data-rooms]");
          timeButtons.forEach(button => {
               button.addEventListener("click", function() {
                    h3.textContent = 'CHỌN GHẾ';
                    title.classList.add('trailer-title');
                    title.appendChild(h3);
                    seats.id = 'seats';
                    seats.classList.add('w-[80%]', 'mx-auto');
                    btn.textContent = 'ĐẶT VÉ';
                    btn.classList.add('checkout', 'mt-8', 'rounded', 'border', 'border-red-500', 'text-red-500', 'hover:bg-red-500', 'hover:text-white', 'w-fit', 'px-2', 'py-1', 'mr-2', 'mb-2');
                    btn.setAttribute("data-id", button.getAttribute("data-id"));

                    const [rows, cols] = this.dataset.rooms.split(',').map(Number);
                    const alphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
                    let seatHTML = '<div class="grid" style="display: grid; grid-template-columns: repeat(' + cols + ', 1fr); gap: 0.4rem;">';

                    for (let r = 0; r < rows; r++) {
                         for (let c = 1; c <= cols; c++) {
                              const seatCode = alphabet[r] + String(c).padStart(2, '0');
                              seatHTML += `
                              <div class="seat cursor-pointer rounded bg-green-500 text-white text-sm 
                                   flex items-center justify-center hover:bg-yellow-400 transition"
                                   data-code="${seatCode}">
                                   ${seatCode}
                              </div>`;
                         }
                    }

                    seatHTML += '</div>';
                    seats.innerHTML = seatHTML;
               });
          });
          seatContainer.appendChild(title);
          seatContainer.appendChild(seats);
          seatContainer.appendChild(btn);

          btn.addEventListener("click", function() {
               openModal();
          });
     });

     function openModal() {
          const modal = document.getElementById('paymentModal');
          modal.classList.remove('hidden');
          modal.classList.add('flex');
     }

     function closeModal() {
          const modal = document.getElementById('paymentModal');
          modal.classList.remove('flex');
          modal.classList.add('hidden');
     }
</script>