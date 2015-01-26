<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Strona</title>
</head>
<body>
<div class="communicate">
	<div class="communicate_text">
		<?php
			if(empty($_POST['id'])) {
				echo 'Nieprawidłowe dane.<br>
				<a href="baza.php">Spróbuj jeszcze raz.</a><br>';
			} else {
				mysql_connect('localhost', 'root', '');
				@mysql_select_db('spawmet_baza') or die("Błąd połączenia z bazą danych!");
				$liczbaWierszy = mysql_numrows(mysql_query('SELECT * FROM czesci'));
				echo $liczbaWierszy;
				//if($_POST['id'] >= 1 && $_POST['id'] <= $liczbaWierszy) {
					mysql_query('
						DELETE FROM czesci
						WHERE id_czesci = '.$_POST['id'].'
					');
				/*} else {
					echo 'Nie ma takiego indeksu.<br>
					<a href="baza.php">Spróbuj jeszcze raz.</a><br>';
					mysql_close();
					return;
				}
				mysql_close();
				echo 'Rekord usunięty pomyślnie!<br>
				<a href="baza.php">Powrót</a>';*/
			}
		?>
	</div>
</div>
</body>
</html>