<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="style.css">
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
            <div class=" content-right">
                <p>Thêm mới người dùng</p>
                <form method="post" action="checkadduser.html" id="form-adduser">
                    <div class="form-adduser-group">
                        <div>
                            <label>Tên đăng nhập<span>*</span></label>
                            <input type="text" name="loginname" id="username">
                        </div>
                        <div class="check-empty check-username"></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Tên người dùng<span>*</span></label>
                            <input type="text" name="username" id="fullname">
                        </div>
                        <div class="check-empty check-fullname"></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Mật khẩu <span>*</span></label>
                            <input type="password" name="password" id="password">
                        </div>
                        <div class="check-empty check-password"></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Email</label>
                            <input type="email" name="email" id="email">
                        </div>
                        <div class="check-empty check-email"></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Ngày sinh</label>
                            <div class="date-container">
                                <input id="birthDate" type="date" name="birthDate"
                                    style="width: 189px; height: 40px;  padding: 5px; color: transparent;"
                                    onchange="checkDate()">
                            </div>
                        </div>
                        <div class="check-empty check-birthdate"></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Loại người dùng<span>*</span></label>
                            <select name="categoryuser" class="option">
                                <option>Value</option>
                                <option>Quản lý</option>
                                <option>Nhân viên</option>
                            </select>
                        </div>
                        <div class="check-empty check-select"></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Phòng ban<span>*</span></label>
                            <select name="department" class="option">
                                <option>Value</option>
                                <option>Phòng nhân sự</option>
                                <option>Phòng IT</option>
                                <option>Phòng kinh doanh</option>
                                <option>Phòng san xuat</option>
                            </select>
                        </div>
                        <div class="check-empty check-select"></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Trạng thái<span>*</span></label>
                            <select name="status" class="option">
                                <option>Value</option>
                                <option>Đang hoạt động</option>
                                <option>Đã khóa</option>
                            </select>

                        </div>
                        <div class="check-empty check-select"></div>
                    </div>
                    <div class="btn-adduser-group">
                        <button class="continue" style="cursor: pointer;">Tiếp theo</button>
                        <button class="clear" style="cursor: pointer;">Xóa trống</button>
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
        if (input) {
            input.value = '';
            input.classList.remove('input-error');
        }
    });
    document.querySelectorAll('.check-empty').forEach(el => el.innerHTML = '');
    document.querySelectorAll('select').forEach(select => select.classList.remove('input-error'));
});

// Xử lý validate khi submit form
document.getElementById('form-adduser').addEventListener('submit', function(e) {
    const username = document.getElementById('username');
    const fullname = document.getElementById('fullname');
    const password = document.getElementById('password');
    const email = document.getElementById('email');
    const birthDate = document.getElementById('birthDate');
    const selects = document.querySelectorAll('select');

    const check_username = document.querySelector('.check-username');
    const check_fullname = document.querySelector('.check-fullname');
    const check_password = document.querySelector('.check-password');
    const check_email = document.querySelector('.check-email');
    const check_birthDate = document.querySelector('.check-birthdate');

    let hasError = false;
    let firstInvalid = null;

    // Reset lỗi cũ
    [username, fullname, password, email, birthDate].forEach(input => input.classList.remove('input-error'));
    [check_username, check_fullname, check_password, check_email, check_birthDate].forEach(el => el.innerHTML =
        '');

    // Kiểm tra các trường input
    if (!username.value.trim()) {
        e.preventDefault();
        check_username.innerHTML = '<div>※Tên đăng nhập không được để trống</div>';
        username.classList.add('input-error');
        firstInvalid = firstInvalid || username;
        hasError = true;
    }

    if (!fullname.value.trim()) {
        e.preventDefault();
        check_fullname.innerHTML = '<div>※Tên người dùng không được để trống</div>';
        fullname.classList.add('input-error');
        firstInvalid = firstInvalid || fullname;
        hasError = true;
    }

    if (!password.value.trim()) {
        e.preventDefault();
        check_password.innerHTML = '<div>※Mật khẩu không được để trống</div>';
        password.classList.add('input-error');
        firstInvalid = firstInvalid || password;
        hasError = true;
    }

    if (!email.value.trim()) {
        e.preventDefault();
        check_email.innerHTML = '<div>※Email không được để trống</div>';
        email.classList.add('input-error');
        firstInvalid = firstInvalid || email;
        hasError = true;
    }

    if (!birthDate.value.trim()) {
        e.preventDefault();
        check_birthDate.innerHTML = '<div>※Không được để trống</div>';
        birthDate.classList.add('input-error');
        firstInvalid = firstInvalid || birthDate;
        hasError = true;
    } else {
        birthDate.classList.remove('input-error');
    }

    // Kiểm tra các thẻ select
    selects.forEach(select => {
        const errorDiv = select.closest('.form-adduser-group').querySelector('.check-select');
        if (errorDiv) {
            errorDiv.innerHTML = '';
            if (select.value === 'Value') {
                e.preventDefault();
                errorDiv.innerHTML = '<div>※Không được để trống</div>';
                select.classList.add('input-error');
                firstInvalid = firstInvalid || select;
                hasError = true;
            } else {
                select.classList.remove('input-error');
            }
        }
    });


    if (hasError && firstInvalid) {
        firstInvalid.focus();
    }
});
</script>



</html>