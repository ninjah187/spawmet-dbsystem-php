<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Strona</title>
</head>
<body>
<div class="baza_bg">
	<!--<div class="communicate_text">-->
		<?php
			function isNameUnique() {
				$allNames = mysql_query('SELECT nazwa FROM czesci');
				$liczbaWierszy = mysql_numrows($allNames);
				for($i = 0; $i < $liczbaWierszy; $i++) {
					if($_POST['nazwa'] == mysql_result($allNames, $i, "nazwa")) {
						return false;
					}
				}
				return true;
			}
		
			if(empty($_POST['nazwa']) || $_POST['ilosc'] == '') {
				echo '<h2>Nieprawidłowe dane.</h2>
				<div id="menu" style="height: 42px;">
					<a href="baza.php"><span class="menu_button">Powrót do strony głównej</span></a>
					<a href="dodaj.php"><span class="menu_button">Spróbuj jeszcze raz</span></a>
				</div>';
			} else {
				mysql_connect('localhost', 'root', '');
				@mysql_select_db('spawmet_baza') or die("Błąd połączenia z bazą danych!");
				
				if(isNameUnique()) {
					mysql_query('
						INSERT INTO czesci
						(`nazwa`, `ilosc`)
						VALUES
						("'.$_POST['nazwa'].'", "'.$_POST['ilosc'].'")
					');
					echo '<h2>Rekord dodany pomyślnie!</h2>
					<div id="menu" style="height: 42px;">
						<a href="baza.php" style="position: relative; top: 10px;"><span class="menu_button">Powrót do strony głównej</span></a>
						<a href="dodaj.php" style="position: relative; top: 10px;"><span class="menu_button">Dodaj kolejny rekord</span></a>
					</div>';
					mysql_close();
				} else {
					echo '
					<h2>Błąd! Istnieje już rekord o takiej nazwie!</h2>
					<div id="menu" style="height: 42px;">
						<a href="baza.php"><span class="menu_button">Powrót do strony głównej</span></a>
						<a href="dodaj.php"><span class="menu_button">Spróbuj jeszcze raz</span></a>
					</div>
					';
					mysql_close();
				}
			}
		?>
	<!--</div>-->
</div>
</body>
</html>