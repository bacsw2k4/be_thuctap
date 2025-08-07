<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Letters</title>
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
                <form method="post" action="" id="form-adduser" enctype="multipart/form-data">
                    <div class="form-adduser-group">
                        <div>
                            <label>Tiêu đề<span>*</span></label>
                            <input type="text" name="title" id="title">
                        </div>
                        <div class="check-empty check-title"></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Nội dung</label>
                            <textarea name="content" style="width: 480px; height: 94px;" id="content"></textarea>
                        </div>
                        <div class="check-empty check-content" style="margin-top: 60px;"></div>
                    </div>
                    <div class="form-adduser-group" style="margin-top: 60px;">
                        <div>
                            <label>Người duyệt<span>*</span></label>
                            <select name="categoryuser" class="option" id="role">
                                <option>Value</option>
                                <option>A</option>
                                <option>B</option>
                            </select>
                        </div>
                        <div class="check-empty check-select"></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Loại đơn<span>*</span></label>
                            <select name="categoryletter" class="option" id="categoryletter">
                                <option>Value</option>
                                <option>A</option>
                                <option>B</option>
                            </select>
                        </div>
                        <div class="check-empty check-select"></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Ngày bắt đầu<span>*</span></label>
                            <div class="date-container" style="margin-left: -21px;">
                                <input id="datestart" type="date" name="datestart"
                                    style="width: 189px; height: 40px;  padding: 5px; color: transparent;"
                                    onchange="checkDateStart()">
                            </div>
                        </div>
                        <div class="check-empty check-birthdate"></div>
                    </div>
                    <div class="form-adduser-group">
                        <div>
                            <label>Ngày kết thúc<span>*</span></label>
                            <div class="date-container" style="margin-left: -23px;">
                                <input id="dateend" type="date" name="dateend"
                                    style="width: 189px; height: 40px;  padding: 5px; color: transparent;"
                                    onchange="checkDateEnd()">
                            </div>
                        </div>
                        <div class="check-empty check-birthdate"></div>
                    </div>

                    <div class="form-adduser-group">
                        <div>
                            <label style="position: absolute;">Đính kèm<span>*</span></label>
                            <label for="file" id="file-label"
                                style="border: 1px solid #cccccc; width: 189px; height: 40px; border-radius: 4px; display: inline-block; position: relative;margin-left: 61px; left: 65px;">
                                <input name="file" type="file" id="file" style="width: 189px;" hidden>
                                <img src="./img/upload.svg" alt="" srcset=""
                                    style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                            </label>
                        </div>
                        <div class="check-empty check-file"></div>
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
    document.querySelector('.clear').addEventListener('click', (e) => {
        e.preventDefault();
        ['title', 'content', 'datestart', 'dateend'].forEach(id => {
            const input = document.getElementById(id);
            if (input) {
                input.value = '';
                input.classList.remove('input-error');
            }
            const fileInput = document.getElementById('file');
            if (fileInput) {
                fileInput.value = '';
            }
            const fileLabel = document.getElementById('file-label');
            if (fileLabel) {
                fileLabel.classList.remove('input-error');
                fileLabel.style.border = '1px solid #cccccc';
            }
        });
        document.querySelectorAll('.check-empty').forEach(el => el.innerHTML = '');
        document.querySelectorAll('select').forEach(select => select.classList.remove('input-error'));
    });
    document.getElementById('form-adduser').addEventListener('submit', (e) => {
        const fileLabel = document.getElementById('file-label');
        const title = document.getElementById('title');
        const content = document.getElementById('content');
        const selects = document.querySelectorAll('select');
        const datestart = document.getElementById('datestart');
        const dateend = document.getElementById('dateend');
        const file = document.getElementById('file');

        const check_title = document.querySelector('.check-title');
        const check_content = document.querySelector('.check-content');
        const check_birthdates = document.querySelectorAll('.check-birthdate');
        const check_file = document.querySelector('.check-file');

        let hasError = false;
        let firstInvalid = null;


        [title, content, datestart, dateend, file].forEach(i => i.classList.remove('input-error'));
        [check_title, check_content, check_birthdates, check_file].forEach(e => e.innerHTML = '');


        if (!title.value.trim()) {
            e.preventDefault();
            check_title.innerHTML = '<div>※Không được để trống</div>';
            title.classList.add('input-error');
            firstInvalid = firstInvalid || title;
            hasError = true;
        }

        if (!content.value.trim()) {
            e.preventDefault();
            check_content.innerHTML = '<div>※Không được để trống</div>';
            content.classList.add('input-error');
            firstInvalid = firstInvalid || content;
            hasError = true;
        }

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

        if (!datestart.value) {
            e.preventDefault();
            check_birthdates[0].innerHTML = '<div>※Vui lòng chọn ngày bắt đầu</div>';
            datestart.classList.add('input-error');
            firstInvalid = firstInvalid || datestart;
            hasError = true;
        }

        if (!dateend.value) {
            e.preventDefault();
            check_birthdates[1].innerHTML = '<div>※Vui lòng chọn ngày kết thúc</div>';
            dateend.classList.add('input-error');
            firstInvalid = firstInvalid || dateend;
            hasError = true;
        }

        if (!file.files.length) {
            e.preventDefault();
            check_file.innerHTML = '<div>※Vui lòng chọn tệp đính kèm</div>';
            fileLabel.style.border = '1px solid #FF0000';
            firstInvalid = firstInvalid || file;
            hasError = true;
        } else {
            fileLabel.style.border = '1px solid #cccccc';
        }

        if (hasError && firstInvalid) {
            firstInvalid.focus();
        }
    });
</script>

</html>