<?php
	include 'Table.php';
	class Maszyny extends Table {

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
				$id; //ID maszyny
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
							<a href="usun_maszyne.php?machineID='.$id.'&lastPage=maszyny.php"><div>Usuń</div></a>
							<a href="edytuj_maszyne.php?machineID='.$id.'&lastPage=maszyny.php"><div>Edytuj</div></a>
						</div>
					</div>
				</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
		
		/*function showTableWithoutOptions() {
			echo '<table cellspacing="0">';
			for($i = 0; $i < $this->numberOfRows; $i++) {
				if($i % 30 == 0) {
					echo '<tr class="table_header">';
					//echo '<td>Nr</td>';
					for($j = 0; $j < $this->numberOfFields; $j++) {
						echo '<td>'.DBManager::getFieldName($this->table, $j).'</td>';
					}
					//echo '<td>Opcje</td>';
					echo '</tr>';
				}
				echo '<tr>';
				//echo '<td>'.($i + 1).'</td>';
				$id; //ID maszyny
				for($j = 0; $j < $this->numberOfFields; $j++) {
					$record = DBManager::getRecord($this->table, $i, DBManager::getFieldName($this->table, $j));
					if($j == 0) { //jezeli $j == nazwa
						$id = $this->getMachineIdByName($record); //szukaj ID maszyny po nazwie
					}
					if($record == NULL) {
						$record = '-';
					}
					echo '<td>'.$record.'</td>';
				}
			}
			echo '</table>';
		}*/
		
		public function insert($nazwa, $cena) {
			if($nazwa == '') {
				$this->noNameCommunicate();
			} else {
				if($this->isNameUnique($nazwa)) {
					if($cena == '') {
						$cena = 'NULL';
					}
					DBManager::query('
						INSERT INTO maszyny VALUES (
							DEFAULT,
							"'.$nazwa.'",
							'.$cena.'
						)
					');
					$this->insertDoneCommunicate();
				} else {
					$this->suchMachineExistsCommunicate();
				}
			}
		}
		
		public function delete($machineID) {
			DBManager::query('
				DELETE FROM zestawy_czesci
				WHERE maszyna = '.$machineID.';
			');
			DBManager::query('
				DELETE FROM zamowienia
				WHERE maszyna = '.$machineID.'
			');
			DBManager::query('
				DELETE FROM maszyny
				WHERE id_maszyna = '.$machineID.'
			');
			$this->deleteDoneCommunicate();
		}
		
		public function edit($machineID, $nowaNazwa, $staraNazwa, $cena) {
			if($nowaNazwa == '') {
				$this->noNameCommunicate();
				return;
			}
			if($this->isNameUnique($nowaNazwa) || $nowaNazwa == $staraNazwa) {
				if($cena == '') {
					$cena = 'NULL';
				}
				DBManager::query('
					UPDATE maszyny
					SET nazwa = "'.$nowaNazwa.'", cena = '.$cena.'
					WHERE id_maszyna = '.$machineID.'
				');
				$this->editDoneCommunicate();
			} else {
				$this->suchMachineExistsCommunicate();
			}
		}
		
		public function isNameUnique($nazwa) {
			$liczbaWierszy = DBManager::numberOfRows($this->table);
			for($i = 0; $i < $liczbaWierszy; $i++) {
				if($nazwa == DBManager::getRecord($this->table, $i, "nazwa")) {
					return false;
				}
			}
			return true;
		}
		
		public function getMachineName($i) {
			return DBManager::getRecord($this->table, $i, "nazwa");
		}
		
		public function getMachineIdByName($nazwa) {
		//sprawdzanie błędów!! czy maszyna w ogóle istnieje
			return DBManager::getRecord(
				DBManager::query('SELECT id_maszyna FROM maszyny WHERE nazwa = "'.$nazwa.'"'),
				0,
				'id_maszyna'
			);
		}
		
		private function noNameCommunicate() {
			echo '
				<h2>Musisz podać nazwę maszyny!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php" style="position: relative; top: 10px;"><span class="menu_button">Powrót do menu</span></a>
					<a href="dodaj_maszyne.php?lastPage=maszyny.php" style="position: relative; top: 10px;"><span class="menu_button">Spróbuj jeszcze raz</span></a>
				</div>
			';
		}
		
		private function insertDoneCommunicate() {
			echo '
				<h2>Rekord dodany pomyślnie!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php" style="position: relative; top: 10px;"><span class="menu_button">Powrót do menu</span></a>
					<a href="dodaj_maszyne.php?lastPage=maszyny.php" style="position: relative; top: 10px;"><span class="menu_button">Dodaj kolejny rekord</span></a>
				</div>
			';
		}		
		
		private function suchMachineExistsCommunicate() {
			echo '
				<h2>Istnieje już maszyna o podanej nazwie!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php" style="position: relative; top: 10px;"><span class="menu_button">Powrót do menu</span></a>
					<a href="dodaj_maszyne.php?lastPage=maszyny.php" style="position: relative; top: 10px;"><span class="menu_button">Spróbuj jeszcze raz</span></a>
				</div>
			';
		}
		
		public function deleteQuestionCommunicate($machineID) {
			//<h2>Czy na pewno chcesz usunąć dane zamówienie?</h2>
			echo '
				<div id="menu" style="height: 42px;">
					<a href="delete_machine.php?machineID='.$machineID.'&lastPage=maszyny.php"><span class="menu_button">Tak</span></a>
					<a href="maszyny.php"><span class="menu_button">Nie</span></a>
				</div>
			';
		}
		
		private function deleteDoneCommunicate() {
			echo '
				<h2>Maszyna usunięta pomyślnie!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php"><span class="menu_button">Powrót do menu</span></a>
					<a href="maszyny.php"><span class="menu_button">Powrót do tabeli Maszyny</span></a>
				</div>
			';
		}
		
		public function editMachineForm($machineID) {
			$nazwa = DBManager::getRecord($this->table, 0, "nazwa");
			$cena = DBManager::getRecord($this->table, 0, "cena");
			echo '
			<div class="window">
				<form action="edit_machine.php?machineID='.$machineID.'&oldName='.$nazwa.'&lastPage=maszyny.php" method="POST" class="form">
					<div id="inputs">
						<input type=text name=nazwa value="'.$nazwa.'"><br />
						<input type=text name=cena value="'.$cena.'"><br />
						<input type=submit name=accept value="Gotowe">
					</div>
					<div id="inputs_names">
						<div id="inputs_text">
							<div class="inputs_name">Nazwa:</div>
							<div class="inputs_name">Cena:</div>
						</div>
					</div>
				</form>
			</div>
			';
		}
		
		private function editDoneCommunicate() {
			echo '
				<h2>Maszyna edytowana pomyślnie!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php"><span class="menu_button">Powrót do menu</span></a>
					<a href="maszyny.php"><span class="menu_button">Powrót do tabeli Maszyny</span></a>
				</div>
			';
		}
	}
?>