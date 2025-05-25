            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h4 class="mb-0">Danh sách phim</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col">ID</th>
                                    <th scope="col">Tên phim</th>
                                    <th scope="col">Ngày phát hành</th>
                                    <th scope="col">Thời lượng</th>
                                    <th scope="col">Thể loại</th>
                                    <th scope="col">Quốc gia</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $response = $ctrlAPI->cCallAPI("http://localhost/SCCinema/api/exportAPIMovie.php?sort=desc");
                                    
                                    if ($response) {
                                        foreach ($response as $row) {
                                            echo '<tr>
                                                    <td>'.$row->id.'</td>
                                                    <td>'.$row->title.' ('.$row->age_rating.')</td>
                                                    <td>'.$row->release_date.'</td>
                                                    <td>'.$row->duration.'</td>
                                                    <td width="10%">'.$row->genres.'</td>
                                                    <td>'.$row->country.'</td>
                                                    <td>'.($row->status == 1 ? "Đang chiếu" : "Sắp chiếu").'</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-light" value="'.$row->id.'">Sửa</button>
                                                        <button class="btn btn-sm btn-primary" value="'.$row->id.'">Khóa</button>
                                                    </td>
                                                </tr>';
                                        }
                                    } else echo '<tr>
                                            <td colspan="9">Không có dữ liệu</td>
                                        </tr>';
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>