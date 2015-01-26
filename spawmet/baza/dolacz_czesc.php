<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Dołącz część do zestawu</title>
</head>
<body>
<div class="baza_bg">
	<h2>DOŁĄCZ CZĘŚĆ</h2>
	<?php
		include 'klasy/Create.php';
		Create::backButton($_GET['lastPage']);
	?>
	<?php
		include 'klasy/klasa_zestawy_czesci.php';
		$z = new ZestawyCzesci('
			SELECT zestawy_czesci.nr_zestawu AS "Numer zestawu",
			maszyny.nazwa AS "Maszyna",
			czesci.nazwa AS "Część",
			zestawy_czesci.ilosc_potrzebnych_cz AS "Potrzebna ilość"
			FROM zestawy_czesci, maszyny, czesci
			WHERE zestawy_czesci.maszyna = maszyny.id_maszyna && zestawy_czesci.czesc = czesci.id_czesci
					&& zestawy_czesci.nr_zestawu = '.$_GET['setNumber']
		);
		$z->showTableWithoutOptions();
		$z->close();
	?>
	<div class="window">
		<form action="join_part.php?setNumber=<?php echo $_GET['setNumber']; ?>&lastPage=zestawy_czesci.php" method="POST" class="form">
			<div id="inputs">
				<select name=czesc>
				<?php
					//include 'klasy/klasa_czesci.php';
					$m = new Table('SELECT nazwa FROM czesci ORDER BY nazwa');
					for($i = 0; $i < $m->numberOfRows; $i++) {
						echo '<option>'.$m->getRecord($m->table, $i, "nazwa").'</option>';
					}
				?>
				</select><br />
				<input type=text name=iloscCzesci><br>
				<input type=submit name=accept value="Gotowe">
			</div>
			<div id="inputs_names">
				<div id="inputs_text">
					<span class="inputs_name">Część:</span><br />
					<span class="inputs_name">Potrzebna ilość:</span><br />
				</div>
			</div>
		</form>
	</div>
</div>
</body>
</html>