<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Strona</title>
</head>
<body>
<div class="baza_bg">
	<h2>Witaj w bazie danych!</h2>
	<!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Proin nibh augue, suscipit a, scelerisque sed, lacinia in, mi. Cras vel lorem. Etiam pellentesque aliquet tellus. Phasellus pharetra nulla ac diam. Quisque semper justo at risus. Donec venenatis, turpis vel hendrerit interdum, dui ligula ultricies purus, sed posuere libero dui id orci. Nam congue, pede vitae dapibus aliquet, elit magna vulputate arcu, vel tempus metus leo non est. Etiam sit amet lectus quis est congue mollis. Phasellus congue lacus eget neque. Phasellus ornare, ante vitae consectetuer consequat, purus sapien ultricies dolor, et mollis pede metus eget nisi. Praesent sodales velit quis augue. Cras suscipit, urna at aliquam rhoncus, urna quam viverra nisi, in interdum massa nibh nec erat.</p>-->
	
	<div id="menu">
		<a href="dodaj.php"><span class="menu_button">Dodaj</span></a>
		<a href="usun_po_nazwie.php"><span class="menu_button">Usuń po nazwie</span></a>
		<a href="usun_po_numerze.php"><span class="menu_button">Usuń po numerze</span></a>
		<a href="modyfikuj_po_nazwie.php"><span class="menu_button">Modyfikuj po nazwie</span></a>
		<a href="modyfikuj_po_numerze.php"><span class="menu_button">Modyfikuj po numerze</span></a>
		<a href="sortuj.php" style="position: relative; top: 25px;"><span class="menu_button">Wyświetl posortowane</span></a>
	</div>
	
	<?php
		mysql_connect('localhost', 'root', '');
		@mysql_select_db('spawmet_baza') or die("Błąd! Nie udało się wybrać bazy!");
		$allRecords = mysql_query("SELECT * FROM czesci");
		$liczbaWierszy = mysql_numrows($allRecords);
		echo '<table cellspacing="0">';
		echo '
			<tr class="table_header">
				<td>Nr</td> <td>id</td> <td>Nazwa</td> <td>Ilość</td>
			</tr>
		';
		for($i = 0; $i < $liczbaWierszy; $i++) {
			$id = mysql_result($allRecords, $i, "id_czesci");
			$nazwa = mysql_result($allRecords, $i, "nazwa");
			$ilosc = mysql_result($allRecords, $i, "ilosc");
			if($i % 20 == 0 && $i != 0) {
				echo '
					<tr class="table_header">
						<td>Nr</td> <td>id</td> <td>Nazwa</td> <td>Ilość</td>
					</tr>
				';
			}
			if($ilosc == 0) {
				echo '
					<tr style="background-color: #e0e0e0;">
						<td>'.($i + 1).'</td> <td>'.$id.'</td> <td>'.$nazwa.'</td> <td>'.$ilosc.'</td>
					</tr>
				';
			} else {
				echo '
					<tr>
						<td>'.($i + 1).'</td> <td>'.$id.'</td> <td>'.$nazwa.'</td> <td>'.$ilosc.'</td>
					</tr>
				';
			}
		}
		echo '</table>';
		mysql_close();
	?>
	
	<div id="menu">
		<a href="dodaj.php"><span class="menu_button">Dodaj</span></a>
		<a href="usun_po_nazwie.php"><span class="menu_button">Usuń po nazwie</span></a>
		<a href="usun_po_numerze.php"><span class="menu_button">Usuń po numerze</span></a>
		<a href="modyfikuj_po_nazwie.php"><span class="menu_button">Modyfikuj po nazwie</span></a>
		<a href="modyfikuj_po_numerze.php"><span class="menu_button">Modyfikuj po numerze</span></a>
		<a href="sortuj.php" style="position: relative; top: 25px;"><span class="menu_button">Wyświetl posortowane</span></a>
	</div>
</div>
</body>
</html>