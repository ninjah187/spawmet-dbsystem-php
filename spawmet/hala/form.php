<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Części</title>
</head>
<body>
<div class="baza_bg">
	<?php
		include '../baza/klasy/Create.php';
		Create::backButton($_GET['lastPage']);

		include '../baza/klasy/klasa_hala.php';
		$c = new Hala('
			SELECT nazwa AS "Nazwa", ilosc AS "Ilość" FROM czesci
			WHERE id_czesci = '.$_GET['partID'].'
		');
		if($_GET['raise'] == 0) {
			echo '<h2>Zmniejsz ilość:</h2>';
		} else {
			echo '<h2>Zwiększ ilość:</h2>';
		}
		$c->showTableWithoutOptions($_GET['partID']);
		//$c->editPartForm($_GET['partID']);
		$c->close();
	?>
	<div class="window">
		<form action="exec.php?partID=<?php echo $_GET['partID']; ?>&raise=<?php echo $_GET['raise'] ?>&lastPage=index.php" method="POST" class="form">
			<div id="inputs">
				<input type=text name=ilosc><br />
				<input type=submit name=accept value="Gotowe" style="margin-top: 10px;">
			</div>
			<div id="inputs_names">
				<div id="inputs_text">
					<div class="inputs_name">
					<?php
						if($_GET['raise'] == 0) {
							echo 'Zmniejsz o:';
						} else {
							echo 'Zwiększ o:';
						}
					?>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
</body>
</html>