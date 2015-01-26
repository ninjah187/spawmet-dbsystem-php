<?php
	include 'Table.php';
	class Czesci extends Table {
		
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
					<div class="options_button" id="optionsButton'.$i.'" onclick="showOptions(\'optionsButton'.$i.'\')">
						<div class="options_list">
							<a href="usun_czesc.php?partID='.$id.'&lastPage=czesci.php"><div>Usuń</div></a>
							<a href="edytuj_czesc.php?partID='.$id.'&lastPage=czesci.php"><div>Edytuj</div></a>
						</div>
					</div>
				</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
		
		public function insert($nazwa, $ilosc, $pochodzenie) {
			if($nazwa == '') {
				$this->noNameCommunicate();
			} else {
				if($this->isNameUnique($nazwa)) {
					if($ilosc == '') {
						$ilosc = 0;
					}
					if($pochodzenie == '') {
						$pochodzenie = NULL;
					}
					DBManager::query('
						INSERT INTO czesci VALUES (
							DEFAULT,
							"'.$nazwa.'",
							'.$ilosc.',
							"'.$pochodzenie.'"
						)
					');
					$this->insertDoneCommunicate();
				} else {
					if($ilosc == '') {
						$ilosc = 0;
					}
					DBManager::query('
						UPDATE czesci
						SET ilosc = ilosc + '.$ilosc.'
						WHERE nazwa = "'.$nazwa.'"
					');
					$this->insertDoneCommunicate();
				}
			}
		}
		
		public function delete($partID) {
			DBManager::query('
				DELETE FROM zestawy_czesci
				WHERE czesc = '.$partID.'
			');
			DBManager::query('
				DELETE FROM dostawy
				WHERE czesc = '.$partID.'
			');
			DBManager::query('
				DELETE FROM czesci
				WHERE id_czesci = '.$partID.'
			');
			$this->deleteDoneCommunicate();
		}
		
		public function edit($partID, $nowaNazwa, $staraNazwa, $ilosc, $pochodzenie) {
			if($nowaNazwa == '') {
				$this->noNameCommunicate();
				return;
			}
			if($this->isNameUnique($nowaNazwa) || $nowaNazwa == $staraNazwa) {
				if($ilosc == '') {
					$ilosc = 'NULL';
				}
				DBManager::query('
					UPDATE czesci
					SET nazwa = "'.$nowaNazwa.'", ilosc = '.$ilosc.', pochodzenie = "'.$pochodzenie.'"
					WHERE id_czesci = '.$partID.'
				');
				$this->editDoneCommunicate();
			} else {
				$this->suchPartExistsCommunicate();
			}
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
				<h2>Część dodana pomyślnie!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php" style="position: relative; top: 10px;"><span class="menu_button">Powrót do menu</span></a>
					<a href="dodaj_czesc.php?lastPage=czesci.php" style="position: relative; top: 10px;"><span class="menu_button">Dodaj kolejną część</span></a>
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
		
		public function deleteQuestionCommunicate($partID) {
			echo '
				<div id="menu" style="height: 42px;">
					<a href="delete_part.php?partID='.$partID.'&lastPage=czesci.php"><span class="menu_button">Tak</span></a>
					<a href="czesci.php"><span class="menu_button">Nie</span></a>
				</div>
			';
		}
		
		private function deleteDoneCommunicate() {
			echo '
				<h2>Część usunięta pomyślnie!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php"><span class="menu_button">Powrót do menu</span></a>
					<a href="czesci.php"><span class="menu_button">Powrót do tabeli Części</span></a>
				</div>
			';
		}
		
		public function editPartForm($partID) {
			$nazwa = DBManager::getRecord($this->table, 0, "nazwa");
			$ilosc = DBManager::getRecord($this->table, 0, "ilość");
			$pochodzenie = DBManager::getRecord($this->table, 0, "pochodzenie");
			echo '
			<div class="window">
				<form action="edit_part.php?partID='.$partID.'&oldName='.$nazwa.'&lastPage=czesci.php" method="POST" class="form">
					<div id="inputs">
						<input type=text name=nazwa value="'.$nazwa.'"><br />
						<input type=text name=ilosc value="'.$ilosc.'"><br />
						<select name=pochodzenie>';
						if($pochodzenie == NULL) {
							echo '	
								<option>Kupno</option>
								<option>Sprzedaż</option>
								<option>Inne</option>
							';
						} else {
							$origins[3];
							$origins[0] = "Kupno"; $origins[1] = "Sprzedaż"; $origins[2] = "Inne";
							echo '<option>'.$pochodzenie.'</option>';
							for($i = 0; $i < 3; $i++) {
								if($origins[$i] == $pochodzenie)
									continue;
								echo '<option>'.$origins[$i].'</option>';
							}
						}
			echo '			</select><br />
						<input type=submit name=accept value="Gotowe">
					</div>
					<div id="inputs_names">
						<div id="inputs_text">
							<div class="inputs_name">Nazwa:</div>
							<div class="inputs_name">Ilość:</div>
							<div class="inputs_name">Pochodzenie:</div>
						</div>
					</div>
				</form>
			</div>
			';
		}
		
		private function editDoneCommunicate() {
			echo '
				<h2>Część edytowana pomyślnie!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php"><span class="menu_button">Powrót do menu</span></a>
					<a href="czesci.php"><span class="menu_button">Powrót do tabeli Części</span></a>
				</div>
			';
		}
		
	}
?>