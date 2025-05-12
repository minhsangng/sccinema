<?php
class mAPI
{
    /* Danh sách phim */
    public function mExportAPIMovie($sql)
    {
        $p = new Database;
        $conn = $p->connect();

        if (!$conn)
            return false;
        return $conn->query($sql);
    }
    
    /* Lịch chiếu */
    public function mExportAPIShowtime($sql)
    {
        $p = new Database;
        $conn = $p->connect();
        
        if (!$conn)
            return false;
        return $conn->query($sql);
    }
    
    /* Thông tin các rạp */
    public function mExportAPICinema($sql)
    {
        $p = new Database;
        $conn = $p->connect();
        
        if (!$conn)
            return false;
        return $conn->query($sql);
    }
    
    /* Thông tin bắp nước */
    public function mExportAPIFood($sql)
    {
        $p = new Database;
        $conn = $p->connect();
        
        if (!$conn)
            return false;
        return $conn->query($sql);
    }
    
    /* Gọi API */
    public function mCallAPI($url)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);

        if (!$result)
            return false;
        else
            return json_decode($result);
    }
}
?>