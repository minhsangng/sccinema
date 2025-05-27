<?php
header("Content-type: Application\json");

// Lấy thông tin thanh toán từ SEPAY gửi về (POST hoặc GET)
$status = $_REQUEST['status'] ?? '';
$order_id = $_REQUEST['order_id'] ?? '';

if ($status === 'success') {
    // Thực hiện các bước xử lý khi thanh toán thành công, ví dụ:
    echo json_encode(['status' => 'success', 'order_id' => $order_id]);
} else {
    echo json_encode(['status' => 'failure', 'message' => 'Thanh toán thất bại']);
}
?>