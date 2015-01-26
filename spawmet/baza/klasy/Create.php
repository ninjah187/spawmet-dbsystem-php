<?php
	class Create {
		public static function backButton($lastPage) {
			echo '
				<a href="'.$lastPage.'">
					<div style="position: relative; left: -110px;"><div id="back_button"></div></div>
				</a>
			';
		}
	}
?>