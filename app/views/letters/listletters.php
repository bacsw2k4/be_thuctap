<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Letters</title>
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
                <div class="header-content-right">
                    <div class="search">
                        <form action="" method="get">
                            <label>Tên user/Loại đơn/Nội dung</label>
                            <input placeholder="Value" name="url" hidden value="letters/showLetters">
                            <input type="search" placeholder="Value" name="search"
                                value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>">
                            <button type="submit" class="btn-search" style="cursor: pointer;">Tìm Kiếm</button>
                        </form>
                    </div>
                    <div class="action2 ">
                        <a href="<?php echo BASE_URL; ?>/public/index.php?url=letters/addLetter"><button class="btn-add"
                                style="cursor: pointer;">Thêm mới
                                đơn</button></a>
                    </div>
                </div>
                <div class="body-content-right">
                    <table class="table-dashboard">
                        <thead>
                            <tr>
                                <th style="width: 60px;">STT</th>
                                <th>Người dùng</th>
                                <th>Loại đơn</th>
                                <th>Ngày lập</th>
                                <th>Trạng thái</th>
                                <th>Ngày duty</th>
                                <th class="mota" style="border-right: none; width: 248px;">Mô tả</th>
                                <th style="width: 160px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            foreach ($data['letters'] as $letter): ?>
                                <tr
                                    style="<?php echo $letter['status'] == 'Đã hủy' ? 'background-color: #FFB5B5' : ($letter['status'] == 'Chờ duyệt' ? 'background-color: #90FF98' : 'background-color: white'); ?>">
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $letter['fullName']; ?></td>
                                    <td><?php echo $letter['categoryLetter']; ?></td>
                                    <td><?php echo $letter['createdAt']; ?></td>
                                    <td class="bold"><?php echo $letter['status']; ?></td>
                                    <td><?php echo $letter['approvalDate']; ?></td>
                                    <td class="bold" style="border-right: none;"><?php echo $letter['content']; ?></td>
                                    <td style="padding: 5px;">
                                        <?php if (($_SESSION['user_category'] == "Quản lý" && $letter['status'] == 'Chờ duyệt') || ($_SESSION['user_category'] == "admin" && $letter['status'] == 'Chờ duyệt')): ?>
                                            <a
                                                href="<?php echo BASE_URL; ?>/public/index.php?url=letters/acceptLetter/<?php echo $letter['letterId'] ?>"><button
                                                    class="btn-approval">Duyệt</button></a>
                                            <button class="btn-cancel">Hủy</button>
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
                                href="?url=letters/showLetters&page=<?php echo $data['currentPage'] - 1; ?><?php echo !empty($data['search']) ? '&search=' . urlencode($data['search']) : ''; ?>">Previous</a>
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
                        echo '<div class="page"><a href="?url=letters/showLetters&page=1' . ($search ? '&search=' . urlencode($search) : '') . '">1</a></div>';
                        if ($start > 2) {
                            echo '<div class="dot"><span>...</span></div>';
                        }
                    }

                    for ($i = $start; $i <= $end; $i++) {
                        $active = $i == $currentPage ? 'active' : '';
                        echo '<div class="page ' . $active . '"><a href="?url=letters/showLetters&page=' . $i . ($search ? '&search=' . urlencode($search) : '') . '">' . $i . '</a></div>';
                    }

                    if ($end < $totalPages) {
                        if ($end < $totalPages - 1) {
                            echo '<div class="dot"><span>...</span></div>';
                        }
                        echo '<div class="page"><a href="?url=letters/showLetters&page=' . $totalPages . ($search ? '&search=' . urlencode($search) : '') . '">' . $totalPages . '</a></div>';
                    }
                    ?>
                    <div class="next">
                        <?php if ($currentPage < $totalPages): ?>
                            <a
                                href="?url=letters/showLetters&page=<?php echo $currentPage + 1; ?><?php echo $search ? '&search=' . urlencode($search) : ''; ?>">Next</a>
                            <img src="<?php echo BASE_URL; ?>/public/img/arrowright.svg">
                        <?php else: ?>
                            <a>Next</a>
                            <img src="<?php echo BASE_URL; ?>/public/img/arrowright.svg">
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>

    </div>

</body>
<script>
    function closePopup() {
        const exitBtn = document.getElementById('exit-btn');
        const popup = document.getElementById('popup-confirm-cancel');
        if (exitBtn && popup) {
            exitBtn.addEventListener('click', function() {
                popup.style.display = 'none';
            });
        }
    }
    closePopup();
</script>

</html>