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
    
    /* Lịch chiếu */
    public function cExportAPIShowtime($sql)
    {
        $result = $this->mExportAPIShowtime($sql);

        if (!$result)
            return false;
        else {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = [
                    "id" => $row["id"],
                    "movie_id" => $row["id"],
                    "title" => $row["title"],
                    "show_date" => $row["show_date"],
                    "start_time" => $row["start_time"],
                    "end_time" => $row["end_time"],
                    "price" => $row["price"],
                    "seat_rows" => $row["seat_rows"],
                    "seat_columns" => $row["seat_columns"],
                    "poster_url" => $row["poster_url"],
                    "thumbnail_url" => $row["thumbnail_url"],
                    "trailer_url" => $row["trailer_url"],
                    "status" => $row["status"]
                ];
            }

            echo json_encode($data);
        }
    }

}
?>