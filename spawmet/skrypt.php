<?php

	print "Twoje dane: <br><br>\n\n\t";
	for($i = 0; $i < 9; $i++) {
		$index = "f".$i;
		if(!empty($_GET[$index])) {
			echo "ok";
		}
	}

?>