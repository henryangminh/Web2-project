<!DOCTYPE html>
<?php
	include('php/sessionAdmin.php');
	include('php/sessionUsr.php');
?>
<html lang="vi">
<?php
	ob_start();
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
				<div class="col-md-6">
                    <form name="signinform" class="clearfix" method="POST" action='admin-add-usr.php' onsubmit="return check_SigninAdmin()";>
                    	<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Tạo tài khoản cho admin </h4>
							</div>
							<div class="form-group">
                            	<div class="error">
                                    <p id="wrongEmail" style="color:red; font-style:italic; display:none;" >*Nhập sai email*</p>
									<p id="nullEmail" style="color:red; font-style:italic; display:none;" >*Chưa nhập email*</p>
									<p id="existEmail" style="color:red; font-style:italic; display:none;" >*Email đã được đăng ký, đã có tài khoản, hãy đăng nhập*</p>
								</div>
								<?php
									if(isset($_POST['submitsignin']))
										echo "<input class='input' type='text' name='email' placeholder='Nhập Email' value='".$_POST['email']."'>";
									else
										echo "<input class='input' type='text' name='email' placeholder='Nhập Email'>";
								?>
							</div>
                            <div class="form-group">
                            	<div class="error">
                                	<p id="wrongPassword" style="color:red; font-style:italic; display:none;" >*Mật khẩu phải từ 8 ký tự trở lên*</p>
									<p id="nullPassword" style="color:red; font-style:italic; display:none;" >*Chưa nhập mật khẩu*</p>
								</div>
								<?php
									if(isset($_POST['submitsignin']))
										echo "<input class='input' type='password' name='pass' placeholder='Nhập Mật Khẩu' value='".$_POST['pass']."'>";
									else
										echo "<input class='input' type='password' name='pass' placeholder='Nhập Mật Khẩu'>";
								?>
							</div>
                            <div class="form-group">
                            	<div class="error">
                                	<p id="wrongRepassword" style="color:red; font-style:italic; display:none;" >*Nhập lại mật khẩu không khớp*</p>
								</div>
								<?php
									if(isset($_POST['submitsignin']))
										echo "<input class='input' type='password' name='repass' placeholder='Nhập Lại Mật Khẩu' value='".$_POST['repass']."'>";
									else
										echo "<input class='input' type='password' name='repass' placeholder='Nhập Lại Mật Khẩu'>";
								?>
							</div>
                            <div class="form-group">
                            	<div class="error">
									<p id="nullFullname" style="color:red; font-style:italic; display:none;" >*Chưa nhập họ và tên*</p>
									<p id="strangeFullname" style="color:red; font-style:italic; display:none;" >*Họ và tên không được có ký tự lạ*</p>
									<p id="numIDAdmin" style="color:red; font-style:italic; display:none;" >*Họ và tên không được có chữ số*</p>
								</div>
								<?php
									if(isset($_POST['submitsignin']))
										echo "<input class='input' type='text' name='fullname' placeholder='Nhập Họ Và Tên' value='".$_POST['fullname']."'>";
									else
										echo "<input class='input' type='text' name='fullname' placeholder='Nhập Họ Và Tên'>";
								?>
							</div>
                            <div class="form-group">
                            	<div class="error">
                                	<p id="wrongPhonenumber" style="color:red; font-style:italic; display:none;" >*Số điện thoại không phù hợp*</p>
									<p id="nullPhonenumber" style="color:red; font-style:italic; display:none;" >*Chưa nhập số điện thoại*</p>
								</div>
								<?php
									if(isset($_POST['submitsignin']))
										echo "<input class='input' type='text' name='phone' placeholder='Nhập Số Điện Thoại' value='".$_POST['phone']."'>";
									else
										echo "<input class='input' type='text' name='phone' placeholder='Nhập Số Điện Thoại'>";
								?>
							</div>
                            <div class="form-group">
                            	<div class="error">
                                	<p id="wrongAddress" style="color:red; font-style:italic; display:none;" >*Địa chỉ không phù hợp*</p>
									<p id="nullAddress" style="color:red; font-style:italic; display:none;" >*Chưa nhập địa chỉ*</p>
								</div>
								<?php
									if(isset($_POST['submitsignin']))
										echo "<input class='input' type='text' name='address' placeholder='Nhập Địa Chỉ' value='".$_POST['address']."'>";
									else
										echo "<input class='input' type='text' name='address' placeholder='Nhập Địa Chỉ'>";
								?>
							</div>
							<div class="form-group">
                            	<div class="error">
									<p id="nullAuth" style="color:red; font-style:italic; display:none;" >*Chưa chọn quyền*</p>
									<p>Quyền</p>
								</div>
								<?php
									require_once('../DataProvider.php');
									$Auth="";
									if(isset($_POST['submitsignin']))
										$Auth=$_POST['slcAuth'];
									$sql="SELECT * FROM AuthenticationUsr";
									$rs=DataProvider::executeQuery($sql);
									echo "<select name='slcAuth'>";
									if($Auth="")
										echo "<option value='' selected></option>";
									else
										echo "<option value=''></option>";
									while($row=mysqli_fetch_array($rs,MYSQLI_BOTH))
									{
										if($row['Authentication']==$Auth)
											echo "<option value='".$row['Authentication']."' selected>".$row['AuthenticationName']."</option>";
										else
											echo "<option value='".$row['Authentication']."' >".$row['AuthenticationName']."</option>";
									}
									echo "</select>";
								?>
							</div>

                            <div align="center" class="form-group">
                            	<input class="primary-btn register" type="reset" name="resetsignin" value="làm mới">
								<input class="primary-btn register" type="submit" name="submitsignin" value="đăng ký">
							</div>
                         </div>
					</form>
                </div>	
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
	</div>
	<!-- /section -->

	<?php
		require_once('../DataProvider.php');

		if(isset($_POST['submitsignin']))
		{
			$email=$_POST['email'];
			$passwd=$_POST['pass'];
			$passwd=sha1($passwd);
			$fullname=$_POST['fullname'];
			$phone=$_POST['phone'];
			$address=$_POST['address'];
			$auth=$_POST['slcAuth'];
			$sql="SELECT * FROM Usr WHERE Email='$email'";
			$rs=DataProvider::executeQuery($sql);
			if(mysqli_num_rows($rs)==1)
				echo "<script> document.getElementById('existEmail').style.display='block'</script>";
			else
			{
				$sql="INSERT INTO Usr (Email, Passwd, UsrName, PhoneNo, Address, Blocked, Authentication) VALUES ('$email', '$passwd', '$fullname', '$phone', '$address', '0', '$auth')";
				DataProvider::executeQuery($sql);
				header("Location: index.php");
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
    <script src="../js/extrafunction.js"></script>

</body>

</html>
