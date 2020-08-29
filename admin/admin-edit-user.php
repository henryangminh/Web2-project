<!DOCTYPE html>
<?php
	ob_start();
?>
<?php
	include('php/sessionAdmin.php');
	include('php/sessionUsr.php');
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

	<?php include('php/navigationUsr.php') ?>

	<!-- section -->
	<div class="section">
		<!-- container -->
		<div class="container">
			<!-- row -->
			<div class="row">
				<!-- MAIN -->
				<?php
					require_once('../DataProvider.php');
					if(isset($_POST['btnUserSubmit']))
					{
						$sql="SELECT * FROM Usr INNER JOIN AuthenticationUsr WHERE Usr.Authentication=AuthenticationUsr.Authentication AND Email='".$_POST['txtEmail']."'";
						$rs = DataProvider::executeQuery($sql);
						$row = mysqli_fetch_array($rs,MYSQLI_BOTH);
					}
				?>
				<div id="main" class="col-md-12">
					<form id='editUser' name='editUser' action='adminUser.php' method='POST' onsubmit='return true'>
						<span id='lblNULL' style='color:red; display:none;'>*: Chưa nhập/Chưa chọn</span>
						<span class='text-uppercase'>Email: </span>
						<?php
							echo "<input type='hidden' name='txtEmail' id='txtEmail' value='".$row['Email']."'>";
							echo "<span>".$row['Email']."</span>";
						?>
						<br><br>

						<span class='text-uppercase'>Tên người dùng: </span>
						<?php
							echo "<input type='text' name='txtUsrName' id='txtUsrName' value='".$row['UsrName']."'>";
						?>
						<br><br>

						<span class='text-uppercase'>Điện thoại: </span>
						<?php
							echo "<input type='text' name='txtPhoneNo' id='txtPhoneNo' value='".$row['PhoneNo']."'>";
						?>
						<br><br>

						<span class='text-uppercase'>Địa Chỉ: </span>
						<?php
							echo "<input type='text' name='txtAddress' id='txtAddress' style='width:50%;' value='".$row['Address']."'>";
						?>
						<br><br>

						<span class='text-uppercase'>Trạng Thái: </span>
						<select name="slcBlocked" id='slcBlocked'>
						<?php
							$blocked=array("Bình Thường","Bị Khóa");
							$BlockedDB=$row['Blocked'];
							if($BlockedDB==0)
								$BlockedDB="Bình Thường";
							else
								$BlockedDB="Bị Khóa";
							$i=0;
							foreach ($blocked as $Blocked)
							if($BlockedDB==$Blocked)
								{echo "<option value='$i' selected>$Blocked</option>"; $i++;}
							else
								{echo "<option value='$i'>$Blocked</option>"; $i++;}
						?>
						</select>
						<br><br>

						<span class='text-uppercase'>Quyền: </span>
						<select name="slcAuthentication" id='slcAuthentication'>
						<?php
							$sql="SELECT * FROM AuthenticationUsr";
							$rs = DataProvider::executeQuery($sql);
							$Auth=$row['Authentication'];
							while($rowAuth=mysqli_fetch_array($rs,MYSQLI_BOTH))
							{
								$rowAuthentication=$rowAuth['Authentication'];
								if($Auth==$rowAuthentication)
									echo "<option value='$rowAuthentication' selected>".$rowAuth['AuthenticationName']."</option>";
								else
									echo "<option value='$rowAuthentication'>".$rowAuth['AuthenticationName']."</option>";
							}
						?>
						</select>
						<br><br>

						<input name='btnEditUsr' type='submit' value='Sửa User'>
						<input type='reset' value='Làm lại'>
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
