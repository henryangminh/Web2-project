<?php
    if($_SESSION['isLogin']==0)
    {
?>
    <ul class="list-links">
        <li><a href="signin.php">Đăng nhập</a></li>
        <li><a href="signin.php">Tạo tài khoản</a></li>
    </ul>
<?php
    }
    else
    {
?>
    <ul class="list-links">
        <li><a href="signin.php">Tài khoản của tôi</a></li>
        <li><a href="view-cart.php">Giỏ hàng của tôi</a></li>
        <li><a href="index.php?logout=1">Đăng xuất</a></li>
    </ul>
<?php
    }
?>