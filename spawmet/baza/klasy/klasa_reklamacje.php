<?php
	include 'Table.php';
	class Reklamacje extends Table {
		
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
					<div class="options_button" id="optionsButton'.$i.'" onclick="showOptions(\'optionsButton'.$i.'\')">
						<div class="options_list">
							<a href="usun_reklamacje.php?complaintID='.$id.'&lastPage=reklamacje.php"><div>Usuń</div></a>
							<a href="edytuj_reklamacje.php?complaintID='.$id.'&lastPage=reklamacje.php"><div>Edytuj</div></a>
						</div>
					</div>
				</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
		
		public function insert($klient, $adres, $uwagi, $zrealizowano) {
			if($klient == '') {
				$klient = NULL;
			}
			if($adres == '') {
				$adres = NULL;
			}
			if($uwagi == '') {
				$uwagi = NULL;
			}
			if($zrealizowano == '') {
				$zrealizowano = NULL;
			}
			DBManager::query('
				INSERT INTO reklamacje VALUES (
					DEFAULT,
					"'.$klient.'",
					"'.$adres.'",
					"'.$uwagi.'",
					"'.$zrealizowano.'"
				)
			');
			$this->insertDoneCommunicate();
		}
		
		public function delete($complaintID) {
			DBManager::query('
				DELETE FROM reklamacje
				WHERE id_reklamacja = '.$complaintID.'
			');
			$this->deleteDoneCommunicate();
		}
		
		public function edit($complaintID, $klient, $adres, $uwagi, $zrealizowano) {
			if($klient == '') {
				$klient = NULL;
			}
			if($adres == '') {
				$adres = NULL;
			}
			if($uwagi == '') {
				$uwagi = NULL;
			}
			if($zrealizowano == '') {
				$zrealizowano = NULL;
			}
			DBManager::query('
				UPDATE reklamacje
				SET klient = "'.$klient.'",
				adres = "'.$adres.'",
				uwagi = "'.$uwagi.'",
				zrealizowano = "'.$zrealizowano.'"
				WHERE id_reklamacja = '.$complaintID.'
			');
			$this->editDoneCommunicate();
		}
		
		private function isNameUnique($nazwa) {
			$liczbaWierszy = DBManager::numberOfRows($this->table);
			for($i = 0; $i < $liczbaWierszy; $i++) {
				if($nazwa == DBManager::getRecord($this->table, $i, "nazwa")) {
					return false;
				}
			}
			return true;
		}
		
		public function getPartName($i) {
			DBManager::getRecord($this->table, $i, "nazwa");
		}
		
		private function noNameCommunicate() {
			echo '
				<h2>Musisz podać nazwę części!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php" style="position: relative; top: 10px;"><span class="menu_button">Powrót do menu</span></a>
					<a href="dodaj_czesc.php?lastPage=czesci.php" style="position: relative; top: 10px;"><span class="menu_button">Spróbuj jeszcze raz</span></a>
				</div>
			';
		}
		
		private function insertDoneCommunicate() {
			echo '
				<h2>Reklamacja dodana pomyślnie!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php" style="position: relative; top: 10px;"><span class="menu_button">Powrót do menu</span></a>
					<a href="dodaj_reklamacje.php?lastPage=reklamacje.php" style="position: relative; top: 10px;"><span class="menu_button">Dodaj kolejną reklamację</span></a>
				</div>
			';
		}
		
		private function suchPartExistsCommunicate() {
			echo '
				<h2>Istnieje już część o podanej nazwie!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php" style="position: relative; top: 10px;"><span class="menu_button">Powrót do menu</span></a>
					<a href="dodaj_czesc.php?lastPage=czesci.php" style="position: relative; top: 10px;"><span class="menu_button">Spróbuj jeszcze raz</span></a>
				</div>
			';
		}
		
		public function deleteQuestionCommunicate($complaintID) {
			echo '
				<div id="menu" style="height: 42px;">
					<a href="delete_complaint.php?complaintID='.$complaintID.'&lastPage=reklamacje.php"><span class="menu_button">Tak</span></a>
					<a href="reklamacje.php"><span class="menu_button">Nie</span></a>
				</div>
			';
		}
		
		private function deleteDoneCommunicate() {
			echo '
				<h2>Reklamacja usunięta pomyślnie!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php"><span class="menu_button">Powrót do menu</span></a>
					<a href="reklamacje.php"><span class="menu_button">Powrót do tabeli Reklamacje</span></a>
				</div>
			';
		}
		
		public function editComplaintForm($complaintID) {
			$klient = DBManager::getRecord($this->table, 0, "klient");
			$adres = DBManager::getRecord($this->table, 0, "adres");
			$uwagi = DBManager::getRecord($this->table, 0, "uwagi");
			$zrealizowano = DBManager::getRecord($this->table, 0, "zrealizowano");
			echo '
			<div class="window">
				<form action="edit_complaint.php?complaintID='.$complaintID.'&lastPage=reklamacje.php" method="POST" class="form">
					<div id="inputs">
						<input type=text name=klient value="'.$klient.'"><br />
						<input type=text name=adres value="'.$adres.'"><br />
						<input type=text name=uwagi value="'.$uwagi.'"><br />
						<input type=text name=zrealizowano value="'.$zrealizowano.'"><br />
						<input type=submit name=accept value="Gotowe">
					</div>
					<div id="inputs_names">
						<div id="inputs_text">
							<div class="inputs_name">Klient:</div>
							<div class="inputs_name">Adres:</div>
							<div class="inputs_name">Uwagi:</div>
							<div class="inputs_name">Zrealizowano:</div>
						</div>
					</div>
				</form>
			</div>
			';
		}
		
		private function editDoneCommunicate() {
			echo '
				<h2>Reklamacja edytowana pomyślnie!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php"><span class="menu_button">Powrót do menu</span></a>
					<a href="reklamacje.php"><span class="menu_button">Powrót do tabeli Reklamacje</span></a>
				</div>
			';
		}
		
	}
?>