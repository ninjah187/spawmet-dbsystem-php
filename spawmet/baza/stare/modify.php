<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Strona</title>
</head>
<body>
<div class="baza_bg" style="height: 200px;">
		<?php
			if(empty($_POST['name']) || $_POST['amount'] == '') {
				echo 'Musisz podać wszystkie wartości!<br>
				<a href="baza.php">Spróbuj jeszcze raz</a><br>';
			} else {
				mysql_connect('localhost', 'root', '');
				@mysql_select_db('spawmet_baza') or die("Błąd połączenia z bazą danych!");
				
				mysql_query('
					UPDATE czesci
					SET
						nazwa = "'.$_POST['name'].'",
						ilosc = '.$_POST['amount'].'
					WHERE id_czesci = '.$_POST['id'].'
				');
				
				echo '<h2>Rekord zmodyfikowany pomyślnie!</h2>
				<div id="menu" style="height: 42px;">
					<a href="baza.php" style="position: relative; top: 10px;"><span class="menu_button">Powrót do strony głównej</span></a>
					<a href="modyfikuj_po_nazwie.php" style="position: relative; top: 10px;"><span class="menu_button">Modyfikuj kolejny rekord po nazwie</span></a><br />
					<a href="modyfikuj_po_numerze.php" style="position: relative; top: 35px;"><span class="menu_button">Modyfikuj kolejny rekord po numerze</span></a>
				</div>';
				
				mysql_close();
			}
		?>
</div>
</body>
</html>