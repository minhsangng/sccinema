<?php
include_once("connect.php");

class mAPI
{
    public function mExportAPI()
    {
        $p = new Database;
        $conn = $p->connect();
        $sql = "";

        if (!$conn)
            return false;
        return $conn->query($sql);
    }

    public function mImportAPI($data)
    {
        $p = new Database;
        $conn = $p->connect();
        $sql = "";

        if (!$conn)
            return false;
        return $conn->query($sql);
    }
}
;
?>