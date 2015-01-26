<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Dostawy</title>
	<script type="text/javascript" src="options.js"></script>
</head>
<body>
<div class="baza_bg">
	<?php
		include 'klasy/Create.php';
		Create::backButton($_GET['lastPage']);
	?>
	<h1 style="text-align: center;">RAPORT</h1>
	<p style="text-align: center;">Data w formacie rrrr-mm-dd</p>
	<div class="window">
		<form action="dostawy_show_raport.php?lastPage=dostawy.php" method="POST" class="form">
			<div id="inputs">
				<input type=text name=dataod><br />
				<input type=text name=datado><br />
				<input type=submit name=accept value="Gotowe">
			</div>
			<div id="inputs_names">
				<div id="inputs_text">
					<div class="inputs_name">Od:</div>
					<div class="inputs_name">Do:</div>
				</div>
			</div>
		</form>
	</div>
</div>
</body>
</html>