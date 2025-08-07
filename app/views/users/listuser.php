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
                        <?php if ($_SESSION['user_category'] == "Quản lý" || $_SESSION['user_category'] == "admin"): ?>
                            <a href="<?php echo BASE_URL ?>/public/index.php?url=users/addUser"><button class="btn-add"
                                    style="cursor: pointer;">Thêm mới</button></a>
                            <form style="float: right;" method="post"
                                action="<?php echo BASE_URL; ?>/public/index.php?url=users/deleteMultiple"
                                id="bulk-delete-form">
                                <a><button class="btn-deletemore" style="cursor: pointer;" id="delete-selected">Xóa
                                        nhiều</button></a>
                                <div class="popup-confirm" style="display: none;" id="popup-confirm">
                                    <div class="popup-container">
                                        <div class="popup-header">
                                            <p style="padding-top: 0px;">Thông báo</p>
                                            <img src="./img/Vector.png" alt="" class="exit-btn" id="btn-close" width="24px"
                                                height="24px">
                                        </div>
                                        <div class="popup-body2">
                                            <div style="position: relative;">
                                                <p>Bạn có chắc chắn lưu lại thay đổi ?<span
                                                        style="padding-top: 10px;">*</span></p>
                                            </div>
                                            <div class="button-group2">
                                                <div><button type="submit" class="btn-ok">Ok</button></div>
                                                <div><button type="button" class="btn-huy">Cancel</button></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php endif; ?>
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
                                            <input style="display: none" type="checkbox" name="userIds[]"
                                                value="<?php echo $user['userId']; ?>" class="row-checkbox"
                                                id="row-checkbox-<?php echo $user['userId']; ?>">
                                            <label for="row-checkbox-<?php echo $user['userId']; ?>"
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
                                        <?php if ($_SESSION['user_category'] == "Quản lý" || $_SESSION['user_category'] == "admin"): ?>
                                            <a
                                                href="<?php echo BASE_URL; ?>/public/index.php?url=users/getInforEdit/<?php echo $user['userId'] ?>"><button
                                                    class="btn-edit" style="cursor: pointer;" id="btn-edit">Sửa</button></a>
                                            <button class="btn-delete" style="cursor: pointer;"
                                                data-id="<?php echo $user['userId'] ?>" id="btn-delete">Xoá</button>
                                            <form
                                                action="<?php echo BASE_URL ?>/public/index.php?url=users/deleteById/<?php echo  $user['userId'] ?>"
                                                method="post" id="adduser-form-<?php echo $user['userId'] ?>">
                                                <div class="popup-confirm" data-id="<?php echo $user['userId'] ?>"
                                                    style="display: none;" id="popup-confirm">
                                                    <div class="popup-container">
                                                        <div class="popup-header">
                                                            <p style="padding-top: 0px;">Thông báo</p>
                                                            <img src="./img/Vector.png" alt="" class="btn-close" id="btn-close"
                                                                width="24px" height="24px">
                                                        </div>
                                                        <div class="popup-body2">
                                                            <div style="position: relative;">
                                                                <p>Bạn có chắc chắn lưu lại thay đổi ?<span
                                                                        style="padding-top: 10px;">*</span></p>
                                                            </div>
                                                            <div class="button-group2">
                                                                <div><button type="submit" class="btn-ok">Ok</button></div>
                                                                <div><button type="button" class="btn-huy">Cancel</button></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>

                    </table>

                </div>
                <div class="pagination">
                    <div class="back">
                        <?php if ($data['currentPage'] > 1): ?>
                            <img src="<?php echo BASE_URL; ?>/public/img/arrowleft.svg">
                            <a
                                href="?url=users/showListUser&page=<?php echo $data['currentPage'] - 1; ?><?php echo !empty($data['search']) ? '&search=' . urlencode($data['search']) : ''; ?>">Previous</a>
                        <?php else: ?>
                            <img src="<?php echo BASE_URL; ?>/public/img/arrowleft.svg">
                            <a>Previous</a>
                        <?php endif; ?>
                    </div>
                    <?php
                    $currentPage = $data['currentPage'];
                    $totalPages = $data['totalPages'];
                    $search = isset($data['search']) ? $data['search'] : '';

                    $range = 2;
                    $start = max(1, $currentPage - $range);
                    $end = min($totalPages, $currentPage + $range);

                    if ($start > 1) {
                        echo '<div class="page"><a href="?url=users/showListUser&page=1' . ($search ? '&search=' . urlencode($search) : '') . '">1</a></div>';
                        if ($start > 2) {
                            echo '<div class="dot"><span>...</span></div>';
                        }
                    }

                    for ($i = $start; $i <= $end; $i++) {
                        $active = $i == $currentPage ? 'active' : '';
                        echo '<div class="page ' . $active . '"><a href="?url=users/showListUser&page=' . $i . ($search ? '&search=' . urlencode($search) : '') . '">' . $i . '</a></div>';
                    }

                    if ($end < $totalPages) {
                        if ($end < $totalPages - 1) {
                            echo '<div class="dot"><span>...</span></div>';
                        }
                        echo '<div class="page"><a href="?url=users/showListUser&page=' . $totalPages . ($search ? '&search=' . urlencode($search) : '') . '">' . $totalPages . '</a></div>';
                    }
                    ?>
                    <div class="next">
                        <?php if ($currentPage < $totalPages): ?>
                            <a
                                href="?url=users/showListUser&page=<?php echo $currentPage + 1; ?><?php echo $search ? '&search=' . urlencode($search) : ''; ?>">Next</a>
                            <img src="<?php echo BASE_URL; ?>/public/img/arrowright.svg">
                        <?php else: ?>
                            <a>Next</a>
                            <img src="<?php echo BASE_URL; ?>/public/img/arrowright.svg">
                        <?php endif; ?>
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
    deleteSelectedBtn.addEventListener('click', (e) => {
        e.preventDefault(); // Chặn submit mặc định

        const form = document.querySelector('#bulk-delete-form');
        const selectedIds = [];

        document.querySelectorAll('.row-checkbox:checked').forEach(cb => {
            selectedIds.push(cb.value);
        });

        if (selectedIds.length === 0) {
            alert("Vui lòng chọn ít nhất một người dùng để xóa.");
            return;
        }

        const popup = document.getElementById('popup-confirm');
        popup.style.display = 'block';

        popup.querySelector('.btn-ok').onclick = function() {
            // Thêm input hidden nếu form không chứa checkbox
            selectedIds.forEach(id => {
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'userIds[]';
                input.value = id;
                form.appendChild(input);
            });

            form.submit(); // Gửi form sau khi xác nhận
        };

        popup.querySelector('.btn-huy').onclick = function() {
            popup.style.display = 'none';
        };

        popup.querySelector('#btn-close').onclick = function() {
            popup.style.display = 'none';
        };
    });


    // Xoá 1 dòng khi bấm nút xoá
    tableBody.addEventListener('click', (e) => {
        if (e.target.classList.contains('delete-btn')) {
            const row = e.target.closest('tr');
            row.remove();
        }
    });

    const deleteButtons = document.querySelectorAll('.btn-delete');

    deleteButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            const modalPopup = document.querySelector(`.popup-confirm[data-id="${userId}"]`);
            if (modalPopup) {
                modalPopup.style.display = 'block';

                // Gắn sự kiện cho nút OK riêng dòng
                const btnOk = modalPopup.querySelector('.btn-ok');
                const form = document.getElementById(`adduser-form-${userId}`);
                btnOk.onclick = function() {
                    form.submit();
                };

                // Nút Cancel
                const btnCancel = modalPopup.querySelector('.btn-huy');
                btnCancel.onclick = function() {
                    modalPopup.style.display = 'none';
                };

                // Nút Close (X)
                const btnClose = modalPopup.querySelector('.btn-close');
                btnClose.onclick = function() {
                    modalPopup.style.display = 'none';
                };
            } else {
                console.error(`Không tìm thấy popup với data-id="${userId}"`);
            }
        });
    });
</script>