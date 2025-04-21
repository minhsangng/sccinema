<?php
class cAPI extends mAPI
{
    public function cExportAPI()
    {
        $result = $this->mExportAPI();

        if (!$result)
            return false;
        else {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = [
                    "id" => $row["id"],
                    "title" => $row["title"],
                    "release_date" => $row["release_date"],
                    "genres" => $row["genres"],
                    "country" => $row["country"],
                    "director" => $row["director"],
                    "actors" => $row["actors"],
                    "duration" => $row["duration"],
                    "summary" => $row["summary"],
                    "poster_url" => $row["poster_url"],
                    "thumbnail_url" => $row["thumbnail_url"],
                    "trailer_url" => $row["trailer_url"],
                    "vote_average" => $row["vote_average"],
                    "status" => $row["status"]
                ];
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
}
?>