<?php
	session_start();
	include('php/sessionStart.php');
?>

<!DOCTYPE html>
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
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<!-- Slick -->
	<link type="text/css" rel="stylesheet" href="css/slick.css" />
	<link type="text/css" rel="stylesheet" href="css/slick-theme.css" />

	<!-- nouislider -->
	<link type="text/css" rel="stylesheet" href="css/nouislider.min.css" />

	<!-- Font Awesome Icon -->
	<link rel="stylesheet" href="css/font-awesome.min.css">

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />
	<link type="text/css" rel="stylesheet" href="css/extrastyle.css">
	<script src="js/extrafunction.js"></script>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
</head>


<body>
	
	<?php include('php/header.php'); ?>

	<!-- NAVIGATION -->
	<div id="navigation">
		<!-- container -->
		<div class="container">
			<div id="responsive-nav">
			<!-- category nav -->
			<div class="category-nav show-on-click">
				<?php include('php/category-nav.php'); ?>
			</div>
			<!-- /category nav -->

				<?php include('php/menu-nav.php'); ?>

			</div>
		</div>
		<!-- /container -->
	</div>
	<!-- /NAVIGATION -->

	<!-- BREADCRUMB -->
	<div id="breadcrumb">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="index.php">Home</a></li>
				<li><a href="products.php">Sản Phẩm</a></li>
				<li class="active">Chi tiết sản phẩm</li>
			</ul>
		</div>
	</div>
	<!-- /BREADCRUMB -->
	
	<!-- section -->
	<?php
	require_once('DataProvider.php');
	$sql="SELECT * FROM Product INNER JOIN ProductType WHERE Product.ProductTypeID=ProductType.ProductTypeID AND ProductID='".$_GET['productid']."'";
	$rs=DataProvider::executeQuery($sql);
	$rowProduct=mysqli_fetch_array($rs,MYSQLI_BOTH);
	?>
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!--  Product Details -->
				<div class="product product-details clearfix">
					<div class="col-md-6">
						<div id="product-main-view">
							<div class="product-view">
							<?php
								echo "<img src= './img/".$rowProduct['imgsrc']."' alt=''>"; 
							?>
								
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="product-body">
							<form name='productdetails' id='productdetails' action='php/cart.php' method='POST' onsubmit='return checkQuant();'>
							<?php
								echo "<h2 class='product-name'>".$rowProduct['ProductName']."</h2>";
								echo "<h3 class='product-price'><script>document.write(PriceDot(".$rowProduct['UnitPrice']."))</script></h3>";
								if($rowProduct['Quantity']>0)
									{ echo "<p><strong>Tình trạng:</strong> Còn hàng</p>";} 
								else{ echo "<p><strong>Tình trạng:</strong><strong style='color:red;'> Hết hàng </strong></p>";}
								echo "<input type='hidden' name='checkQuantity' value='".$rowProduct['Quantity']."'>";
								echo "<p><strong>Nhà cung cấp:</strong> YạMẹ</p>";
								echo "<p><strong>Giới tính:</strong> ".$rowProduct['Gender']."</p>";
								echo "<p><strong>Loại sản phẩm:</strong> ".$rowProduct['ProductTypeName']."</p>";
								echo "<p><strong>Size:</strong> ".$rowProduct['Size']."</p>";
								echo "<p> ".$rowProduct['Description']."</p>";
							?>
								<div class="product-btns">
									<div class="qty-input">
										<span class="text-uppercase">SỐ LƯỢNG: </span>
										<input name='txtQuantity' class="input" type="number" value='1' min='1'>
									</div>
									<?php
										echo "<input type='hidden' name='txtURL' value='".$_SERVER['REQUEST_URI']."'>";
										echo "<input type='hidden' name='txtProductID' value='".$_GET['productid']."'>";
										
									?>
									<input name='btnAddToCart' type="submit" style="margin-top:50px;" class="primary-btn add-to-cart" value="Thêm vào giỏ hàng">
								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- /Product Details -->
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
			<!-- row -->
			<div class="row">
				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<!-- footer logo -->
						<div class="footer-logo">
							<a class="logo" href="#">
					<img src="./img/logo_black.png" alt="">
					</a>
						</div>
						<!-- /footer logo -->

						<p>Phục vụ như mẹ của bạn</p>

						<!-- footer social -->
						<ul class="footer-social">
							<li><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram"></i></a></li>
							<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							<li><a href="#"><i class="fa fa-pinterest"></i></a></li>
						</ul>
						<!-- /footer social -->
					</div>
				</div>
				<!-- /footer widget -->

				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Tài khoản của tôi</h3>
						<?php include('php/footer.php'); ?>
					</div>
				</div>
				<!-- /footer widget -->

				<div class="clearfix visible-sm visible-xs"></div>

				<!-- footer widget -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Gọi YạMẹ nhé</h3>
						<p><i class="fa fa-phone-square"> 0969.9966.6969</i></p>
					</div>
				</div>
				<!-- /footer widget -->

				<!-- footer subscribe -->
				<div class="col-md-3 col-sm-6 col-xs-6">
					<div class="footer">
						<h3 class="footer-header">Giới thiệu</h3>
						<p>YạMẹ là trang web thời trang uy tín nhất thế giới. Được thành lập từ năm 2018. Với hơn 1 tuần kinh nghiệm, chúng tôi sẽ cố gắng phục vụ bạn như mẹ của bạn</p>
					</div>
				</div>
				<!-- /footer subscribe -->
			</div>
			<!-- /row -->
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
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/slick.min.js"></script>
	<script src="js/nouislider.min.js"></script>
	<script src="js/jquery.zoom.min.js"></script>
	<script src="js/main.js"></script>

</body>

</html>
