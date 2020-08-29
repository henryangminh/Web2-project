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
				<li class="active">Sản Phẩm</li>
			</ul>
		</div>
	</div>
	<!-- /BREADCRUMB -->

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- ASIDE -->
				<div id="aside" class="col-md-3">
					<!-- aside widget -->
					<form action="products.php" method="GET" id="formAdvanceSearch" name="formAdvanceSearch" onsubmit="return checkAdvancedSearch()">
						<div class="aside">
							<h3 class="aside-title">Tìm kiếm nâng cao:</h3>
							<?php
								if (isset($_GET['txtSearch']))
								echo "<input type=\"hidden\" name=\"txtSearch\" value=\"".$_GET['txtSearch']."\">";
							?>
							<ul class="filter-list">
								<span class="text-uppercase">Size:</span>
								<select class="input aside-size-input" name="slcSize">
									<?php
										$size=array("","S","M","L","XL");
										$Size = "";
										if(isset($_GET['slcSize']))
											$Size = $_GET['slcSize'];
										for($i=0;$i<count($size);$i++)
										{
											$temp = $size[$i];
											echo "<option value='$temp'";
											if($Size == $temp) echo "selected";
											echo ">$temp</option>";
										}
									?>
								</select>
							</ul>

							<ul class="filter-list">
								<span class="text-uppercase">Loại:</span>
								<select class="input aside-type-input" name="slcType">
									<?php
										require_once("DataProvider.php");
										$sql = "SELECT DISTINCT ProductTypeName FROM ProductType";
										$Type = DataProvider::executeQuery($sql);
										$type = "";
										if(isset($_GET['slcType']))
											$type = $_GET['slcType'];
										if($type == "") echo "<option value='' selected></option>";
										else echo "<option value=''></option>";
										while($row = mysqli_fetch_array($Type,MYSQLI_BOTH))
										{
											echo "<option value='".$row['ProductTypeName']."'";
											if($type == $row['ProductTypeName']) echo "selected";
											echo ">".$row['ProductTypeName']."</option>";
										}
									?>
								</select>
							</ul>

							<ul class="filter-list">
								<li><span class="text-uppercase">Giá:</span></li>
								<input type="text" placeholder="Từ" class="input aside-input" id="txtFrom" name="txtFrom" onkeypress="return Keypress(event);" onkeyup="addDot(this);"
									<?php
										if(isset($_GET['txtFrom']))
										echo "value=\"".$_GET['txtFrom']."\""
									?>
								>
								<input type="text" placeholder="Đến" class="input aside-input" id="txtTo" name="txtTo" onkeypress="return Keypress(event);" onkeyup="addDot(this);"
									<?php
										if(isset($_GET['txtTo']))
										echo "value=\"".$_GET['txtTo']."\""
									?>
								>
								<p id="priceError" align="center" style="color:red;"></p>
							</ul>

							<ul class="filter-list">
								<span class="text-uppercase">Giới tính:</span>
								<select class="input aside-sex-input" name="slcGender">
									<?php
										$gender = array("","Nam","Nữ","Unisex");
										$Gender="";
										if(isset($_GET['slcGender']))
											$Gender = $_GET['slcGender'];
										for($i=0;$i<count($gender);$i++)
										{
											echo "<option value='$gender[$i]'";
											if($Gender == $gender[$i]) echo "selected";
											echo ">$gender[$i]</option>";
										}
									?>
								</select>
							</ul>
							
							<ul class="filter-list">
								<span class="text-uppercase">Sắp xếp:</span>
								<select class="input aside-sort-by" name="slcSortBy">
									<?php
										$valueSortBy = array("","ProductName","UnitPrice");
										$SortBy = array("","Tên","Giá");
										$sortBy = "";
										if(isset($_GET['slcSortBy']))
											$sortBy = $_GET['slcSortBy'];
										for($i=0;$i<count($valueSortBy);$i++)
										{
											echo "<option value='$valueSortBy[$i]'";
											if($sortBy==$valueSortBy[$i]) echo "selected";
											echo ">$SortBy[$i]</option>";
										}
									?>
								</select>

								<select class="input aside-sort" name="slcSort">
									<?php
										$valueSort = array("ASC","DESC");
										$Sort = array("Tăng dần","Giảm dần");
										$sort = "";
										if(isset($_GET['slcSort']))
											$sort = $_GET['slcSort'];
										for($i=0;$i<count($valueSort);$i++)
										{
											echo "<option value='$valueSort[$i]'";
											if($sort==$valueSort[$i]) echo "selected";
											echo ">$Sort[$i]</option>";
										}
									?>
								</select>
							</ul>

							<button class="primary-btn aside-button" type="reset">Làm mới</button>
							<button class="primary-btn aside-button" type="submit">Tìm kiếm</button>
						</div>
					</form>
					<!-- /aside widget -->
				</div>
				<!-- /ASIDE -->

				<!-- MAIN -->
				<div id="main" class="col-md-9">
					<!-- store top filter -->
					<div class="store-filter clearfix">
						<div class="pull-right">
							<ul class="store-pages">
								<?php
									//Initiation
									$sql = "SELECT * FROM Product INNER JOIN ProductType WHERE Product.ProductTypeID = ProductType.ProductTypeID ";
									$sql_where = "";
									$rowsPerPage = 6;
									//Initiation

									//add $sql for ProductName
									if(isset($_GET['txtSearch'])&&isset($_GET['txtSearch'])!="")
										$sql_where = "AND ProductName LIKE '%".$_GET['txtSearch']."%'";
									//add $sql for ProductName

									//add $sql for Price
									if(isset($_GET['txtFrom'])&&isset($_GET['txtFrom'])!="")
									{
										$txtFrom = $_GET['txtFrom'];
										$txtFrom = preg_replace("/[^0-9]/",'',$txtFrom) * 1;										
									}
									if(isset($_GET['txtTo'])&&isset($_GET['txtTo'])!="")
									{
										$txtTo = $_GET['txtTo'];
										$txtTo = preg_replace("/[^0-9]/",'',$txtTo) * 1;										
									}

									if(isset($txtFrom)&&$txtFrom != 0)
									{
										$sql_where .= " AND UnitPrice >= $txtFrom";
										if(isset($txtFrom)&&$txtTo != 0)
											$sql_where .= " AND UnitPrice <= $txtTo";
									}
									else
									{
										if(isset($txtFrom)&&$txtTo != 0)
											$sql_where .= " AND UnitPrice <= $txtTo";
									}
									//add $sql for Price

									//add $sql for Size
									if(isset($_GET['slcSize']))
									{
										$Size = $_GET['slcSize'];
										if($Size != "")
										$sql_where .= " AND Size = '$Size'";
									}
									//add $sql for Size

									//add $sql for Type
									if(isset($_GET['slcType']))
									{
										$Type = $_GET['slcType'];
										if($Type != "")
										$sql_where .= " AND ProductTypeName ='$Type'";
									}
									//add $sql for Type

									//add $sql for Gender
									if(isset($_GET['slcGender']))
									{
										$Gender = $_GET['slcGender'];
										if ($Gender != "")
										$sql_where .= " AND Gender ='$Gender'";
									}
									//add $sql for Gender

									//Merge $sql
									if($sql_where != "")
									$sql .= $sql_where;

									//add ORDER BY
									if(isset($_GET['slcSortBy'])&&isset($_GET['slcSort']))
									{
										$slcSortBy = $_GET['slcSortBy'];
										if($slcSortBy!="")
										{
											$slcSort = $_GET['slcSort'];
											$sql .= " ORDER BY $slcSortBy $slcSort";
										}
									}
									//add ORDER BY

									//Paging
									$page=1;
									if(isset($_GET['page']))
										$page = $_GET['page'];
									$offset = ($page - 1) * $rowsPerPage;
									$result_numrows = DataProvider::executeQuery($sql);
									$numrows = mysqli_num_rows($result_numrows);
									//Paging

									//Page navigation
									$maxPage = ceil($numrows/$rowsPerPage);
									$thisLocation = preg_replace("/&page=(\d*)/","",$_SERVER['REQUEST_URI']);
									$nav = "";
									for($i = 1; $i <= $maxPage; $i++)
									{
										if($i == $page)
											$nav .= "<li class=\"active\">$i</li>";
										else
										{
											if (!preg_match("/(.*)[?]/",$thisLocation)) 
												$thisLocation .= "?";
											$nav .= "<li><a href=\"$thisLocation&page=$i\">$i</a></li>";
										}
									}

									$thisLocation = preg_replace("/&page=(\d*)/","",$_SERVER['REQUEST_URI']);
									if (!preg_match("/(.*)[?]/",$thisLocation)) 
												$thisLocation .= "?";
									if ($page > 1)
									{
										$pagePrev = $page - 1;
										$prev  = " <a href=\"$thisLocation&page=$pagePrev\"><i class=\"fa fa-backward\"></i></a> ";

										$first = " <a href=\"$thisLocation&page=1\"><i class=\"fa fa-fast-backward\"></i></a> ";
									}
									else
									{
										$prev  = '&nbsp;'; // dang o trang 1, khong can in lien ket trang truoc
										$first = '&nbsp;'; // va lien ket trang dau
									}

									if ($page < $maxPage)
									{
										$pageNext = $page + 1;
										$next = " <a href=\"$thisLocation&page=$pageNext\"><i class=\"fa fa-forward\"></i></a> ";

										$last = " <a href=\"$thisLocation&page=$maxPage\"><i class=\"fa fa-fast-forward\"></i></a> ";
									}
									else
									{
										$next = '&nbsp;'; // dang o trang cuoi, khong can in lien ket trang ke
										$last = '&nbsp;'; // va lien ket trang cuoi
									}

									echo "$first $prev $nav $next $last";
									//Page navigation

									//Execute $sql with LIMIT to paging
									$sql .= " LIMIT $offset, $rowsPerPage";
									$result = DataProvider::executeQuery($sql);
									//Execute $sql
								?>
							</ul>
						</div>
					</div>
					<!-- /store top filter -->

					<!-- STORE -->
						<div id="store">
							<?php
								//Show Products
								$i=0; $Count=0;
								while($row=mysqli_fetch_array($result,MYSQLI_BOTH))
								{
									if($i==0)
									{
										echo "<!-- row -->";
										echo "<div class=\"row\">";
									}
									echo "<!-- Product Single -->";
									echo "<form name='products' id='products' action='php/cart.php' method='POST'>";
									echo "<div class=\"col-md-4 col-sm-6 col-xs-6\">";
									include('php/productsingle.php');
									echo "</div>";
									echo "</form>";
									echo "<!-- /Product Single -->";
									if($i==2)
									{
										echo "</div>";
										echo "<!-- row -->";
										$i=0;
									}
									else
										$i++;
									$Count++;
								}
								if($Count==0)
									echo "<h2>Không có sản phẩm nào hết nha bé yêu <i class=\"fa fa-heart\"></i></h2>";
								//Show Products
							?>
						</div>
						<!-- /row -->
					</div>
					<!-- /STORE -->
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
