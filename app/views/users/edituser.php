<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/style.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Sanshin</h2>
            <p>Hệ thống quản lý đơn</p>
        </div>
        <div class="content">
            <div class="content-left">
                <div><a href="<?php echo BASE_URL; ?>/public/index.php?url=dashboard/showDashboard">Dashboard</a></div>
                <div><a href="<?php echo BASE_URL; ?>/public/index.php?url=users/showListUser" style=" background-color: #007EC6;
    color: white;">Quản lý người dùng</a></div>
                <div><a href="listletters.html">Quản lý đơn</a></div>
                <div><a href="<?php echo BASE_URL; ?>/public/index.php?url=auth/logout">Đăng xuất</a></div>
            </div>
            <div class="content-right">
                <p>Chỉnh sửa người dùng</p>
                <form method="post"
                    action="<?php echo BASE_URL; ?>/public/index.php?url=users/editUser/<?php echo $data['user']['userId'] ?>"
                    id="form-adduser">
                    <div class="form-adduser-group">
                        <div>
                            <label>Tên đăng nhập<span>*</span></label>
                            <input type="text" name="loginname" id="username" style="background-color: #DFDFDF80;"
                                readonly value="<?php echo $data['user']['username'] ?>">
                        </div>
                        <div class="check-empty check-username"></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Tên người dùng<span>*</span></label>
                            <input type="text" name="fullname" id="fullname"
                                value="<?php echo $data['user']['fullName'] ?>">
                        </div>
                        <div class="check-empty check-fullname"><?php echo $data['fullname_err'] ?></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Mật khẩu <span>*</span></label>
                            <input type="password" name="password" id="password">
                            <input type="password" name="password-old" id="password-old" hidden
                                value="<?php echo $data['user']['password'] ?>">
                        </div>
                        <div class="check-empty check-password"></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Email</label>
                            <input type="email" name="email" id="email" value="<?php echo $data['user']['email'] ?>">
                        </div>
                        <div class="check-empty check-email"><?php echo $data['email_err'] ?></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Ngày sinh</label>
                            <div class="date-container">
                                <input id="birthDate" type="date" name="birthDate"
                                    style="width: 189px; height: 40px;  padding: 5px;" onchange="checkDate()"
                                    value="<?php echo $data['user']['dob'] ?>">
                            </div>
                        </div>
                        <div class="check-empty check-birthdate"></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Loại người dùng<span>*</span></label>
                            <select name="categoryuser" class="option">
                                <option value="Quản lý"
                                    <?php echo ($data['user']['userType'] == 'Quản lý') ? 'selected' : ''; ?>>Quản lý
                                </option>
                                <option value="Nhân viên"
                                    <?php echo ($data['user']['userType'] == 'Nhân viên') ? 'selected' : '' ?>>Nhân viên
                                </option>
                            </select>
                        </div>
                        <div class="check-empty check-select"></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Phòng ban<span>*</span></label>
                            <select name="department" class="option">
                                <option value="Phòng Nhân sự"
                                    <?php echo ($data['user']['department'] == 'Phòng Nhân sự') ? 'selected' : ''; ?>>
                                    Phòng nhân
                                    sự</option>
                                <option value="Phòng IT"
                                    <?php echo ($data['user']['department'] == 'Phòng IT') ? 'selected' : ''; ?>>Phòng
                                    IT
                                </option>
                                <option value="Phòng Kinh doanh"
                                    <?php echo ($data['user']['department'] == 'Phòng Kinh doanh') ? 'selected' : ''; ?>>
                                    Phòng
                                    kinh doanh</option>
                                <option value="Phòng Sản xuất"
                                    <?php echo ($data['user']['department'] == 'Phòng Sản xuất') ? 'selected' : ''; ?>>
                                    Phòng
                                    sản xuất</option>
                            </select>
                        </div>
                        <div class="check-empty check-select"></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Trạng thái<span>*</span></label>
                            <select name="status" class="option">
                                <option value="Đang hoạt động"
                                    <?php echo ($data['user']['status'] == 'Đang hoạt động') ? 'selected' : ''; ?>>Đang
                                    hoạt
                                    động</option>
                                <option value="Đã khóa"
                                    <?php echo ($data['user']['status'] == 'Đã khóa') ? 'selected' : '' ?>>
                                    Đã khóa</option>
                            </select>

                        </div>
                        <div class="check-empty check-select"></div>

                    </div>
                    <div class="btn-adduser-group">
                        <button class="continue" type="submit" style="cursor: pointer;">Tiếp theo</button>
                        <button class="clear" type="button" style="cursor: pointer;">Xóa trống</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</body>
<script>
function checkDate() {
    const dateValue = document.getElementById("birthDate").value;
    const date = document.getElementById("birthDate");
    if (dateValue) {
        date.style.color = "black";
    } else {
        date.style.color = "white";
    }
}


document.querySelector('.clear').addEventListener('click', (e) => {
    e.preventDefault();
    ['username', 'fullname', 'password', 'email', 'birthDate'].forEach(id => {
        const input = document.getElementById(id);
        if (input && !input.disabled) {
            input.value = '';
            input.classList.remove('input-error');
        }
    });
    document.querySelectorAll('.check-empty').forEach(el => el.innerHTML = '');
    document.querySelectorAll('select').forEach(select => select.classList.remove('input-error'));
});
</script>

</html>