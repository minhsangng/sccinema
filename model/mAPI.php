<?php
class mAPI
{
    public function mExportAPI()
    {
        $p = new Database;
        $conn = $p->connect();
        $sql = "SELECT * FROM movies";

        if (!$conn)
            return false;
        return $conn->query($sql);
    }

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