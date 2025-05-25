            <div class="container-fluid pt-4 px-4">
                <div class="bg-secondary text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h4 class="mb-0">Quản lý nhân viên</h4>
                        <button class="btn btn-primary text-sm">Thêm</button>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col">ID</th>
                                    <th scope="col">Họ tên</th>
                                    <th scope="col">Giới tính</th>
                                    <th scope="col">Ngày sinh</th>
                                    <th scope="col">Điện thoại</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Chức vụ</th>
                                    <th scope="col">Lương</th>
                                    <th scope="col">Ngày bắt đầu</th>
                                    <th scope="col">Trạng thái</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $response = $ctrlAPI->cCallAPI("http://localhost/SCCinema/api/exportAPIStaff.php?");
                                    
                                    if ($response) {
                                        foreach ($response as $row) {
                                            echo '<tr>
                                                    <td>'.$row->id.'</td>
                                                    <td>'.$row->full_name.'</td>
                                                    <td>'.$row->gender.'</td>
                                                    <td>'.$row->birth_date.'</td>
                                                    <td>'.$row->phone.'</td>
                                                    <td>'.$row->email.'</td>
                                                    <td width="10%">'.$row->position.'</td>
                                                    <td>'.number_format($row->salary, 0, ",", ".").'</td>
                                                    <td>'.$row->hire_date.'</td>
                                                    <td>'.($row->status == 1 ? "<span class='text-success'>Đang làm</span>" : "<span class='text-warning'>Đã nghỉ</span>").'</td>
                                                    <td>
                                                        <button class="btn btn-sm btn-light" value="'.$row->id.'">Sửa</button>
                                                        <button class="btn btn-sm btn-primary" value="'.$row->id.'">Khóa</button>
                                                    </td>
                                                </tr>';
                                        }
                                    } else echo '<tr>
                                            <td colspan="11">Không có dữ liệu</td>
                                        </tr>';
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>