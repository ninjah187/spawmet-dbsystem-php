<?php
	include "Table.php";
	class ZestawyCzesci extends Table {
		
		function __construct($selectQuery) {
			Table::__construct($selectQuery);
		}
		
		function showTable() {
			echo '<table cellspacing="0">';
			for($i = 0; $i < $this->numberOfRows; $i++) {
				if($i % 30 == 0) {
					echo '<tr class="table_header">';
					//echo '<td>Nr</td>';
					for($j = 0; $j < $this->numberOfFields; $j++) {
						$field = DBManager::getFieldName($this->table, $j);
						switch($field) {
							case 'id':
								continue;
							//case 'Numer zestawu':
							//	continue;
							default: {
								echo '<td>'.$field.'</td>';
							} break;
						}
					}
					echo '<td>Opcje</td>';
					echo '</tr>';
				}
				echo '<tr>';
				//echo '<td>'.($i + 1).'</td>';
				$id;
				$setNumber;
				for($j = 0; $j < $this->numberOfFields; $j++) {
					$field = DBManager::getFieldName($this->table, $j);
					switch($field) {
						case 'id': {
							$id = DBManager::getRecord($this->table, $i, $field);
						} break;
						case 'Numer zestawu': {
							$setNumber = DBManager::getRecord($this->table, $i, $field);
							echo '<td>'.$setNumber.'</td>';
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
							<a href="dolacz_czesc.php?setNumber='.$setNumber.'&lastPage=zestawy_czesci.php"><div>Dołącz część</div></a>
							<a href="usun_czesc_zestaw.php?setID='.$id.'&lastPage=zestawy_czesci.php"><div>Usuń część</div></a>
							<a href="usun_zestaw.php?setNumber='.$setNumber.'&lastPage=zestawy_czesci.php"><div>Usuń zestaw</div></a>
							<a href="edytuj_klienta.php?setID='.$id.'&lastPage=zestawy_czesci.php"><div>Edytuj</div></a>
						</div>
					</div>
				</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
		
		public function insert($nrZestawu, $nazwaMaszyny, $nazwaCzesci, $iloscCzesci) {
			//rozważ automatyczne dodawanie następnego wolnego numeru
			if($nrZestawu == '') {
				$this->noNumberCommunicate();
				return;
			}
			if($this->isNumberUnique($nrZestawu)) {
				$maszynaID = DBManager::getRecord(
					DBManager::query('SELECT id_maszyna FROM maszyny WHERE nazwa = "'.$nazwaMaszyny.'"'),
					0,
					'id_maszyna'
				);
				$czescID = DBManager::getRecord(
					DBManager::query('SELECT id_czesci FROM czesci WHERE nazwa = "'.$nazwaCzesci.'"'),
					0,
					'id_czesci'
				);
				
				if($iloscCzesci == '') {
					$iloscCzesci = 0;
				}
				
				DBManager::query('
					INSERT INTO zestawy_czesci VALUES (
						DEFAULT,
						'.$nrZestawu.',
						'.$maszynaID.',
						'.$czescID.',
						'.$iloscCzesci.'
					)
				');
				
				$this->insertDoneCommunicate();
			} else {
				$this->wrongNumberCommunicate();
			}
		}
		
		public function joinPart($nrZestawu, $nazwaCzesci, $iloscCzesci) {
			$maszynaID = DBManager::getRecord(
				DBManager::query('SELECT maszyna FROM zestawy_czesci WHERE nr_zestawu = "'.$nrZestawu.'"'),
				0,
				'maszyna'
			);
			$czescID = DBManager::getRecord(
				DBManager::query('SELECT id_czesci FROM czesci WHERE nazwa = "'.$nazwaCzesci.'"'),
				0,
				'id_czesci'
			);
			
			if($iloscCzesci == '') {
				$iloscCzesci = 0;
			}
				
			DBManager::query('
				INSERT INTO zestawy_czesci VALUES (
					DEFAULT,
					'.$nrZestawu.',
					'.$maszynaID.',
					'.$czescID.',
					'.$iloscCzesci.'
				)
			');
				
			$this->joinPartDoneCommunicate($nrZestawu);
		}
		
		public function deletePartFromSet($setID) {
			DBManager::query('
				DELETE FROM zestawy_czesci
				WHERE id_zestaw_czesci = '.$setID
			);
			$this->deleteDoneCommunicate();
		}
		
		public function deleteSet($setNumber) {
			DBManager::query('
				DELETE FROM zestawy_czesci
				WHERE nr_zestawu = '.$setNumber
			);
			$this->deleteDoneCommunicate();
		}
		
		private function isNumberUnique($nrZestawu) {
			$liczbaWierszy = $this->numberOfRows;//DBManager::numberOfRows($this->table);
			for($i = 0; $i < $liczbaWierszy; $i++) {
				if($nrZestawu == DBManager::getRecord($this->table, $i, "nr_zestawu")) {
					return false;
				}
			}
			return true;
		}
		
		private function noNumberCommunicate() {
			echo '
				<h2>Musisz podać numer zestawu!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php" style="position: relative; top: 10px;"><span class="menu_button">Powrót do menu</span></a>
					<a href="dodaj_zestaw.php?lastPage=zestawy_czesci.php" style="position: relative; top: 10px;"><span class="menu_button">Spróbuj jeszcze raz</span></a>
				</div>
			';
		}
		
		private function wrongNumberCommunicate() {
			echo '
				<h2>Istnieje już zestaw o podanym numerze!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php" style="position: relative; top: 10px;"><span class="menu_button">Powrót do menu</span></a>
					<a href="dodaj_zestaw.php?lastPage=zestawy_czesci.php" style="position: relative; top: 10px;"><span class="menu_button">Spróbuj jeszcze raz</span></a>
				</div>
			';
		}
		
		private function insertDoneCommunicate() {
			echo '
				<h2>Rekord dodany pomyślnie!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php" style="position: relative; top: 10px;"><span class="menu_button">Powrót do menu</span></a>
					<a href="dodaj_zestaw.php?lastPage=zestawy_czesci.php" style="position: relative; top: 10px;"><span class="menu_button">Dodaj kolejny rekord</span></a>
				</div>
			';
		}
		
		private function joinPartDoneCommunicate($setNumber) {
			echo '
				<h2>Rekord dodany pomyślnie!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php" style="position: relative; top: 10px;"><span class="menu_button">Powrót do menu</span></a>
					<a href="dolacz_czesc.php?setNumber='.$setNumber.'&lastPage=zestawy_czesci.php" style="position: relative; top: 10px;"><span class="menu_button">Dodaj kolejny rekord</span></a>
				</div>
			';
		}
		
		public function deletePartQuestionCommunicate($setID) {
			//<h2>Czy na pewno chcesz usunąć dane zamówienie?</h2>
			echo '
				<div id="menu" style="height: 42px;">
					<a href="delete_part_set.php?setID='.$setID.'&lastPage=zestawy_czesci.php"><span class="menu_button">Tak</span></a>
					<a href="zestawy_czesci.php"><span class="menu_button">Nie</span></a>
				</div>
			';
		}
		
		public function deleteQuestionCommunicate($setNumber) {
			//<h2>Czy na pewno chcesz usunąć dane zamówienie?</h2>
			echo '
				<div id="menu" style="height: 42px;">
					<a href="delete_set.php?setNumber='.$setNumber.'&lastPage=zestawy_czesci.php"><span class="menu_button">Tak</span></a>
					<a href="zestawy_czesci.php"><span class="menu_button">Nie</span></a>
				</div>
			';
		}
		
		private function deleteDoneCommunicate() {
			echo '
				<h2>Rekord usunięty pomyślnie!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php"><span class="menu_button">Powrót do menu</span></a>
					<a href="zestawy_czesci.php"><span class="menu_button">Powrót do tabeli Zestawy</span></a>
				</div>
			';
		}
	}
?>