        <title>Đăng nhập</title>
        
        <div class="ml-[200px] mr-[110px] pb-10 mb-4" style="background-image: linear-gradient(to top, rgba(0, 0, 0, 0.7) 0%, rgba(0,0,0,0.7) 100%), url('assets/img/others/threater.png');">
            <div class="w-1/2 text-black">
                <div class="w-full grid grid-cols-2">
                    <a href="?p=login" class="bg-white uppercase text-center py-3 font-bold rounded-tl-md">Đăng nhập</a>
                    <a href="?p=signup" class="text-white uppercase text-center py-3">Đăng ký</a>
                </div>
                <div class="bg-white px-4 py-6">
                    <form action="" method="POST" class="w-full">
                        <table width="100%">
                            <tr>
                                <td>
                                    <label for="username">Email, số điện thoại <span class="text-red-500"> *</span></label> <br>
                                    <input type="text" name="username" id="username" class="border outline-none w-full px-3 py-2 my-2">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="password">Mật khẩu <span class="text-red-500"> *</span></label> <br>
                                    <input type="password" name="password" id="password" class="border outline-none w-full px-3 py-2 my-2">
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="repass" id="repass" class="mr-2 mb-8"><label for="repass" class="text-sm">Lưu mật khẩu đăng nhập</label></td>
                            </tr>
                            <tr>
                                <td align="right">
                                    <a href="#" class="text-sm underline">Quên mật khẩu?</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="submit" class="w-full py-2 uppercase bg-red-500 font-semibold mt-3" name="login">Đăng nhập</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        
        <?php
            if (isset($_POST["login"])) {
                $username = $_POST["username"];
                $password = $_POST["password"];
                
                if (empty($username) || empty($password)) {
                    echo '<script>alert("Vui lòng nhập đầy đủ thông tin đăng nhập");</script>';
                } else {
                    if ($ctrlLogin->cCheckinlogin($username, $password) == 0) {
                        echo '<script>alert("Thông tin đăng nhập không chính xác");</script>';
                    } else {
                        echo '<script>window.location.href = "view/page/admin/";</script>';
                    }
                }
            }
        ?>