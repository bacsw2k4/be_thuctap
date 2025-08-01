<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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
                <div><a href="<?php echo BASE_URL; ?>/public/index.php?url=dashboard/showDashboard" style=" background-color: #007EC6;
    color: white;">Dashboard</a></div>
                <div><a href="<?php echo BASE_URL; ?>/public/index.php?url=users/showListUser">Quản lý người dùng</a>
                </div>
                <div><a href="">Quản lý đơn</a></div>
                <div><a href="<?php echo BASE_URL; ?>/public/index.php?url=auth/logout">Đăng xuất</a></div>
            </div>
            <div class="content-right">
                <table class="table-dashboard">
                    <?php if (count($data['letters']) > 0): ?>
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Người dùng</th>
                            <th>Loại đơn</th>
                            <th>Ngày lập</th>
                            <th>Trạng thái</th>
                            <th>Ngày duty</th>
                            <th class="mota">Mô tả</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1;
                            foreach ($data['letters'] as $letter): ?>
                        <tr>
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $letter['fullName'] ?></td>
                            <td><?php echo $letter['categoryLetter'] ?></td>
                            <td><?php echo $letter['createdAt'] ?></td>
                            <td class="bold"><?php echo $letter['status'] ?></td>
                            <td><?php echo $letter['approvalDate'] ?></td>
                            <td class="bold"><?php echo $letter['content'] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <div>No letters found</div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</body>

</html>