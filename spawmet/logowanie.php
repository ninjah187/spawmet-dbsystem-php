<html>
<head>
	<link rel="Stylesheet" type="text/css" href="style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Strona</title>
</head>
<body>
<div class="baza_bg">
		<?php
			if(empty($_POST['login']) || empty($_POST['pwd'])) {
				echo '<h2>Nieprawidłowe dane.</h2>
				<div id="menu" style="height: 42px;">
					<a href="index.php"><span class="menu_button">Spróbuj jeszcze raz</span></a>
				</div>';
			} else {
				if($_POST['login'] == "ninja" && $_POST['pwd'] == "pwd") {
					echo '<h2>Pomyślne logowanie!</h2>
					<div id="menu" style="height: 42px;">
						<a href="baza/menu.php"><span class="menu_button">Kontynuuj</span></a><br>
					</div>';
				} else echo '<h2>Nieprawidłowe dane.</h2>
				<div id="menu" style="height: 42px;">
					<a href="index.php"><span class="menu_button">Spróbuj jeszcze raz.</span></a><br>
				</div>';
			}
		?>
</div>
</body>
</html>