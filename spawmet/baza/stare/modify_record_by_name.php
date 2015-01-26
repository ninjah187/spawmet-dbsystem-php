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
					<a href="modyfikuj_po_nazwie.php"><span class="menu_button">Spróbuj jeszcze raz</span></a>
				</div>';
			} else {
				mysql_connect('localhost', 'root', '');
				@mysql_select_db('spawmet_baza') or die("Błąd połączenia z bazą danych!");
				$x = getRecordIdByName();
				if($x != '') {
					$record = mysql_query('SELECT * FROM czesci WHERE id_czesci = '.$x);
					$nazwa = mysql_result($record, 0, "nazwa");
					$ilosc = mysql_result($record, 0, "ilosc");
					echo '
					<h2>Podaj nowe dane:</h2>
					<form action="modify.php" method="POST" class="form_login" style="position: relative; left: 350px; top: 0px;">
						<span style="color: white;">Id:</span> <input type=text name=id style="position: relative; left: 44px;" value='.$x.' readonly="readonly"><br>
						<span style="position: relative; top: 5px;"><span style="color: white;">Nazwa:</span> <input type=text name=name style="position: relative; left: 8px" value="'.$nazwa.'"></span><br>
						<span style="position: relative; top: 10px;"><span style="color: white;">Ilość:</span> <input type=text name=amount style="position: relative; left: 24px" value='.$ilosc.'></span><br>
						<input type=submit name=accept value="Gotowe" style="position: relative; left: 95px; top: 15px;">
					</form>
					';
					echo '
					<div id="menu" style="height: 42px; position: relative; top: 25px;">
						<a href="baza.php"><span class="menu_button">Powrót</span></a>
					</div>
					';
				} else {
					echo '<h2>W bazie nie ma rekordu o podanej nazwie!</h2>
					<div id="menu" style="height: 42px;">
						<a href="baza.php"><span class="menu_button">Powrót do strony głównej</span></a>
						<a href="modyfikuj_po_nazwie.php"><span class="menu_button">Spróbuj jeszcze raz</span></a>
					</div>';
				}
				mysql_close();
			}
		?>
</div>
</body>
</html>