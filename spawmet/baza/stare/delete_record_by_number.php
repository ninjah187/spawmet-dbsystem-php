<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Strona</title>
</head>
<body>
<div class="baza_bg">
		<?php
			if(empty($_POST['nr'])) {
				echo '<h2>Nieprawidłowe dane.</h2>
				<div id="menu" style="height: 42px;">
					<a href="baza.php"><span class="menu_button">Powrót do strony głównej</span></a>
					<a href="usun_po_numerze.php"><span class="menu_button">Spróbuj jeszcze raz</span></a>
				</div>';
			} else {
				mysql_connect('localhost', 'root', '');
				@mysql_select_db('spawmet_baza') or die("Błąd połączenia z bazą danych");
				
				$nr = $_POST['nr'] - 1;
				
				$allRecords = mysql_query('SELECT * FROM czesci');
				$liczbaWierszy = mysql_numrows($allRecords);
				
				if($nr >= 0 && $nr < $liczbaWierszy) {
					$x = mysql_result($allRecords, $nr, "id_czesci");
					
					mysql_query('
						DELETE FROM czesci
						WHERE id_czesci = '.$x.'
					');
					
					echo '<h2>Rekord usunięty pomyślnie!</h2>
					<div id="menu" style="height: 42px;">
						<a href="baza.php"><span class="menu_button">Powrót do strony głównej</span></a>
						<a href="usun_po_numerze.php"><span class="menu_button">Usuń kolejny rekord</span></a>
					</div>';
					
				} else {
					echo '<h2>Nie ma takiego numeru!</h2>
					<div id="menu" style="height: 42px;">
						<a href="baza.php"><span class="menu_button">Powrót do strony głównej</span></a>
						<a href="usun_po_numerze.php"><span class="menu_button">Spróbuj jeszcze raz</span></a>
					</div>';
				}
				mysql_close();
			}
		?>
</div>
</body>
</html>