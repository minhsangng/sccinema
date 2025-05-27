<?php
class cAPI extends mAPI
{
    public function cExportAPIMovie($sql)
    {
        $result = $this->mExportAPIMovie($sql);

        if (!$result)
            return false;
        else {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            echo json_encode($data);
        }
    }

    public function cCallAPI($url)
    {
        $result = $this->mCallAPI($url);

        if (!$result)
            return false;
        else return $result;
    }

    /* Rạp */
    public function cExportAPICinema($sql)
    {
        $result = $this->mExportAPICinema($sql);

        if (!$result)
            return false;
        else {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            echo json_encode($data);
        }
    }

    /* Bắp nước */
    public function cExportAPIFood($sql)
    {
        $result = $this->mExportAPIFood($sql);

        if (!$result)
            return false;
        else {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            echo json_encode($data);
        }
    }

    /* Lịch chiếu */
    public function cExportAPIShowtime($sql)
    {
        $result = $this->mExportAPIShowtime($sql);

        if (!$result)
            return false;
        else {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            echo json_encode($data);
        }
    }
    
    /* Lịch làm */
    public function cExportAPIShift($sql)
    {
        $result = $this->mExportAPIShift($sql);

        if (!$result)
            return false;
        else {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            echo json_encode($data);
        }
    }
    
    /* Lịch làm */
    public function cExportAPIStaff($sql)
    {
        $result = $this->mExportAPIStaff($sql);

        if (!$result)
            return false;
        else {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            echo json_encode($data);
        }
    }
}
