<html>
<head>
	<link rel="Stylesheet" type="text/css" href="../style.css" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<script type="text/javascript" src="../baza/options.js"></script>
	<title>Części</title>
</head>
<body>
<div class="baza_bg" style="padding-top: 20px;">
	<?php
		include '../baza/klasy/klasa_hala.php';
		$t = new Hala('
			SELECT id_czesci AS "id", nazwa AS "Nazwa", ilosc AS "Ilość"
			FROM czesci
			ORDER BY nazwa
		');
		$t->showTable();
		$t->close();
	?>
	<script type="text/javascript">
		var optsbtn = document.getElementsByClassName("options_button");
		for(var i = 0; i < optsbtn.length; i++) {
			optsbtn[i].style.width = "60px";
			optsbtn[i].style.height = "60px";
			//optsbtn[i].children[0].style.position = "relative";
			//optsbtn[i].children[0].style.width = "50px";
		}
	</script>
</div>
</body>
</html>