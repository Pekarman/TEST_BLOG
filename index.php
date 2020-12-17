<?php  
require "includes/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $config['title']; ?></title>

	<!-- Bootstrap Grid -->
	<link rel="stylesheet" type="text/css" href="/media/assets/bootstrap-grid-only/css/grid12.css">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

	<!-- Custom -->
	<link rel="stylesheet" type="text/css" href="/media/css/style.css">
</head>
<body>

	<div id="wrapper">

		<?php
			if(isset($_POST['register'])){
				$nickname = $_POST['nickname'];
				$login = $_POST['login'];
				$email = $_POST['email'];
				$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

				//echo $nickname.$login.$email.$password.'<h1>';
				
				$result = mysqli_query($connection,"SELECT * FROM `users` WHERE `login` = '$login' LIMIT 1");
				
				$row_count = (int) mysqli_num_rows($result);						

				if($row_count == 1){
					echo 'Есть совпадение логина - ' ;
					echo '<a href = pages/reg.php>Вернуться на страницу регистрации</a>';
				} else {

					$q = mysqli_query($connection,"INSERT INTO `users` (`nickname`, `login`, `email`, `password`) VALUES ('$nickname', '$login', '$email', '$password')");

					if($q){
						echo 'Пользователь зарегистрирован';
					}					
				}
			}

			if(isset($_POST['auth'])){
				$login = $_POST['login'];
				$password = $_POST['password'];

				$user = mysqli_query($connection,"SELECT * FROM `users` WHERE `login` = '$login' LIMIT 1 ");

				if($user){

					$pass = mysqli_fetch_assoc($user);
					//echo $pass['password'];
					if(password_verify($password, $pass['password'])){

						//session_start();
						$_SESSION['islogin'] = true;
						$_SESSION['user'] = $pass['login'];
						echo 'Login success';
					}
					
				} else {
				 $err = mysqli_error($connection);
				 echo $err;
				}

			}
		?>

		<?php include "includes/header.php"; ?>
		
		<div id="content">
			<div class="container">
				<div class="row">
					<section class="content__left col-md-8">
						<div class="block">
							<a href="/articles.php">Все записи</a>
							<h3>Новейшее_в_блоге</h3>
							<div class="block__content">
								<div class="articles articles__horizontal">
									
									<?php
									$articles = mysqli_query($connection,"SELECT * FROM `articles` ORDER BY `id` DESC LIMIT 10");
									
									while( $art = mysqli_fetch_assoc($articles))
									{
										?>
										<article class="article">
											<div class="article__image" style="background-image: url(/static/images/<?php echo $art['image']; ?>);"></div>
											<div class="article__info">
												<a href="/article.php?id=<?php echo $art['id']; ?>"><?php echo $art['title']; ?></a>
												<div class="article__info__meta">
													<?php
													$art_cat = false;
													foreach($categories as $cat){
														if($cat['id']==$art['categorie_id'])
														{
															$art_cat = $cat;
															break;
														}
													}
													?>
													<small>Категория: <a href="/articles.php?categorie=<?php echo $art_cat['id']; ?>"><?php echo $art_cat['title']; ?></a></small>
												</div>
												<div class="article__info__preview"><?php echo mb_substr( strip_tags($art['text']), 0, 100, 'utf-8'). ' ...'; ?></div>
											</div>
										</article>
										<?php
									}
									?>

								</div>
							</div>
						</div>

						<div class="block">
							<a href="/articles.php?categorie=4">Все записи</a>
							<h3>Безопасность [Новейшее]</h3>
							<div class="block__content">
								<div class="articles articles__horizontal">

									<?php
									$articles = mysqli_query($connection,"SELECT * FROM `articles` WHERE `categorie_id` = 4 ORDER BY `id` DESC LIMIT 10");
									
									while( $art = mysqli_fetch_assoc($articles))
									{
										?>
										<article class="article">
											<div class="article__image" style="background-image: url(/static/images/<?php echo $art['image']; ?>);"></div>
											<div class="article__info">
												<a href="/article.php?id=<?php echo $art['id']; ?>"><?php echo $art['title']; ?></a>
												<div class="article__info__meta">
													<?php
													$art_cat = false;
													foreach($categories as $cat){
														if($cat['id']==$art['categorie_id'])
														{
															$art_cat = $cat;
															break;
														}
													}
													?>
													<small>Категория: <a href="/articles.php?categorie=<?php echo $art_cat['id']; ?>"><?php echo $art_cat['title']; ?></a></small>
												</div>
												<div class="article__info__preview"><?php echo mb_substr( strip_tags($art['text']), 0, 100, 'utf-8'). ' ...'; ?></div>
											</div>
										</article>
										<?php
									}
									?>

								</div>
							</div>
						</div>

						<div class="block">
							<a href="/articles.php?categorie=1">Все записи</a>
							<h3>Программирование [Новейшее]</h3>
							<div class="block__content">
								<div class="articles articles__horizontal">

									<?php
									$articles = mysqli_query($connection,"SELECT * FROM `articles` WHERE `categorie_id` = 1 ORDER BY `id` DESC LIMIT 10");
									
									while( $art = mysqli_fetch_assoc($articles))
									{
										?>
										<article class="article">
											<div class="article__image" style="background-image: url(/static/images/<?php echo $art['image']; ?>);"></div>
											<div class="article__info">
												<a href="/article.php?id=<?php echo $art['id']; ?>"><?php echo $art['title']; ?></a>
												<div class="article__info__meta">
													<?php
													$art_cat = false;
													foreach($categories as $cat){
														if($cat['id']==$art['categorie_id'])
														{
															$art_cat = $cat;
															break;
														}
													}
													?>
													<small>Категория: <a href="/articles.php?categorie=<?php echo $art_cat['id']; ?>"><?php echo $art_cat['title']; ?></a></small>
												</div>
												<div class="article__info__preview"><?php echo mb_substr( strip_tags($art['text']), 0, 100, 'utf-8'). ' ...'; ?></div>
											</div>
										</article>
										<?php
									}
									?>

								</div>
							</div>
						</div>
					</section>
					<section class="content__right col-md-4">
						<?php include "includes/sidebar.php"; ?> 
					</section>
				</div>
			</div>
		</div>

		<?php include "includes/footer.php"; ?>

	</div>

</body>
</html>