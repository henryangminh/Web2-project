<!DOCTYPE html>
<?php
	include('php/sessionAdmin.php');
	include('php/sessionStore.php');
?>
<?php
	ob_start();
?>
<html lang="vi">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>YạMẹ SHOP</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Encode+Sans+Expanded|Encode+Sans+Semi+Condensed" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="../css/bootstrap.min.css" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="../css/slick.css" />
	<link type="text/css" rel="stylesheet" href="../css/slick-theme.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="../css/nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="../css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="../css/style.css" />
	<link type="text/css" rel="stylesheet" href="../css/extrastyle.css">
	<script src='js/admin.js'></script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
</head>

<body>
	<!-- HEADER -->
	<header>
		<?php
			if($_SESSION['isLogin']==1)
			{
				require_once('../DataProvider.php');
				$sql="SELECT * FROM Usr WHERE Email='".$_SESSION['username']."'";
				$Usr=DataProvider::executeQuery($sql);
				$rowUsr=mysqli_fetch_array($Usr,MYSQLI_BOTH);
			}
		?>
		<!-- top Header -->
		<div id="top-header">
			<div class="container">
				<div class="pull-left">
					<?php
						include('../php/helloUsr.php');
					?>
				</div>
			</div>
		</div>
		<!-- /top Header -->

		<!-- header -->
		<div id="header">
			<div class="container">
				<div class="pull-left">
					<!-- Logo -->
					<div class="header-logo">
						<a class="logo" href="#">
							<img src="../img/logo_black.png" alt="">
						</a>
					</div>
					<!-- /Logo -->
				</div>
				<div class="pull-right">
					<ul class="header-btns">
					<?php include('php/account.php'); ?>

						<!-- Mobile nav toggle-->
						<li class="nav-toggle">
							<button class="nav-toggle-btn main-btn icon-btn"><i class="fa fa-bars"></i></button>
						</li>
						<!-- / Mobile nav toggle -->
					</ul>
				</div>
			</div>
			<!-- header -->
		</div>
		<!-- container -->
	</header>
	<!-- /HEADER -->

	<?php include('php/navigationProduct.php'); ?>

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- MAIN -->
				<div id="main" class="col-md-12">
					<form id='addProduct' name='addProduct' action='admin-add-product.php' method='POST' enctype="multipart/form-data" onsubmit='return checkAddProduct()'>
						<span id='lblNULL' style='color:red; display:none;'>*: Chưa nhập/Chưa chọn</span>
						<span class='text-uppercase'>Tên sản phẩm: </span>
						<?php 
							echo "<input type='text' name='atxtProductName' id='atxtProductName'";
							if(isset($_POST['atxtProductName']))
								echo" value = '".$_POST['atxtProductName']."'>";
							else
								echo ">";
						?>
						<span id='lblProductNameNULL' style='color:red; display:none;'>*</span>
						<br><br>

						<span class='text-uppercase'>Loại sản phẩm: </span>
						<select name="aslcType" id='aslcType'>
							<?php
								require_once("../DataProvider.php");
								$sql = "SELECT DISTINCT ProductTypeName FROM ProductType";
								$Type = DataProvider::executeQuery($sql);
								$type = "";
								if(isset($_POST['aslcType']))
									$type=$_POST['aslcType'];
								echo $type;
								if($type=="")
									echo "<option value='' selected></option>";
								else
									echo "<option value=''></option>";
								while($row = mysqli_fetch_array($Type,MYSQLI_BOTH))
								{
									if($type == $row['ProductTypeName'])
										echo "<option value='".$row['ProductTypeName']."' selected>".$row['ProductTypeName']."</option>";
									else
										echo "<option value='".$row['ProductTypeName']."'>".$row['ProductTypeName']."</option>";
								}
							?>
						</select>
						<span id='lblTypeNULL' style='color:red; display:none;'>*</span>

						<span class='text-uppercase'>Giới tính: </span>
						<select name="aslcGender" id='aslcGender'>
							<?php
								$gender = array("","Nam","Nữ","Unisex");
								$genderPOST="";
								if(isset($_POST['aslcGender']))
									$genderPOST=$_POST['aslcGender'];
								foreach ($gender as $Gender)
								{
									if($Gender==$genderPOST)	
										echo "<option value='".$Gender."' selected>".$Gender."</option>";
									else
										echo "<option value='".$Gender."'>".$Gender."</option>";
								}
							?>
						</select>
						<span id='lblGenderNULL' style='color:red; display:none;'>*</span>
						<p id='lblTypeError' style='color:red; display:inline-block'></p>
						<br><br>

						<span class='text-uppercase'>Size: </span>
						<select id='aslcSize' name="aslcSize">
							<?php
								$size=array("","S","M","L","XL");
								$sizePOST="";
								if(isset($_POST['aslcSize']))
									$sizePOST=$_POST['aslcSize'];
								foreach ($size as $Size)
								{
									if($Size==$sizePOST)	
										echo "<option value='".$Size."' selected>".$Size."</option>";
									else
										echo "<option value='".$Size."'>".$Size."</option>";
								}
							?>
						</select>
						<span id='lblSizeNULL' style='color:red; display:none;'>*</span>
						<br><br>

						<span class='text-uppercase'>Giá: </span>
						<?php 
							echo "<input type='text' name='atxtPrice' id='atxtPrice'";
							if(isset($_POST['atxtPrice']))
								echo" value = ".$_POST['atxtPrice'].">";
							else
								echo ">";
						?>
						<span id='lblPriceNULL' style='color:red; display:none;'>*</span>
						<span id='lblPriceNoError' style='color:red; display:none;'>Giá nhập phải là số</span>
						<br><br>

						<span class='text-uppercase'>Số Lượng: </span>
						<?php 
							echo "<input type='text' name='atxtQuantity' id='atxtQuantity'";
							if(isset($_POST['atxtQuantity']))
								echo" value = ".$_POST['atxtQuantity'].">";
							else
								echo ">";
						?>
						<span id='lblQuantityNULL' style='color:red; display:none;'>*</span>
						<span id='lblQuantityNoError' style='color:red; display:none;'>Số lượng nhập phải là số</span>
						<br><br>

						<span class='text-uppercase'>Chọn Hình: </span>
						<input type="hidden" name="MAX_FILE_SIZE" value="2097152">
						<input type='file' name='afileImage' style='width:200px; display: inline-block;'>
						<span id='lblImageNULL' style='color:red; display:none;'>*</span>
						<p id='lblImgError' style='color:red; display:inline-block'></p>
						<br><br>

						<input name='btnAddProduct' type='submit' value='Thêm Hàng'>
						<input name='btnReset' type='reset' value='Làm lại'>
					</form>
				</div>
				<!-- /MAIN -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	<?php
	require_once('../DataProvider.php');
	if(isset($_POST['btnAddProduct']))
	{
		$imgCheck=true;
		if(isset($_FILES['afileImage']))
		{
			if ($_FILES['afileImage']['error'] > 0)
			{
				switch($_FILES['afileImage']['error'])
				{
					case 2:
						echo "<script> document.getElementById('lblImgError').innerHTML='File vượt quá kích thước (2MB)'</script>";
						$imgCheck=false;
						break;
					case 4:
						echo "<script> document.getElementById('lblImageNULL').style.display='inline-block'; </script>";
						echo "<script> document.getElementById('lblNULL').style.display='block'; </script>";
						$imgCheck=false;
						break;
				}
			}
			else
				if(!preg_match('/^image\//',$_FILES['afileImage']['type']))
					{echo "<script> document.getElementById('lblImgError').innerHTML='File upload phải là file hình'</script>";$imgCheck=false;}
				elseif(!preg_match('/^image\/(jpeg|gif)$/',$_FILES['afileImage']['type']))
					{echo "<script> document.getElementById('lblImgError').innerHTML='File hình phải có dạng JPG hoặc GIF'</script>";$imgCheck=false;}
		}
		$sql="SELECT * FROM ProductType WHERE ProductTypeName='".$_POST['aslcType']."' AND Gender='".$_POST['aslcGender']."'";
		$rs = DataProvider::executeQuery($sql);
		$sql_auto_icrement = "SHOW TABLE STATUS WHERE name='Product'";
		$rs_ai=DataProvider::executeQuery($sql_auto_icrement);
		$txtProductTypeID = "";
		$auto_increment="";
		while($row=mysqli_fetch_array($rs,MYSQLI_BOTH))
			$txtProductTypeID=$row['ProductTypeID'];
		while($row=mysqli_fetch_array($rs_ai,MYSQLI_BOTH))
			$auto_increment=$row['Auto_increment'];
		if($txtProductTypeID!="")
		{
			if($imgCheck)
			{
				$imgName = "SP".$auto_increment;
				if($_FILES['afileImage']['type']=='image/jpeg')
					$imgName.= ".jpg";
				else
					$imgName.=".gif";
				$sqlAddProduct="INSERT INTO Product(ProductName, ProductTypeID, UnitPrice, Quantity, Size, imgsrc, Date) VALUES (";
				$sqlAddProduct.="'".$_POST['atxtProductName']."', ";
				$sqlAddProduct.="'".$txtProductTypeID."', ";
				$sqlAddProduct.="'".$_POST['atxtPrice']."', ";
				$sqlAddProduct.="'".$_POST['atxtQuantity']."', ";
				$sqlAddProduct.="'".$_POST['aslcSize']."', ";
				$sqlAddProduct.="'".$imgName."', ";
				$sqlAddProduct.="NOW()";
				$sqlAddProduct.=")";
				$destination='../img/'.$imgName;
				DataProvider::executeQuery($sqlAddProduct);
				move_uploaded_file($_FILES['afileImage']['tmp_name'],$destination);
				echo "<script>alert('Thêm hàng thành công')</script>";
				echo "<script>document.location = 'adminproducts.php?slcSortBy=Date&slcSort=DESC';</script>";
				//header("Location: adminproducts.php?slcSortBy=Date&slcSort=DESC");
			}
		}
		else
		{
			$message = $_POST['aslcType']." dành cho ".$_POST['aslcGender']." chưa có trong CSDL";
			echo "<script> document.getElementById('lblTypeError').innerHTML='$message'</script>";
		}
	}
	?>

	<!-- FOOTER -->
	<footer id="footer" class="section section-grey">
		<!-- container -->
		<div class="container">
			<hr>
			<!-- row -->
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<!-- footer copyright -->
					<div class="footer-copyright">
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" tarPOST="_blank">Colorlib</a>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					</div>
					<!-- /footer copyright -->
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</footer>
	<!-- /FOOTER -->

	<!-- jQuery Plugins -->
	<script src="../js/jquery.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/slick.min.js"></script>
	<script src="../js/nouislider.min.js"></script>
	<script src="../js/jquery.zoom.min.js"></script>
	<script src="../js/main.js"></script>

</body>

</html>
