<?php
include_once("connectdb.php");

if (isset($_POST['query'])) {
    $search = mysqli_real_escape_string($conn, $_POST['query']);
    $sql = "SELECT * FROM products WHERE p_name LIKE '%$search%' OR p_brand LIKE '%$search%' LIMIT 5";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<div class="list-group">';
        while ($row = mysqli_fetch_array($result)) {
            // ดึงข้อมูลรูปและชื่อมาแสดง
            echo '<a href="index.php?q='.$row['p_name'].'" class="list-group-item list-group-item-action d-flex align-items-center">';
            echo '<img src="'.$row['p_image'].'" class="product-img-search me-3" onerror="this.src=\'https://placehold.co/50/50?text=No+Img\'">';
            echo '<div>';
            echo '<div class="fw-bold">'.$row['p_name'].'</div>';
            echo '<small class="text-muted">'.$row['p_brand'].' - ฿'.number_format($row['p_price']).'</small>';
            echo '</div>';
            echo '</a>';
        }
        echo '</div>';
    } else {
        echo '<div class="list-group-item text-center py-3">ไม่พบสินค้าที่คุณต้องการ</div>';
    }
}
?>