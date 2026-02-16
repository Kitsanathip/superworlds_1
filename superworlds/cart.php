<?php
session_start();
include_once("connectdb.php");
?>
<!doctype html>
<html lang="th">
<head>
    <meta charset="utf-8">
    <title>ตะกร้าสินค้า - SUPERWORLDS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-light py-5">
    <div class="container">
        <h2 class="fw-bold mb-4">ตะกร้าสินค้าของคุณ</h2>
        <div class="card border-0 shadow-sm p-4 rounded-4">
            <table class="table align-middle">
                <thead>
                    <tr>
                        <th>สินค้า</th>
                        <th class="text-center">ราคา</th>
                        <th class="text-center">จำนวน</th>
                        <th class="text-center">รวม</th>
                        <th class="text-center">จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total_price = 0;
                    // ตรวจสอบว่าใน Session มีข้อมูลสินค้าหรือไม่
                    if (!empty($_SESSION['cart'])) {
                        foreach ($_SESSION['cart'] as $id => $qty) {
                            $sql = "SELECT * FROM products WHERE p_id = '$id'";
                            $res = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_array($res);
                            
                            $sum = $row['p_price'] * $qty;
                            $total_price += $sum;
                    ?>
                    <tr>
                        <td><strong><?php echo $row['p_name']; ?></strong></td>
                        <td class="text-center">฿<?php echo number_format($row['p_price']); ?></td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm">
                                <a href="cart_action.php?id=<?php echo $id; ?>&action=reduce" class="btn btn-outline-dark">-</a>
                                <span class="btn btn-light disabled" style="width: 40px;"><?php echo $qty; ?></span>
                                <a href="cart_action.php?id=<?php echo $id; ?>&action=add_more" class="btn btn-outline-dark">+</a>
                            </div>
                        </td>
                        <td class="text-center fw-bold">฿<?php echo number_format($sum); ?></td>
                        <td class="text-center">
                            <a href="cart_action.php?id=<?php echo $id; ?>&action=remove" class="btn btn-danger btn-sm rounded-pill">ลบ</a>
                        </td>
                    </tr>
                    <?php 
                        }
                    } else {
                        // ถ้าไม่มีข้อมูลใน Session ให้แสดงข้อความนี้ (ตามรูป image_a479ce.png)
                        echo "<tr><td colspan='5' class='text-center py-5 text-muted'>ไม่มีสินค้าในตะกร้า</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
            
            <?php if ($total_price > 0): ?>
            <hr>
            <div class="d-flex justify-content-between align-items-center">
                <h3 class="fw-bold">ราคารวมทั้งสิ้น: <span class="text-danger">฿<?php echo number_format($total_price); ?></span></h3>
                <a href="checkout.php" class="btn btn-danger btn-lg rounded-pill px-5">ไปหน้าชำระเงิน</a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>