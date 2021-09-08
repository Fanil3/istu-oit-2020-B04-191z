<?php
	require_once 'controller.php';

	function ShowPage($page)
	{
		$link = ConnectToDB();
		
		switch( $page ) {
			case 'main':
				$pageId = 1;
				break;
			case 'test':
				$pageId = 2;
				break;
			default:
				$pageId = 1;
				break;
		}
		
		$result = mysqli_query($link, "SELECT * FROM `articles` WHERE `id_articles`=".$pageId);
		$row = mysqli_fetch_array($result);
		$title = $row['title_articles'];
		$text = $row['text_articles'];
		$img = $row['img_articles'];
	
?>

<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link rel="stylesheet" type="text/css" href="style.css" /> 
		<title>Магазин электроники</title>
		<header>
			<nav>
				<div class="header">
					<ul class="menu">
						<li class="logoBlock">
							<a href="index.html" class="logo"><img src="computer.png" alt=""></a>
							<a href="index.html" class="logoName">Магазин электроники</a>
						</li>
						<?php
							$result = mysqli_query($link, "SELECT * FROM `menu`");
							while ($row = mysqli_fetch_array($result))
							{
								echo '<li class="menuItem"><a href="'.$row['href'].'">'.$row['item'].'</a></li>';
							}
						?>
					</ul>
				</div>
				<div class="mobileMenu">
					<input type="checkbox" id="hmt" class="hidden-menu-ticker">
					<label class="btn-menu" for="hmt">
						<span class="first"></span>
						<span class="second"></span>
						<span class="third"></span>
					</label>
					<ul class="hidden-menu">
					<?php
						$result = mysqli_query($link, "SELECT * FROM `menu`");
						while ($row = mysqli_fetch_array($result))
						{
							echo '<li><a href="'.$row['href'].'"></a>'.$row['item'].'</li>';
						}
					?>
					</ul>
				</div>
			</nav>
		</header>
	</head>
	<body>
		<div class="container">
			<article>
				<h1><?php echo $title; ?></h1>
				<p align="justify"><img src="
					<?php echo $img; ?>
				" width="400" height="200" alt="Иллюстрация" align="right" vspace="5" hspace="5"> 
					<?php echo $text; ?>
				</p> 
			</article>
			<div>
				<p><b>Комментарии</b></p>
				<?php
					$result = mysqli_query($link, "SELECT * FROM `comments` where `pageId` = ".$pageId);
					
					if (mysqli_num_rows($result) > 0)
					{
						while ($row = mysqli_fetch_array($result))
						{
							echo '<p><b>'.$row['author'].' ('.$row['date'].')</b></p><p>'.$row['text'].'</p>';
						}
					}
					else
					{
						echo "Комментариев еще нет.";
					}
				?>
			</div>
			<form name="comment" action="sendComment.php" method="post">
                    <p>
                        Оставить комментарий
                    </p>
                    <p><input type="text" name="name" placeholder="Имя" required></p>
                    <p><textarea name="text" placeholder="Комментарий" required></textarea></p>

                    <p><img src="/captcha.php" width="200" height="50" border="1" alt="captcha"></p>
                    <p><input type="text" size="15" maxlength="5" name="captcha" placeholder="Введите капчу" value=""></p>
                    <p>
                        <input type="hidden" name="pageId" value="<?php echo "$pageId"?>">
                        <input type="submit" value="Отправить">
                    </p>
                </form>
		</div>
		<footer>
			<div class="footer">
				<p>Copyright 2021</p>
			</div>
		</footer>
	</body>
</html>

<?php
	}
?>