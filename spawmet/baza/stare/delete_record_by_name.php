<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Strona</title>
</head>
<body>
<div class="baza_bg">
		<?php
			function getRecordIdByName() {
				$allRecords = mysql_query('SELECT * FROM czesci');
				$liczbaWierszy = mysql_numrows($allRecords);
				$GLOBALS["x"] = '';
				for($i = 0; $i < $liczbaWierszy; $i++) {
					if($_POST['name'] == mysql_result($allRecords, $i, "nazwa")) {
						$GLOBALS["x"] = mysql_result($allRecords, $i, "id_czesci");
					}
				}
				return $GLOBALS["x"];
			}
		
			if(empty($_POST['name'])) {
				echo '<h2>Nieprawidłowe dane.</h2>
				<div id="menu" style="height: 42px;">
					<a href="baza.php"><span class="menu_button">Powrót do strony głównej</span></a>
					<a href="usun_po_nazwie.php"><span class="menu_button">Spróbuj jeszcze raz</span></a>
				</div>';
			} else {
				mysql_connect('localhost', 'root', '');
				@mysql_select_db('spawmet_baza') or die("Błąd połączenia z bazą danych!");
				$x = mysql_query('SELECT * FROM czesci WHERE nazwa = "'.$_POST['name'].'"');
				$x = getRecordIdByName();
				if($x != '') {
					mysql_query('
						DELETE FROM czesci
						WHERE id_czesci = '.$x.'
					');
					echo '<h2>Rekord usunięty pomyślnie!</h2>
					<div id="menu" style="height: 42px;">
						<a href="baza.php"><span class="menu_button">Powrót do strony głównej</span></a>
						<a href="usun_po_nazwie.php"><span class="menu_button">Usuń kolejny rekord</span></a>
					</div>';
				} else {
					echo '<h2>W bazie nie ma rekordu o podanej nazwie!</h2>
					<div id="menu" style="height: 42px;">
						<a href="baza.php"><span class="menu_button">Powrót do strony głównej</span></a>
						<a href="usun_po_nazwie.php"><span class="menu_button">Spróbuj jeszcze raz</span></a>
					</div>';
				}
				mysql_close();
			}
		?>
</div>
</body>
</html>