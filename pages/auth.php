<?php 
include "../includes/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $config['title'];  ?></title>

	<!-- Bootstrap Grid -->
	<link rel="stylesheet" type="text/css" href="/media/assets/bootstrap-grid-only/css/grid12.css">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

	<!-- Custom -->
	<link rel="stylesheet" type="text/css" href="/media/css/style.css">
</head>
<body>

	<div id="wrapper">	

		<div id="content">
			<div class="container">
				<div class="row">
					<h1 align="center">Страница входа</h1>
					<h1>
						<form class="form" method="POST" action="/index.php" align="center">

							<div class="container col-md-4">

								<div class="col-md-4">
								<input type="text" class="form__control" required="" name="name" placeholder="Login" value="<?php echo $_POST['name'] ?>">
								</div>
								
								
								<input type="text" class="form__control" required="" name="nickname" placeholder="Password" value="<?php echo $_POST['nickname'] ?>">


							</div>
							<div class="form__group">
								<input type="submit" class="form__control" name="do_post" value="Login">							
							</div>
							<div class="form__group">
								<a href="/pages/reg.php">Registration</a>
							</div>
						</form>

					</div>
				</div>
			</div>		

		</div>

	</body>
	</html>