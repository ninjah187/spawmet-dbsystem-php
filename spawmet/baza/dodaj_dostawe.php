<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Dodaj dostawę</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton($_GET['lastPage']);
	?>
	<h1 style="text-align: center;">DODAJ DOSTAWĘ</h1>
	<div class="window">
		<form action="add_supply.php?lastPage=dostawy.php" method="POST" class="form">
			<div id="inputs">
				<input type=text name=data value=<?php echo '"'.date('Y-m-d').'"'; ?>><br>
				<input type=text name=dostawca><br>
				<!--<input type=text name=czesc><br>-->
				<select name=czesc>
				<?php
					include 'klasy/Table.php';
					$t = new Table('SELECT nazwa FROM czesci ORDER BY nazwa');
					for($i = 0; $i < $t->numberOfRows; $i++) {
						echo '<option>'.$t->getRecord($t->table, $i, "nazwa").'</option>';
					}
					$t->close();
				?>
				</select></br>
				<input type=text name=ilosc><br>
				<input type=submit name=accept value="Gotowe">
			</div>
			<div id="inputs_names">
				<div id="inputs_text">
					<div class="inputs_name">Data odbioru:</div>
					<div class="inputs_name">Dostawca:</div>
					<div class="inputs_name">Część:</div>
					<div class="inputs_name">Ilość:</div>
				</div>
			</div>
		</form>
	</div>
</div>
</body>
</html>