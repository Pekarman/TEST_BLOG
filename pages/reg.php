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
				
				<h1 align="center">Страница регистрации</h1>
				
					<form class="form" method="POST" action="/index.php" align="center">

						<div class="form__control">

							<input type="text" class="form__control" required="" name="nickname" placeholder="Nickname">

						</div>

						<div class="form__control">

							<input type="text" class="form__control" required="" name="login" placeholder="Login">

						</div>

						<div class="form__control">

							<input type="text" class="form__control" required="" name="email" placeholder="email">

						</div>

						<div class="form__control">

							<input type="text" class="form__control" required="" name="password" placeholder="Password">

						</div>

						<div class="form__group">
							<input type="submit" class="form__control" name="register" value="Регистрация">							
						</div>

						
					</form>

				</div>
				
			</div>		

		</div>

	</body>
	</html>