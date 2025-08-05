<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List User</title>
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
                <div><a href="">Quản lý đơn</a></div>
                <div><a href="<?php echo BASE_URL; ?>/public/index.php?url=auth/logout">Đăng xuất</a></div>
            </div>
            <div class="content-right">
                <div class="header-content-right">
                    <div class="search">
                        <form method="GET" action="">
                            <label>Mã/Tên user</label>
                            <input placeholder="Value" name="url" hidden value="users/showListUser">
                            <input type="search" placeholder="Value" name="search"
                                value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>">
                            <button type="submit" class="btn-search" style="cursor: pointer;">Tìm Kiếm</button>
                        </form>
                    </div>
                    <div class="action">
                        <a href="<?php echo BASE_URL ?>/public/index.php?url=users/addUser"><button class="btn-add"
                                style="cursor: pointer;">Thêm mới</button></a>
                        <a><button class="btn-deletemore" style="cursor: pointer;" id="delete-selected">Xóa
                                nhiều</button></a>
                    </div>

                </div>
                <div class="body-content-right">
                    <table class="table-dashboard">
                        <thead>
                            <tr>
                                <th>
                                    <div style="display: flex; justify-content: center; align-items: center;">
                                        <input style="display: none" type="checkbox" name="" id="select-all">
                                        <label for="select-all"
                                            style="text-align: center; display: flex; justify-content: center; align-items: center;">
                                            <div
                                                style="background-color: #ffffff; width: 24px; height: 24px; border-radius: 4px; border: 1px solid #cccccc; display: flex; justify-content: center; align-items: center;">
                                                <img src="./img/checkbox.svg"
                                                    style="width: 12px; height: 9.4px; display: none" alt=""
                                                    id="select-all-icon">
                                            </div>
                                        </label>
                                    </div>
                                </th>
                                <th>Mã người dùng</th>
                                <th>Tên người dùng</th>
                                <th>Ngày lập</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody id="table-body">
                            <?php
                            foreach ($data['users'] as $user) : ?>
                            <tr>
                                <td>
                                    <div style="display: flex; justify-content: center; align-items: center;"
                                        class="checkbox-wrapper">
                                        <input style="display: none" type="checkbox" name="" class="row-checkbox"
                                            id="row-checkbox1">
                                        <label for="row-checkbox1"
                                            style="text-align: center; display: flex; justify-content: center; align-items: center;">
                                            <div
                                                style="background-color: #ffffff; width: 24px; height: 24px; border-radius: 4px; border: 1px solid #cccccc; display: flex; justify-content: center; align-items: center;">
                                                <img src="./img/checkbox.svg"
                                                    style="width: 12px; height: 9.4px; display: none" alt=""
                                                    class="check-icon">
                                            </div>
                                        </label>
                                    </div>
                                </td>
                                <td><?php echo $user['userId'] ?></td>
                                <td><?php echo $user['fullName'] ?></td>
                                <td><?php echo $user['createdAt'] ?></td>
                                <td><?php echo $user['status'] ?></td>
                                <td>
                                    <button class="btn-edit">Sửa</button>
                                    <button class="btn-delete">Xoá</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>

                </div>
                <div class="pagination">
                    <div class="back">
                        <img src="./img/arrowleft.svg">
                        <a href="#">Previous</a>
                    </div>
                    <div class="page active">
                        <a href="#">1</a>
                    </div>
                    <div class="page">
                        <a href="#">2</a>
                    </div>
                    <div class="page">
                        <a href="#">3</a>
                    </div>
                    <div class="dot" style="position: relative;">
                        <a href="#">...</a>
                    </div>
                    <div class="page">
                        <a href="#">67</a>
                    </div>
                    <div class="page">
                        <a href="#">68</a>
                    </div>
                    <div class="next">
                        <a href="#">Next</a>
                        <img src="./img/arrowright.svg">
                    </div>
                </div>
            </div>


</body>

</html>
<script>
const selectAll = document.getElementById('select-all');
const selectAllIcon = document.getElementById('select-all-icon');
const rowWrappers = document.querySelectorAll('.checkbox-wrapper');
const rowCheckboxes = document.querySelectorAll('.row-checkbox');
const rowIcons = document.querySelectorAll('.check-icon');
const deleteSelectedBtn = document.getElementById('delete-selected');
const tableBody = document.getElementById('table-body')

// Toggle tất cả
selectAll.addEventListener('change', function() {
    const isChecked = selectAll.checked;
    selectAllIcon.style.display = isChecked ? 'block' : 'none';

    rowCheckboxes.forEach((checkbox, index) => {
        checkbox.checked = isChecked;
        rowIcons[index].style.display = isChecked ? 'block' : 'none';
    });
});

// Bắt sự kiện click từng dòng (click lên .checkbox-wrapper)
rowWrappers.forEach((wrapper, index) => {
    wrapper.addEventListener('click', function() {
        const checkbox = rowCheckboxes[index];
        const icon = rowIcons[index];

        checkbox.checked = !checkbox.checked;
        icon.style.display = checkbox.checked ? 'block' : 'none';

        // Cập nhật trạng thái select-all
        const allChecked = [...rowCheckboxes].every(cb => cb.checked);
        selectAll.checked = allChecked;
        selectAllIcon.style.display = allChecked ? 'block' : 'none';
    });
});
selectAll.addEventListener('change', () => {
    const rowCheckboxes = document.querySelectorAll('.row-checkbox');
    rowCheckboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
});

// Xoá các dòng được chọn
deleteSelectedBtn.addEventListener('click', () => {
    const checkboxes = document.querySelectorAll('.row-checkbox');
    checkboxes.forEach(checkbox => {
        if (checkbox.checked) {
            const row = checkbox.closest('tr');
            row.remove();
        }
    });
    selectAll.checked = false; // Bỏ chọn ô tổng
});

// Xoá 1 dòng khi bấm nút xoá
tableBody.addEventListener('click', (e) => {
    if (e.target.classList.contains('delete-btn')) {
        const row = e.target.closest('tr');
        row.remove();
    }
});
</script>