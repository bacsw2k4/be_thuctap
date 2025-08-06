<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Edit User</title>
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
                    action="<?php echo BASE_URL; ?>/public/index.php?url=users/checkEdit/<?php echo $data['userid'] ?>"
                    id="form-adduser">
                    <div class="form-adduser-group">
                        <div>
                            <label>Tên đăng nhập<span>*</span></label>
                            <input type="text" name="loginname" style="background-color: #DFDFDF80;" disabled
                                value="<?php echo $data['username'] ?>">
                        </div>
                        <div></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Tên người dùng<span>*</span></label>
                            <input type="text" name="username" style="background-color:#DFDFDF80;" disabled
                                value="<?php echo $data['fullname'] ?>">
                        </div>
                        <div></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Mật khẩu <span>*</span></label>
                            <input type="password" name="password" style="background-color: #DFDFDF80;" disabled
                                value="<?php echo $data['password'] ?>">
                        </div>
                        <div></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Email</label>
                            <input type="email" name="email" style="background-color:#DFDFDF80;" disabled
                                value="<?php echo $data['email'] ?>">
                        </div>
                        <div></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Ngày sinh</label>
                            <div class="date-container">
                                <input disabled id="datetime" type="date" name="birthDate"
                                    style="width: 189px; height: 40px;  padding: 5px; background-color: #DFDFDF80 ;"
                                    value="<?php echo $data['birthdate'] ?>">
                            </div>
                        </div>
                        <div></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Loại người dùng<span>*</span></label>
                            <select name="categoryuser" style="background-color: #DFDFDF80;" class="option" disabled>
                                <option value="Quản lý"
                                    <?php echo ($data['categoryuser'] == 'Quản lý') ? 'selected' : ''; ?>>Quản lý
                                </option>
                                <option value="Nhân viên"
                                    <?php echo ($data['categoryuser'] == 'Nhân viên') ? 'selected' : '' ?>>Nhân viên
                                </option>
                            </select>
                        </div>
                        <div></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Phòng ban<span>*</span></label>
                            <select name="department" style="background-color:#DFDFDF80;" class="option" disabled>
                                <option value="Phòng Nhân sự"
                                    <?php echo ($data['department'] == 'Phòng Nhân sự') ? 'selected' : ''; ?>>Phòng nhân
                                    sự</option>
                                <option value="Phòng IT"
                                    <?php echo ($data['department'] == 'Phòng IT') ? 'selected' : ''; ?>>Phòng IT
                                </option>
                                <option value="Phòng Kinh doanh"
                                    <?php echo ($data['department'] == 'Phòng Kinh doanh') ? 'selected' : ''; ?>>Phòng
                                    kinh doanh</option>
                                <option value="Phòng Sản xuất"
                                    <?php echo ($data['department'] == 'Phòng Sản xuất') ? 'selected' : ''; ?>>Phòng san
                                    xuat</option>
                            </select>
                        </div>
                        <div></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Trạng thái<span>*</span></label>
                            <select name="status" style="background-color:#DFDFDF80;" class="option" disabled>
                                <option value="Đang hoạt động"
                                    <?php echo ($data['status'] == 'Đang hoạt động') ? 'selected' : ''; ?>>Đang hoạt
                                    động</option>
                                <option value="Đã khóa" <?php echo ($data['status'] == 'Đã khóa') ? 'selected' : '' ?>>
                                    Đã khóa</option>
                            </select>
                        </div>
                        <div></div>
                    </div>
                    <div class="btn-adduser-group">
                        <button type="button" class="continue" style="cursor: pointer;" id="btn-open">Lưu lại</button>
                        <a href="<?php echo BASE_URL; ?>/public/index.php?url=users/editUser" type="button"><button
                                class="clear" style="cursor: pointer;" type="button">Quay lại</button></a>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="popup-confirm" style="display: none;" id="popup-confirm">
        <div class="popup-container">
            <div class="popup-header">
                <p>Thông báo</p>
                <img src="./img/Vector.png" alt="" class="exit-btn" id="btn-close" width="24px" height="24px">
            </div>
            <div class="popup-body2">
                <div style="position: relative;">
                    <p>Bạn có chắc chắn lưu lại thay đổi ?<span style="padding-top: 10px;">*</span></p>
                </div>
                <div class="button-group2">
                    <div><button type="submit" class="btn-ok">Ok</button></div>
                    <div><button type="button" class="btn-huy">Cancel</button></div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script>
const btnOpen = document.getElementById('btn-open');
const btnClose = document.getElementById('btn-close');
const btnCancel = document.querySelector('.btn-huy');
const btnOk = document.querySelector('.btn-ok');
const popupConfirm = document.getElementById('popup-confirm');
const form = document.getElementById('form-adduser');
btnOpen.addEventListener('click', (e) => {
    e.preventDefault();
    popupConfirm.style.display = 'block';
});


btnOk.addEventListener('click', () => {
    form.submit();
});


btnClose.addEventListener('click', () => {
    popupConfirm.style.display = 'none';
});

btnCancel.addEventListener('click', () => {
    popupConfirm.style.display = 'none';
});
</script>