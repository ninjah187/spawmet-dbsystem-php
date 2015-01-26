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
	<h1 style="text-align: center;">DODAJ ZAMÓWIENIE</h1>
	<div class="window">
		<form action="add_order.php?lastPage=zamowienia.php" method="POST" class="form">
			<div id="inputs">
				<select name=maszyna>
				<?php
					include 'klasy/klasa_maszyny.php';
					$m = new Maszyny('SELECT nazwa FROM maszyny');
					for($i = 0; $i < $m->numberOfRows; $i++) {
						echo '<option>'.$m->getMachineName($i).'</option>';
					}
				?>
				</select><br />
				<input type=text name=nazwa><br>
				<input type=text name=telefon><br>
				<input type=text name=email><br>
				<input type=text name=miejscowosc><br>
				<input type=text name=ulica><br>
				<input type=text name=kodPocztowy><br>
				<select name=wojewodztwo>
					<option>-</option>
					<option>dolnośląskie</option>
					<option>kujawsko-pomorskie</option>
					<option>lubelskie</option>
					<option>lubuskie</option>
					<option>łódzkie</option>
					<option>małopolskie</option>
					<option>mazowieckie</option>
					<option>opolskie</option>
					<option>podkarpackie</option>
					<option>podlaskie</option>
					<option>pomorskie</option>
					<option>śląskie</option>
					<option>świętokrzyskie</option>
					<option>warmińsko-mazurskie</option>
					<option>wielkopolskie</option>
					<option>zachodniopomorskie</option>
				</select><br />
				<input type=text name=uwagi style="width: 200px; height: 100px"><br>
				<input type=submit name=accept value="Gotowe">
			</div>
			<div id="inputs_names">
				<span class="inputs_name">Maszyna:</span><br />
				<span class="inputs_name">Nazwa:</span><br />
				<span class="inputs_name">Telefon:</span><br />
				<span class="inputs_name">Email:</span><br />
				<span class="inputs_name">Miejscowość:</span><br />
				<span class="inputs_name">Ulica:</span><br />
				<span class="inputs_name">Kod pocztowy:</span><br />
				<span class="inputs_name">Województwo:</span><br />
				<span class="inputs_name">Uwagi:</span><br />
			</div>
			
		</form>
	</div>
</div>
</body>
</html>