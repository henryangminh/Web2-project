	<!DOCTYPE html>
<?php
	session_start();
	if(!isset($_SESSION['isLogin']))
		$_SESSION['isLogin']=0;
	if($_SESSION['isLogin']==1)
		header("Location: index.php");
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
	
	<link type="text/css" rel="stylesheet" href="css/extrastyle.css" />
	<script src='js/extrafunction.js'></script>
	
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
				<li class="active">Đăng nhập & đăng ký</li>
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
				<div class="col-md-6">
                    <form name="loginform" action='signin.php' method="POST" class="clearfix" onsubmit="return check_Login();" >
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Đăng nhập</h3>
							</div>
							<div class="form-group">
								<div class="error">
                                    <p id="wrongID" style="color:red; font-style:italic; display:none;" >*Nhập sai email*</p>
									<p id="nullID" style="color:red; font-style:italic; display:none;" >*Chưa nhập email*</p>
								</div>
								<input class="input" type="text" name="email" placeholder="Nhập email của bạn">
							</div>
							<div class="form-group">
								<div class="error">
									<p id="nullIDpass" style="color:red; font-style:italic; display:none;" >*Chưa nhập mật khẩu*</p>
								</div>
								<input class="input" type="password" name="pass" placeholder="Nhập password">
								<div class="error">
								<p id="wrongIDpass" style="color:red; font-style:italic; display:none;" >*Mật khẩu không đúng hoặc tài khoản không tồn tại*</p>
								</div>
							</div>
							<div align="center" class="form-group">
								<input class="primary-btn login" type="submit" name="submitlogin" value="đăng nhập">
							</div>
						</div>
                    </form>
				</div>
				<div class="col-md-6">
                    <form name="signinform" class="clearfix" method="POST" action='signin.php' onsubmit="return check_Signin()";>
                    	<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Chưa có tài khoản? Tạo một cái nhé! </h4>
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
									<p id="numID" style="color: red; font-style:italic; display:none;" >*Họ và tên không được có chữ số*</p>
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
		require_once('DataProvider.php');
		if(isset($_POST['submitlogin']))
		{
			$email=$_POST['email'];
			$passwd=$_POST['pass'];
			$passwd=sha1($passwd);
			$sql="SELECT * FROM Usr WHERE Email='$email' AND Passwd='$passwd' AND Blocked=0";
			$rs=DataProvider::executeQuery($sql);
			if(mysqli_num_rows($rs)==1)
			{
				$row=mysqli_fetch_array($rs,MYSQLI_BOTH);
				$_SESSION['isLogin']=1;
				$_SESSION['username']=$email;
				$_SESSION['Authentication']=$row['Authentication'];
				header("Location: index.php");
			}
			else
			{
				echo "<script> document.getElementById('wrongIDpass').style.display='block'</script>";
			}
		}

		if(isset($_POST['submitsignin']))
		{
			$email=$_POST['email'];
			$passwd=$_POST['pass'];
			$passwd=sha1($passwd);
			$fullname=$_POST['fullname'];
			$phone=$_POST['phone'];
			$address=$_POST['address'];
			$sql="SELECT * FROM Usr WHERE Email='$email'";
			$rs=DataProvider::executeQuery($sql);
			if(mysqli_num_rows($rs)==1)
				echo "<script> document.getElementById('existEmail').style.display='block'</script>";
			else
			{
				$sql="INSERT INTO Usr (Email, Passwd, UsrName, PhoneNo, Address, Blocked, Authentication) VALUES ('$email', '$passwd', '$fullname', '$phone', '$address', '0', 'Usr')";
				DataProvider::executeQuery($sql);
				echo "<script>alert('Cám ơn bạn $fullname đã đăng ký tài khoản YạMẹ. Chúc bạn có một ngày mua sắm được nhiều hàng')</script>";
				$_SESSION['isLogin']=1;
				$_SESSION['username']=$email;
				$_SESSION['Authentication']='Usr';
				header("Location: index.php");
			}
		}
	?>

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
						<ul class="list-links">
							<li><a href="#">Đăng nhập</a></li>
							<li><a href="#">Tạo tài khoản</a></li>
						</ul>
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
    <script src="js/extrafunction.js"></script>

</body>

</html>
