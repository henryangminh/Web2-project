<!DOCTYPE html>
<html lang="vi">
<?php
	include('php/sessionAdmin.php');
	include('php/sessionStore.php');
?>

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
	<script src="../js/extrafunction.js"></script>
	<script src="js/admin.js"></script>

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
					<?php
						if(!isset($_POST['txtID']))
							header("Location: adminproducts.php");
						//Initiation
						$sql = "SELECT * FROM Product INNER JOIN ProductType WHERE Product.ProductTypeID = ProductType.ProductTypeID AND ProductID = '".$_POST['txtID']."'";
						$sql_type = "SELECT DISTINCT * FROM ProductType";
						$gender = array("Nam","Nữ","Unisex");
						$size = array("S","M","L","XL");
						//--Initiation

						//Execute Query
						require_once("../DataProvider.php");
						$rs = DataProvider::executeQuery($sql);
						$rs_Type = DataProvider::executeQuery($sql_type);
						//--Execute Query

						//Show
						while($row = mysqli_fetch_array($rs,MYSQLI_BOTH))
						{
							echo "<form name='editProducts' id='editProducts' action='adminproducts.php' method='POST' onsubmit='return confirmDel()'>";
							echo "<input name='txtID' id='txtID' type='hidden' value='".$_POST['txtID']."'>";
							echo "<div class='col-md-3'>";
							echo "<img src='../img/".$row["imgsrc"]."' width='258px' height='344px' alt='".$row["ProductName"]."'>";
							echo "</div>";
							echo "<div class='col-md-6'>";
							echo "<span class='text-uppercase'>Tên Sản Phẩm: </span>";
							echo "<input name='qtxtProductName' id='qtxtProductName' type='text' value='".$row['ProductName']."'>";
							echo "<br><br>";

							echo "<span class='text-uppercase'>Loại: </span>";
							echo "<select name='qslcProductType' id='qslcProductType'>";
							while($row_type = mysqli_fetch_array($rs_Type,MYSQLI_BOTH))
							{
								if($row_type['ProductTypeID']==$row['ProductTypeID'])
								echo "<option value='".$row_type['ProductTypeName']."' selected>".$row_type['ProductTypeName']."</option>";
								else
								echo "<option value='".$row_type['ProductTypeName']."'>".$row_type['ProductTypeName']."</option>";
							}							
							echo "</select>";
							
							echo "<span class='text-uppercase' style='padding-left:15px;'>Giới tính: </span>";
							echo "<select name='qslcGender' id='qslcGender'>"; 
							foreach($gender as $Gender)
								if($Gender==$row['Gender'])
									echo "<option value='".$row['Gender']."' selected>".$Gender."</option>";
								else
									echo "<option value='".$Gender."'>".$Gender."</option>";
							echo "</select>";
							echo "<br><br>";

							echo "<span class='text-uppercase'>Giá: </span>";
							echo "<input name='qtxtPrice' id='qtxtPrice' type='text' value='".$row['UnitPrice']."'>";
							echo "<br><br>";
							
							echo "<span class='text-uppercase'>Size: </span>";
							echo "<select name='qslcSize' id='qslcSize'>"; 
							foreach($size as $Size)
								if($Size==$row['Size'])
									echo "<option value='".$Size."' selected>".$Size."</option>";
								else
									echo "<option value='".$Size."'>".$Size."</option>";
							echo "</select>";
							echo "<br><br>";

							echo "<span class='text-uppercase'>Số Lượng: </span>";
							echo "<input name='qtxtQuantity' id='qtxtQuantity' type='number' min=0 value='".$row['Quantity']."'>";
							echo "<br><br>";

							echo "<span class='text-uppercase'>Ngày thêm hàng: </span>";
							echo "<span class='text-uppercase'>".$row['Date']."</span>";
							echo "<br><br>";

							echo "<input type='submit' name='btnEditDel' class='primary-btn edit-del' value='Sửa'>";
							echo "<input type='submit' name='btnEditDel' class='primary-btn edit-del' value='Xóa'>";
							echo "</div>";
							echo "</form>";
						}
						//--Show
					?>
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
