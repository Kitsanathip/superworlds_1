<?php
include_once("connectdb.php");

if(isset($_POST['Submit'])){
    $p_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $o_size = mysqli_real_escape_string($conn, $_POST['order_size']); 
    $name = mysqli_real_escape_string($conn, $_POST['fullname']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);

    $sql = "INSERT INTO orders (o_product, o_size, o_name, o_phone) VALUES ('$p_name', '$o_size', '$name', '$phone')";

    echo "<html><head><script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script></head><body>";

    if(mysqli_query($conn, $sql)){
        echo "<script>
            Swal.fire({
                title: 'สั่งซื้อสำเร็จ!',
                text: 'ขอบคุณที่ใช้บริการ SUPERWORLDS',
                icon: 'success',
                confirmButtonColor: '#e12128'
            }).then(() => {
                window.location.href = 'index.php';
            });
        </script>";
    } else {
        echo "<script>
            Swal.fire({
                title: 'สั่งซื้อล้มเหลว',
                text: 'กรุณาลองใหม่อีกครั้ง',
                icon: 'error'
            }).then(() => {
                window.history.back();
            });
        </script>";
    }
    echo "</body></html>";
}
?>