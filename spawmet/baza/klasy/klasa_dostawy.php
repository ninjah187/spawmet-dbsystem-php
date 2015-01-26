<?php
	include 'Table.php';
	class Dostawy extends Table {

		function __construct($selectQuery) {
			Table::__construct($selectQuery);
		}
		
		public function showTable() {
			echo '<table cellspacing="0">';
			for($i = 0; $i < $this->numberOfRows; $i++) {
				if($i % 30 == 0) {
					echo '<tr class="table_header">';
					echo '<td>Nr</td>';
					for($j = 0; $j < $this->numberOfFields; $j++) {
						$field = DBManager::getFieldName($this->table, $j);
						if($field == 'id') {
							continue;
						}
						echo '<td>'.$field.'</td>';
					}
					echo '<td>Opcje</td>';
					echo '</tr>';
				}
				echo '<tr>';
				echo '<td>'.($i + 1).'</td>';
				$id;
				for($j = 0; $j < $this->numberOfFields; $j++) {
					$field = DBManager::getFieldName($this->table, $j);
					switch($field) {
						case 'id': {
							$id = DBManager::getRecord($this->table, $i, $field);
						} break;
						case 'Część': {
							$partName = DBManager::getRecord($this->table, $i, $field);
							$partID = DBManager::getRecord(
								DBManager::query('SELECT id_czesci FROM czesci WHERE nazwa = "'.$partName.'"'),
								0,
								'id_czesci'
							);
							echo '<td><a href="czesc_info.php?partID='.$partID.'&lastPage=dostawy.php" class="table_a">'.$partName.'</a></td>';
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
					<div class="options_button" id="optionsButton'.$i.'" onclick="showOptions(\'optionsButton'.$i.'\')">
						<div class="options_list">
							<a href="usun_dostawe.php?supplyID='.$id.'&lastPage=dostawy.php"><div>Usuń</div></a>
							<a href="edytuj_dostawe.php?supplyID='.$id.'&lastPage=dostawy.php"><div>Edytuj</div></a>
						</div>
					</div>
				</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
		
		function showTableWithoutOptions() {
			echo '<table cellspacing="0">';
			for($i = 0; $i < $this->numberOfRows; $i++) {
				if($i % 30 == 0) {
					echo '<tr class="table_header">';
					//echo '<td>Nr</td>';
					for($j = 0; $j < $this->numberOfFields; $j++) {
						$field = DBManager::getFieldName($this->table, $j);
						if($field == 'Data odbioru') {
							continue;
						}
						echo '<td>'.$field.'</td>';
					}
					//echo '<td>Opcje</td>';
					echo '</tr>';
				}
				echo '<tr>';
				//echo '<td>'.($i + 1).'</td>';
				for($j = 0; $j < $this->numberOfFields; $j++) {
					$field = DBManager::getFieldName($this->table, $j);
					switch($field) {
						case "Data odbioru": {
							continue;
						} break;
						default: {
							$record = DBManager::getRecord($this->table, $i, DBManager::getFieldName($this->table, $j));
							if($record == NULL) {
								$record = '-';
							}
							echo '<td>'.$record.'</td>';
						} break;
					}
				}
			}
			echo '</table>';
		}
		
		public function insert($data, $dostawca, $czesc, $ilosc) {
			if($czesc == '') {
				$this->noNameCommunicate();
			} else {
				if($data == '') {
					$data = NULL;
				}
				if($dostawca == '') {
					$dostawca = NULL;
				}
				if($ilosc == '') {
					$ilosc = 0;
				}
				
				$c = DBManager::numberOfRows(DBManager::query('SELECT id_czesci FROM czesci WHERE nazwa = "'.$czesc.'"'));
				if($c == 0) {
					DBManager::query('
						INSERT INTO czesci VALUES (
							DEFAULT,
							"'.$czesc.'",
							0
						)
					');
				}
				
				$id_czesci = DBManager::getRecord(
					DBManager::query('SELECT id_czesci FROM czesci WHERE nazwa = "'.$czesc.'"'),
					0,
					"id_czesci"
				);

				DBManager::query('
					INSERT INTO dostawy VALUES (
						DEFAULT,
						"'.$data.'",
						"'.$dostawca.'",
						'.$id_czesci.',
						'.$ilosc.'
					)
				');
				DBManager::query('
					UPDATE czesci
					SET ilosc = ilosc + '.$ilosc.'
					WHERE id_czesci = '.$id_czesci.'
				');
				
				$this->insertDoneCommunicate();
			}
		}
		
		public function delete($supplyID) {
			DBManager::query('
				DELETE FROM dostawy
				WHERE id_dostawa = '.$supplyID.'
			');
			$this->deleteDoneCommunicate();
		}
		
		private function noNameCommunicate() {
			echo '
				<h2>Musisz podać nazwę części!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php" style="position: relative; top: 10px;"><span class="menu_button">Powrót do menu</span></a>
					<a href="dodaj_dostawe.php?lastPage=dostawy.php" style="position: relative; top: 10px;"><span class="menu_button">Spróbuj jeszcze raz</span></a>
				</div>
			';
		}
		
		private function insertDoneCommunicate() {
			echo '
				<h2>Rekord dodany pomyślnie!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php" style="position: relative; top: 10px;"><span class="menu_button">Powrót do menu</span></a>
					<a href="dodaj_dostawe.php?lastPage=dostawy.php" style="position: relative; top: 10px;"><span class="menu_button">Dodaj kolejny rekord</span></a>
				</div>
			';
		}		
		
		public function deleteQuestionCommunicate($supplyID) {
			echo '
				<div id="menu" style="height: 42px;">
					<a href="delete_supply.php?supplyID='.$supplyID.'&lastPage=dostawy.php"><span class="menu_button">Tak</span></a>
					<a href="dostawy.php"><span class="menu_button">Nie</span></a>
				</div>
			';
		}
		
		private function deleteDoneCommunicate() {
			echo '
				<h2>Dostawa usunięta pomyślnie!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php"><span class="menu_button">Powrót do menu</span></a>
					<a href="dostawy.php"><span class="menu_button">Powrót do tabeli Dostawy</span></a>
				</div>
			';
		}
	}
?>