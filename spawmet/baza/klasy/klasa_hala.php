<?php
	include 'Table.php';
	class Hala extends Table {
		
		function __construct($selectQuery) {
			Table::__construct($selectQuery);
		}
		
		function showTable() {
			echo '<table cellspacing="0">';
			for($i = 0; $i < $this->numberOfRows; $i++) {
				if($i % 30 == 0) {
					echo '<tr class="table_header">';
					echo '<td>Nr</td>';
					for($j = 0; $j < $this->numberOfFields; $j++) {
						//teraz zadajesz 2 zapytania do bazy o nazwę pola; rozważ zrobienie na początku tablicy z nazwami pól
						$field = DBManager::getFieldName($this->table, $j);
						if($field == 'id') {
							continue;
						}
						echo '<td>'.DBManager::getFieldName($this->table, $j).'</td>';
					}
					echo '<td>Opcje</td>';
					echo '</tr>';
				}
				echo '<tr>';
				echo '<td>'.($i + 1).'</td>';
				//$id; //ID maszyny
				$id;
				for($j = 0; $j < $this->numberOfFields; $j++) {
					$field = DBManager::getFieldName($this->table, $j);
					switch($field) {
						case 'id': {
							$id = DBManager::getRecord($this->table, $i, $field);
						} break;
						default: {
							$record = DBManager::getRecord($this->table, $i, $field);
							if($record == NULL) {
								$record = '-';
							}
							echo '<td>'.$record.'</td>';
						} break;
					}
				}
				
				echo '
				<td class="option_row">
					<div class="options_button" id="optionsButton'.$i.'" onclick="showOptions(\'optionsButton'.$i.'\')"
					style="background-image: url(button.gif);">
						<div class="options_list" style="left: 70px;">
							<a href="form.php?partID='.$id.'&raise=1&lastPage=index.php"><div>Zwiększ ilość</div></a>
							<a href="form.php?partID='.$id.'&raise=0&lastPage=index.php"><div>Zmniejsz ilość</div></a>
						</div>
					</div>
				</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
		
		public function edit($partID, $ilosc) {
			if($ilosc == '') {
				$ilosc = 0;
			}
			DBManager::query('
				UPDATE czesci
				SET ilosc = ilosc + '.$ilosc.'
				WHERE id_czesci = '.$partID.'
			');
			$this->editDoneCommunicate();
		}
		
		private function editDoneCommunicate() {
			echo '
				<h2>Operacja wykonana pomyślnie!</h2>
				<div id="menu" style="height: 42px;">
					<a href="index.php"><span class="menu_button">OK</span></a>
				</div>
			';
		}
		
	}
?>