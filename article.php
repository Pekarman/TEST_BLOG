<?php 
include "includes/config.php";
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

		<?php include "includes/header.php"; 
		
		
		if(isset($_POST['do_post']))
		{
			mysqli_query($connection,"INSERT INTO `comments` (`author`,`nickname`,`email`,`text`,`pubdate`,`articles_id`)
				VALUES ('".$_POST['name']."','".$_POST['nickname']."','".$_POST['email']."','".$_POST['text']."',
				NOW(),'".$_GET['id']."')");
		}
		
		mysqli_query($connection,"UPDATE `articles` SET `views` = `views` + 1 WHERE `id` = " . (int) $_GET['id'] );
		$article = mysqli_query($connection, "SELECT * FROM `articles` WHERE `id` = " . (int) $_GET['id']);
		if(mysqli_num_rows($article) <= 0)
		{
			?>
			<div id="content">
				<div class="container">
					<div class="row">
						<section class="content__left col-md-8">
							<div class="block">
								
								<h3>Статья не найдена</h3>
								<div class="block__content">
									<div class="full-text">
										Запрашиваемая вами статья не найдена
									</div>
								</div>
							</div>
						</section>
					</div>
				</div>
			</div>
			<?php
		} else 
		{
			$art = mysqli_fetch_assoc($article);
			
			?>
			<div id="content">
				<div class="container">
					<div class="row">
						<section class="content__left col-md-8">
							<div class="block">
								<a><?php echo $art['views']; ?> просмотров</a>
								<h3><?php echo $art['title']; ?></h3>
								<div class="block__content">
									<img src="static/images/<?php echo $art['image']; ?>" style="max-width: 100%;">
									<div class="full-text">
										<?php echo $art['text']; ?>
									</div>
								</div>
							</div>
							
							<div class="block">
								<a href="#comment-add-form">Добавить свой</a>
								<h3>Комментарии</h3>
								<div class="block__content">
									<div class="articles articles__vertical">

										<?php
										$comments = mysqli_query($connection,"SELECT * FROM `comments` WHERE `articles_id` = " . (int) $art['id'] . " ORDER BY `id` DESC");
										if(mysqli_num_rows($comments) <=0)
										{
											?> Комментариев нет <?php
										} else {
											while( $com = mysqli_fetch_assoc($comments))
											{
												?>
												<article class="article">
													<div class="article__image" style="background-image: url(https://www.gravatar.com/avatar/<?php echo md5($com['email']); ?>?s=125);"></div>
													<div class="article__info">
														<a href="/article.php?id=<?php echo $com['articles_id']; ?>"><?php echo $com['author']; ?></a> 
														<div class="article__info__meta"></div>                   
														<div class="article__info__preview"><?php echo $com['text']; ?></div>
													</div>
												</article>
												<?php
											}
										}

										?>
										
									</div>
								</div>
							</div>

							<div class="block" id="comment-add-form">                     
								<h3>Добавить комментарий</h3>
								<div class="block__content">
									<form class="form" method="POST" action="/article.php?id=<?php echo $_GET['id']; ?> #comment-add-form">

										<?php
										if( isset($_POST['do_post']))
										{

											echo '<span style="color: green;font-weight: bold;margin-bottom: 10px;display: block">' . 'комментарий добавлен'  . '</span>' ;
											
										}
										?>
										<div class="form__group">
											<div class="row">
												<div class="col-md-4">
													<input type="text" class="form__control" required="" name="name" placeholder="Имя" value="<?php echo $_POST['name'] ?>">
												</div>
												<div class="col-md-4">
													<input type="text" class="form__control" required="" name="nickname" placeholder="Никнейм" value="<?php echo $_POST['nickname'] ?>">
												</div>
												<div class="col-md-4">
													<input type="text" class="form__control" required="" name="email" placeholder="Имейл" value="<?php echo $_POST['email'] ?>">
												</div>
											</div>
										</div>
										<div class="form__group">
											<textarea name="text" class="form__control" required="" placeholder="Текст комментария ..." ></textarea>
										</div>
										<div class="form__group">
											<input type="submit" class="form__control" name="do_post" value="Добавить комментарий">
										</div>
									</form>
								</div>
							</div>

						</section>
						
						<section class="content__right col-md-4">
							<?php include "includes/sidebar.php"; ?> 
						</section>

					</div>
				</div>
			</div>
			<?php
		}
		?>


		<?php include "includes/footer.php"; ?>

	</div>

</body>
</html>