<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Add Letters</title>
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
                <div><a href="<?php echo BASE_URL; ?>/public/index.php?url=users/showListUser">Quản lý người dùng</a>
                </div>
                <div><a href="<?php echo BASE_URL; ?>/public/index.php?url=letters/showLetters" style=" background-color: #007EC6;
    color: white;">Quản lý đơn</a></div>
                <div><a href="<?php echo BASE_URL; ?>/public/index.php?url=auth/logout">Đăng xuất</a></div>
            </div>
            <div class="content-right">
                <p>Thêm mới đơn</p>
                <form method="post" action="<?php echo BASE_URL; ?>/public/index.php?url=letters/checkAddLetter"
                    id="form-adduser" enctype="multipart/form-data">
                    <div class="form-adduser-group">
                        <div>
                            <label>Tiêu đề<span>*</span></label>
                            <input type="text" name="title" style="background-color: #CCCCCC80;" disabled
                                value="<?php echo $data['title'] ?>">
                        </div>
                        <div></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Nội dung</label>
                            <textarea name="content" style="width: 480px; height: 94px;background-color: #CCCCCC80; "
                                disabled><?php echo $data['content'] ?></textarea>
                        </div>
                        <div></div>
                    </div>
                    <div class="form-adduser-group" style="margin-top: 60px;">
                        <div>
                            <label>Người duyệt<span>*</span></label>
                            <select name="roleuser" class="option" style="background-color: #CCCCCC80;" disabled>
                                <?php foreach ($data['userdepartment'] as $userDepartment): ?>
                                    <option value="<?php echo $userDepartment['userId'] ?>"
                                        <?php echo ($userDepartment['userId'] == $data['roleuser']) ? 'selected' : ''; ?>>
                                        <?php echo $userDepartment['fullName'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Loại đơn<span>*</span></label>
                            <select name="categoryuser" class="option" style="background-color: #CCCCCC80;" disabled>
                                <option value="Đơn nghỉ phép"
                                    <?php echo ($data['categoryletter'] == 'Đơn nghỉ phép') ? 'selected' : ''; ?>>Đơn
                                    nghỉ phép</option>
                                <option value="Đơn thay đổi giờ làm"
                                    <?php echo ($data['categoryletter'] == 'Đơn thay đổi giờ làm') ? 'selected' : ''; ?>>
                                    Đơn thay đổi giờ làm</option>
                                <option value="Đơn xin thanh toán công tác phí"
                                    <?php echo ($data['categoryletter'] == 'Đơn xin thanh toán công tác phí') ? 'selected' : ''; ?>>
                                    Đơn xin thanh toán công tác phí</option>
                            </select>
                        </div>
                        <div></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Ngày bắt đầu<span>*</span></label>
                            <div class="date-container" style="margin-left: -21px;">
                                <input disabled id="datestart" type="date" name="datestart"
                                    style="width: 189px; height: 40px;  padding: 5px;background-color: #CCCCCC80;"
                                    onchange="checkDateStart()" value="<?php echo $data['startdate'] ?>">
                            </div>
                        </div>
                        <div></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Ngày kết thúc<span>*</span></label>
                            <div class="date-container" style="margin-left: -23px;">
                                <input disabled id="dateend" type="date" name="dateend"
                                    style="width: 189px; height: 40px;  padding: 5px;background-color: #CCCCCC80;"
                                    onchange="checkDateEnd()" value="<?php echo $data['enddate'] ?>">
                            </div>
                        </div>
                        <div></div>
                    </div>

                    <div class="form-adduser-group">
                        <div>
                            <label>Đính kèm<span>*</span></label>
                            <a href="<?php echo BASE_URL; ?>/public/uploads/<?php echo $data['file'] ?>"
                                style="text-decoration: none;margin-left: 61px;color:#00AAFF">
                                <?php echo $data['file'] ?></a>
                        </div>
                    </div>
                    <div class="btn-adduser-group">
                        <button class="continue" type="button" style="cursor: pointer;" id="btn-open">Lưu lại</button>
                        <a href="<?php echo BASE_URL; ?>/public/index.php?url=letters/addLetter"><button class="clear"
                                type="button" style="cursor: pointer;">Quay lại</button></a>
                    </div>
                    <div class="popup-confirm" style="display: none;" id="popup-confirm">
                        <div class="popup-container">
                            <div class="popup-header">
                                <p style="padding-top: 0px;">Thông báo</p>
                                <img src="./img/Vector.png" alt="" class="exit-btn" id="btn-close" width="24px"
                                    height="24px">
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

                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    </div>


</body>
<script>
    const btn_open = document.getElementById('btn-open');
    const btn_close = document.getElementById('btn-close');
    const btn_cancel = document.querySelector('.btn-huy');
    const popup_confirm_cancel = document.getElementById('popup-confirm');
    btn_open.addEventListener('click', (e) => {
        e.preventDefault();
        popup_confirm_cancel.style.display = 'block';

    });
    btn_close.addEventListener('click', () => {
        popup_confirm_cancel.style.display = 'none';
    });
    btn_cancel.addEventListener('click', () => {
        popup_confirm_cancel.style.display = 'none';
    });

    function checkDateStart() {
        const dateValue = document.getElementById("datestart").value;
        const date = document.getElementById("datestart");
        if (dateValue) {
            date.style.color = "black";
        } else {
            date.style.color = "white";
        }
    }

    function checkDateEnd() {
        const dateValue = document.getElementById("dateend").value;
        const date = document.getElementById("dateend");
        if (dateValue) {
            date.style.color = "black";
        } else {
            date.style.color = "white";
        }
    }
</script>

</html>