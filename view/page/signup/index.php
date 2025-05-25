        <title>Đăng ký</title>

        <div class="ml-[200px] mr-[110px] pb-10 mb-4" style="background-image: linear-gradient(to top, rgba(0, 0, 0, 0.7) 0%, rgba(0,0,0,0.7) 100%), url('assets/img/others/threater.png');"    >
            <div class="w-1/2 text-black">
                <div class="w-full grid grid-cols-2">
                    <a href="?p=login" class="text-white uppercase text-center py-3">Đăng nhập</a>
                    <a href="?p=signup" class="bg-white uppercase text-center py-3 font-bold rounded-tr-md">Đăng ký</a>
                </div>
                <div class="bg-white px-4 py-6">
                    <form action="" method="POST" class="w-full">
                        <table width="100%">
                            <tr>
                                <td>
                                    <label for="username">Họ và tên <span class="text-red-500"> *</span></label> <br>
                                    <input type="text" name="username" id="username" class="border outline-none w-full px-3 py-2 my-2">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="dob">Ngày sinh <span class="text-red-500"> *</span></label> <br>
                                    <input type="date" name="dob" id="dob" class="border outline-none w-full px-3 py-2 my-2">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="phone">Số điện thoại <span class="text-red-500"> *</span></label> <br>
                                    <input type="text" name="phone" id="phone" class="border outline-none w-full px-3 py-2 my-2">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="email">Email <span class="text-red-500"> *</span></label> <br>
                                    <input type="email" name="email" id="email" class="border outline-none w-full px-3 py-2 my-2">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="password">Mật khẩu <span class="text-red-500"> *</span></label> <br>
                                    <input type="password" name="password" id="password" class="border outline-none w-full px-3 py-2 my-2">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="repassword">Xác thực mật khẩu <span class="text-red-500"> *</span></label> <br>
                                    <input type="password" name="repassword" id="repassword" class="border outline-none w-full px-3 py-2 my-2">
                                </td>
                            </tr>
                            <tr>
                                <td><input type="checkbox" name="agree" id="agree" class="mr-2 mb-8"><label for="agree" class="text-sm">Khách hàng đồng ý với các điều khoản, điều kiện của thành viên SCCinema</label></td>
                            </tr>
                            <tr>
                                <td>
                                    <button type="submit" class="w-full py-2 uppercase bg-red-500 font-semibold mt-3" name="signup">Đăng ký</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        
        <?php
            if (isset($_POST["signup"])) {
                
            }
        ?>