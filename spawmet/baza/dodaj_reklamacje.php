<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Dodaj reklamację</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton($_GET['lastPage']);
	?>
	<h1 style="text-align: center;">DODAJ REKLAMACJĘ</h1>
	<div class="window">
		<form action="add_complaint.php?lastPage=reklamacje.php" method="POST" class="form">
			<div id="inputs">
				<input type=text name=klient><br />
				<input type=text name=adres><br />
				<input type=text name=uwagi><br />
				<input type=submit name=accept value="Gotowe">
			</div>
			<div id="inputs_names">
				<div id="inputs_text">
					<div class="inputs_name">Klient:</div>
					<div class="inputs_name">Adres:</div>
					<div class="inputs_name">Uwagi:</div>
				</div>
			</div>
		</form>
	</div>
</div>
</body>
</html>