<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/public/css/login.css">
</head>

<body>

    <div class="container">
        <div class="header">
            <h2>Sanshin</h2>
            <p>Hệ thống quản lý đơn</p>
        </div>
        <div class="content">
            <h1>Sanshin IT Solution</h1>
            <form method="post" action="" id="form">
                <div class="form-group">
                    <label>Tên đăng nhập<span style="color: #BD0101;">*</span></label>
                    <input id="login_identity" type="text" name="username" style="padding-left: 10px;"
                        placeholder="Tên đăng nhập">
                </div>
                <div class="form-group">
                    <label class="label-password">Mật khẩu<span style="color: #BD0101;">*</span></label>
                    <input id="password" type="password" name="password" style="padding-left: 10px;"
                        placeholder="Mật khẩu">
                </div>
                <div class="button">
                    <button class="login" name="login" type="submit">Login</button>
                    <button class="clear" type="reset">CLear</button>
                </div>
                <div class="alert-danger-empty">
                    <div><?php echo $data['username_err']; ?></div>
                    <div><?php echo $data['password_err']; ?></div>
                </div>
            </form>

        </div>

    </div>

</body>
<script>
document.getElementById('form').addEventListener('submit', (e) => {
    const alert_danger_empty = document.querySelector('.alert-danger-empty');
    const loginInput = document.getElementById('login_identity');
    const passwordInput = document.getElementById('password');
    const login_identity = loginInput.value.trim();
    const password = passwordInput.value.trim();
    let errorMessage = '';
    let firstInvalid = null;

    // Reset viền đỏ
    loginInput.classList.remove('input-error');
    passwordInput.classList.remove('input-error');

    if (!login_identity) {
        loginInput.classList.add('input-error');
        if (!firstInvalid) firstInvalid = loginInput;
        errorMessage = '※Tên đăng nhập không được để trống!';
    }

    if (!password) {
        passwordInput.classList.add('input-error');
        if (!firstInvalid) firstInvalid = passwordInput;
        errorMessage = '※Mật khẩu không được để trống!';
    }

    if (!login_identity && !password) {
        errorMessage = '※Tên đăng nhập và mật khẩu không được để trống!';
    }

    if (errorMessage) {
        e.preventDefault();
        alert_danger_empty.innerHTML = `<div>${errorMessage}</div>`;
        if (firstInvalid) firstInvalid.focus();
    }
});
</script>

</html>