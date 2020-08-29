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
	<!-- HEADER -->
	<header>
		<?php
			include('php/checkLogin.php');
		?>
		<!-- top Header -->
		<div id="top-header">
			<div class="container">
				<div class="pull-left">
					<?php
						include('php/helloUsr.php');
					?>
				</div>
				<div class="pull-right">
					<ul class="header-top-links">
						<li><a href="aboutus.html">Giới thiệu</a></li>
					</ul>
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
							<img src="./img/logo_black.png" alt="">
						</a>
					</div>
					<!-- /Logo -->

					<!-- Search -->
					<div class="header-search">
						<form action="products.php" method="GET" onsubmit="return true" name="Search">
							<input class="input search-input" type="text" placeholder="Enter your keyword" name="txtSearch"
								<?php
									if (isset($_GET['txtSearch']))
										echo "value=\"".$_GET['txtSearch']."\"";
								?>
							>
							<button class="search-btn" type="submit"><i class="fa fa-search"></i></button>
						</form>
					</div>
					<!-- /Search -->
				</div>
				<div class="pull-right">
					<ul class="header-btns">
						<!-- Account -->
						<?php
							include('php/account.php');
						?>
						<!-- /Account -->

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
				<li class="active">Giỏ Hàng</li>
			</ul>
		</div>
	</div>
	<!-- /BREADCRUMB -->

	<!-- section -->
	<?php
		$Count=0;
		if(isset($_SESSION['Cart']))
		foreach($_SESSION['Cart'] as $id=>$SL)
		if(isset($id)) $Count++;
	?>
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<?php
					
					if($Count>0)
					{
				?>
				<div class="col-md-12">
					<div class="order-summary clearfix">
						<div class="section-title">
							<h3 class="title">Giỏ Hàng</h3>
						</div>
						<table class="shopping-cart-table table">
							<?php
								if($Count>0)
								{
							?>
							<thead>
								<tr>
									<th>Hàng Hóa</th>
									<th></th>
									<th class="text-center">Giá</th>
									<th class="text-center">Số Lượng</th>
									<th class="text-center">Thành tiền</th>
									<th class="text-center">Cập Nhật</th>
									<th class="text-center">Bỏ</th>
								</tr>
							</thead>
							<?php
									require_once('DataProvider.php');
									if(isset($_SESSION['Cart']))
									{
										$Price=0;
										foreach($_SESSION['Cart'] as $id=>$SL)
										if(isset($id))
										{
											$sql="SELECT * FROM Product WHERE ProductID=$id";
											$rs=DataProvider::executeQuery($sql);
											$row=mysqli_fetch_array($rs,MYSQLI_ASSOC);
											echo "<form name='cartProducts' id='cartProducts' action='php/cart.php' method='POST'>";
											echo "<tbody>";
											echo "	<tr>";
											echo "		<td class='thumb'><img src='./img/".$row['imgsrc']."' alt=''></td>";
											echo "		<td class='details'>";
											echo "			<a href='#'>".$row['ProductName']."</a>";
											echo "			<ul>";
											echo "				<li><span>Size: ".$row['Size']."</span></li>";
											echo "			</ul>";
											echo "		</td>";
											echo "		<td class='price text-center'><strong><script>document.write(PriceDot(".$row["UnitPrice"]."))</script></strong></td>";
											echo "		<td class='qty text-center'><input name='txtQuantity' class='input' type='number' min=1 value=$SL></td>";
											echo "		<td class='total text-center'><strong class='primary-color'><script>document.write(PriceDot(".$row['UnitPrice']*$SL."))</script></strong></td>";
											echo "		<td class='text-center'><button type='submit' name='btnUpdate' class='main-btn icon-btn'><i class='fa fa-refresh'></i></button></td>";
											echo "		<td class='text-center'><button type='submit' name='btnDel' class='main-btn icon-btn'><i class='fa fa-close'></i></button></td>";
											echo "	</tr>";
											echo "</tbody>";
											echo "<input name='txtProductID' type='hidden' value='".$row['ProductID']."' >";
											echo "<input name='txtURL' type='hidden' value=".$_SERVER['REQUEST_URI']." >";
											echo "</form>";
											$Price+=$row['UnitPrice']*$SL;
										}
									}
							?>
							<tfoot>
								<tr>
									<th class="empty" colspan="3"></th>
									<th>Tổng</th>
									<?php echo "<th colspan='3' class='sub-total'><script>document.write(PriceDot(".$Price."))</script></th>" ?>
								</tr>
							</tfoot>
						</table>
						<div class="pull-right">
							<a href='checkout.php'><button type='button' class="primary-btn">Thanh Toán</button></a>
						</div>
						<?php
							}
						?>
					</div>
				</div>
				<?php
					}
					else
					{
						echo "<p>Bạn chưa mua hàng, hãy thử chọn vài món nhé</p>";
				?>
				<div class="row">
					<!-- section title -->
					<div class="col-md-12">
						<div class="section-title">
							<h2 class="title">Đề xuất cho bạn</h2>
						</div>
					</div>
					<!-- section title -->
				<?php
					$sql = "SELECT * FROM Product ORDER BY Date DESC LIMIT 0,4";
					$result = DataProvider::executeQuery($sql);
					while($row=mysqli_fetch_array($result,MYSQLI_ASSOC))
					{
						echo "<!-- Product Single -->";
						echo "<form name='products' id='products' action='php/cart.php' method='POST'>";
						echo "<div class='col-md-3 col-sm-6 col-xs-6'>";
						include('php/productsingle.php');
						echo "</div>";
						echo "</form>";
						echo "<!-- /Product Single -->";
					}
				?>
				</div>
				<!-- row -->
				<?php
					}
				?>
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
