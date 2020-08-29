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
				<?php
					require_once('../DataProvider.php');
					if(isset($_POST['btnAddProductType']))
					{
						$sql="SELECT * FROM ProductType WHERE ProductTypeName LIKE '".$_POST['ttxtProductName']."' AND Gender='".$_POST['tslcGender']."'";
						$rs = DataProvider::executeQuery($sql);
						$txtProductTypeID = "";
						while($row=mysqli_fetch_array($rs,MYSQLI_BOTH))
							$txtProductTypeID=$row['ProductTypeID'];
						if($txtProductTypeID!="")
						{
							echo "<script>alert('".$_POST['ttxtProductName']." dành cho ".$_POST['tslcGender']." đã có trong CSDL')</script>";
						}
						else
						{
							$sql="INSERT INTO ProductType (ProductTypeName, Gender) VALUES ('".$_POST['ttxtProductName']."', '".$_POST['tslcGender']."')";
							DataProvider::executeQuery($sql);
							echo "<script>alert('Thêm loại hàng thành công')</script>";
							header("Location: adminproducts.php?slcType=".$_POST['ttxtProductName']."&slcGender=".$_POST['tslcGender']."");
						}
					}
				?>
				<div id="main" class="col-md-12">
					<form id='addProductType' name='addProductType' action='admin-add-product-type.php' method='POST' onsubmit='return checkAddProductType();'>
						<span id='lblNULL' style='color:red; display:none;'>*: Chưa nhập/Chưa chọn</span>
						<span class='text-uppercase'>Tên loại sản phẩm: </span>
						<?php
							if(isset($_POST['btnAddProductType']))
								echo "<input type='text' name='ttxtProductName' id='ttxtProductName' value='".$_POST['ttxtProductName']."'>";
							else
								echo "<input type='text' name='ttxtProductName' id='ttxtProductName'>";
						?>
						<span id='lblProductNameTypeNULL' style='color:red; display:none;'>*</span>
						<span id='lblProductNameTypeCHAR' style='color:red; display:none;'>*Không được có ký tự lạ*</span>
						<br><br>

						<span class='text-uppercase'>Giới tính: </span>
						<select name="tslcGender" id='tslcGender'>
							<?php
								$gender = array("","Nam","Nữ","Unisex");
								$genderPost = "";
								if(isset($_POST['btnAddProductType']))
									$genderPost=$_POST['tslcGender'];
								foreach ($gender as $Gender)
								if($genderPost == $Gender)
									echo "<option value='".$Gender."' selected>".$Gender."</option>";
								else
									echo "<option value='".$Gender."'>".$Gender."</option>";
							?>
						</select>
						<span id='lblGenderNULL' style='color:red; display:none;'>*</span>
						<br><br>

						<input name='btnAddProductType' type='submit' value='Thêm Loại Hàng'>
						<input type='button' value='Làm lại' onclick='Reset()'>
					</form>
				</div>
				<!-- /MAIN -->
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

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
						Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
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
