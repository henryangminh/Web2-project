<?php
    session_start();
    
    $txtURL=$_POST['txtURL'];
    $ProductID=$_POST['txtProductID'];
    $Quatity=$_POST['txtQuantity'];
	
    if(isset($_POST['btnAddToCart']))
    {
        if(isset($_SESSION['Cart'][$ProductID]))
            $_SESSION['Cart'][$ProductID]+=$Quatity;
        else
            $_SESSION['Cart'][$ProductID]=$Quatity;
    }

    if(isset($_POST['btnUpdate']))
        $_SESSION['Cart'][$ProductID]=$Quatity;

    if(isset($_POST['btnDel']))
        unset($_SESSION['Cart'][$ProductID]);

    if(isset($_POST['btnDelAll']))
        unset($_SESSION['Cart']);

    header('Location: '.$txtURL);
?>