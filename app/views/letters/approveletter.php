<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appro Letters</title>
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
                <p>Duyệt đơn</p>
                <form method="post" action="<?php echo BASE_URL; ?>/public/index.php?url=letters/acceptLetter"
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
                            <textarea name="content" style="width: 480px; height: 94px; background-color: #CCCCCC80;"
                                disabled> <?php echo $data['content'] ?>"</textarea>
                        </div>
                        <div></div>
                    </div>
                    <div class="form-adduser-group" style="margin-top: 60px;">
                        <div>
                            <label>Loại đơn<span>*</span></label>
                            <input type="text" name="categoryletter"
                                style="width: 240px; margin-right: 240px; background-color: #CCCCCC80;" disabled
                                value="<?php echo $data['categoryletter'] ?>">
                        </div>
                        <div></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Ngày bắt đầu<span>*</span></label>
                            <input type="text" name="datestart"
                                style="width: 189px; margin-right: 291px; background-color: #CCCCCC80;" disabled
                                value="<?php echo $data['startdate'] ?>">

                        </div>
                        <div></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Ngày kết thúc<span>*</span></label>
                            <input type="text" name="dateend"
                                style="width: 189px; margin-right: 291px; background-color: #CCCCCC80;" disabled
                                value="<?php echo $data['enddate'] ?>">

                        </div>
                        <div></div>
                    </div>

                    <div class="form-adduser-group">
                        <div>
                            <label>Đính kèm<span>*</span></label>
                            <a href="<?php echo BASE_URL; ?>/public/uploads/<?php echo $data['file'] ?>"
                                style="text-decoration: none;margin-left: 61px;">
                                <?php echo $data['file'] ?></a>
                        </div>
                        <div></div>
                    </div>
                    <div class="btn-adduser-group">
                        <button class="continue" style="cursor: pointer;">Duyệt đơn</button>
                        <button class="clear" style="cursor: pointer;" id="btn-open">Hủy đơn</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <div class="popup-confirm-cancel" id="popup-confirm-cancel" style="display: none;">
        <div class="popup-container">
            <div class="popup-header">
                <p>Thông báo</p>
                <img src="./img/Vector.png" alt="" id="btn-close" class="exit-btn" width="24px" height="24px">
            </div>
            <div class="popup-body">
                <div style="position: relative;">
                    <p>Lý do hủy đơn <span style="padding-top: 10px;">*</span></p>
                </div>
                <div><input name="reason"></div>
                <div style="position: relative;"><button>Ok</button></div>
            </div>
        </div>
    </div>
</body>
<script>
    const btn_open = document.getElementById('btn-open');
    const btn_close = document.getElementById('btn-close');
    const popup_confirm_cancel = document.getElementById('popup-confirm-cancel');
    btn_open.addEventListener('click', (e) => {
        e.preventDefault();
        popup_confirm_cancel.style.display = 'block';

    });
    btn_close.addEventListener('click', () => {
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