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
                    "age_rating" => $row["age_rating"],
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
    
    /* Rạp */
    public function cExportAPICinema($sql)
    {
        $result = $this->mExportAPICinema($sql);

        if (!$result)
            return false;
        else {
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = [
                    "cinema_id" => $row["id"],
                    "cinema_name" => $row["name"],
                    "address" => $row["address"],
                    "status" => $row["status"]
                ];
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
                $data[] = [
                    "food_id" => $row["id"],
                    "food_name" => $row["name"],
                    "price" => $row["price"],
                    "type" => $row["type"],
                    "description" => $row["description"],
                    "image_url" => $row["image_url"],
                    "available" => $row["available"],
                    "status" => $row["status"]
                ];
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
                $data[] = [
                    "id" => $row["id"],
                    "movie_id" => $row["id"],
                    "title" => $row["title"],
                    "show_date" => $row["show_date"],
                    "start_time" => $row["start_time"],
                    "end_time" => $row["end_time"],
                    "showtimes" => $row["showtimes"],
                    "price" => $row["price"],
                    "seat_rows" => $row["seat_rows"],
                    "seat_columns" => $row["seat_columns"],
                    "cinema_id" => $row["cinema_id"],
                    "address" => $row["address"],
                    "genres" => $row["genres"],
                    "duration" => $row["duration"],
                    "country" => $row["country"],
                    "poster_url" => $row["poster_url"],
                    "thumbnail_url" => $row["thumbnail_url"],
                    "trailer_url" => $row["trailer_url"],
                    "age_rating" => $row["age_rating"],
                    "status" => $row["status"]
                ];
            }

            echo json_encode($data);
        }
    }

}
?>