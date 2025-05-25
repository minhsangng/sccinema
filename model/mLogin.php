<?php
class mLogin
{
    public function mCheckinlogin($username, $password)
    {
        $p = new Database();
        $conn = $p->connect();

        $password = md5($password);
        $sql = "SELECT * FROM staffs WHERE email = '$username' AND password = '$password' LIMIT 1";

        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $_SESSION["user"][] = [
                $row["id"],
                $row["full_name"],
                $row["email"],
                $row["password"],
                $row["position"]
            ];
            return 1;
        } else return 0;
    }
    
    public function mConfirmlogin($username, $password)
    {
        $p = new Database();
        $conn = $p->connect();

        $sql = "SELECT * FROM staffs WHERE email = '$username' AND password = '$password' LIMIT 1";

        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            return 1;
        } else return 0;
    }
}
