<?php
    session_start();
    ob_start();

    if($_SESSION['isLogin']==1)
    {
        require_once('../DataProvider.php');
        $sql="SELECT * FROM Usr WHERE Email='".$_SESSION['username']."'";
        $rs=DataProvider::executeQuery($sql);
        $rowUsr=mysqli_fetch_array($rs,MYSQLI_BOTH);
    }

    if($_SESSION['isLogin']==0)
        header('Location: ../checkout.php');

    $usrName="";
    $address="";
    $phoneNo="";
    $email=$_SESSION['username'];
    
    if(isset($_POST['btnCheckOut']))
    {
        if($_POST['txtUsrName']=='')
            $usrName=$rowUsr['UsrName'];
        else
            $usrName=$_POST['txtUsrName'];
        
        if($_POST['txtAddress']=='')
            $address=$rowUsr['Address'];
        else
            $address=$_POST['txtAddress'];
        
        if($_POST['txtPhoneNo']=='')
            $phoneNo=$rowUsr['PhoneNo'];
        else
            $phoneNo=$_POST['txtPhoneNo'];

        $sql = "SHOW TABLE STATUS WHERE name='Invoice'";
        $rs=DataProvider::executeQuery($sql);
        $row_ai=mysqli_fetch_array($rs,MYSQLI_BOTH);
        $ai=$row_ai['Auto_increment'];

        if($_POST['shipping']==0)
            $ship=50000;
        else
            $ship=0;

        $sql="INSERT INTO Invoice (Email, UsrName, PhoneNo, Address, SubTotal, Ship, Total, DateInvoice) VALUES ('$email', '$usrName', '$phoneNo', '$address', '0', '$ship', '0', NOW())";
        DataProvider::executeQuery($sql);

        $Price=0;
        foreach($_SESSION['Cart'] as $id=>$SL)
        if(isset($id))
        {
            $sql="SELECT * FROM Product WHERE ProductID=$id";
            $rs=DataProvider::executeQuery($sql);
            $row=mysqli_fetch_array($rs,MYSQLI_ASSOC);
            
            $sql="INSERT INTO InvoiceDetails (InvoiceID, ProductID, Quantities, Price, SubTotal) VALUES ('$ai', '$id', '$SL', '".$row['UnitPrice']."', '".$row['UnitPrice']*$SL."')";
            DataProvider::executeQuery($sql);

            $Price+=$row['UnitPrice']*$SL;
        }

        $sql="UPDATE Invoice SET SubTotal=".$Price.", Total=".($Price+$ship)." WHERE InvoiceID=$ai";
        DataProvider::executeQuery($sql);

        unset($_SESSION['Cart']);
        echo "<script>alert('Thanh toán thành công');</script>";
        echo "<script>document.location = '../index.php';</script>";
    }
?>