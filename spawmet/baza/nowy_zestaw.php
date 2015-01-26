<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Dodaj zamówienie</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton($_GET['lastPage']);
	?>
	<h1 style="text-align: center;">DODAJ ZESTAW CZĘŚCI</h1>
	<div class="window">
		<form action="add_set_of_parts.php?lastPage=zestawy_czesci.php" method="POST" class="form">
			<div id="inputs">
				<input type=text name=nrZestawu style="width: 50px"><br>
				<select name=maszyna>
				<?php
					include 'klasy/klasa_maszyny.php';
					$m = new Maszyny('SELECT nazwa FROM maszyny ORDER BY nazwa');
					for($i = 0; $i < $m->numberOfRows; $i++) {
						echo '<option>'.$m->getMachineName($i).'</option>';
					}
				?>
				</select><br />
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
				<span class="inputs_name">Nr zestawu:</span><br />
				<span class="inputs_name">Maszyna:</span><br />
				<span class="inputs_name">Część:</span><br />
				<span class="inputs_name">Potrzebna ilość:</span><br />
			</div>
			
		</form>
	</div>
</div>
</body>
</html>