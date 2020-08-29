<?php
    if($_SESSION['isLogin']==1)
        echo "<span>Chào mừng ".$rowUsr['UsrName']." đến với YạMẹ</span>";
    else
        echo "<span>Chào mừng bạn đến với YạMẹ. Hãy đăng nhập hoặc đăng ký tài khoản</span>";
?>