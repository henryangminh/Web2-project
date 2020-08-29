<?php
    if($_SESSION['isLogin']==1)
    {
        require_once('DataProvider.php');
        $sql="SELECT * FROM Usr WHERE Email='".$_SESSION['username']."'";
        $rs=DataProvider::executeQuery($sql);
        $rowUsr=mysqli_fetch_array($rs,MYSQLI_BOTH);
    }
?>