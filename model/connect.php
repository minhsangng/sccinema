<?php
    class Database {
        public function connect() {
            $conn = new mysqli("localhost", "root", "", "domdom");
            
            if (!$conn) {
                echo "Kết nối lỗi".mysqli_connect_error();
                return false;
            }
            else {
                $conn->set_charset("utf8");
                return $conn;
            }
        }
        
        public function close($conn) {
            return mysqli_close($conn);
        }
    }
?>