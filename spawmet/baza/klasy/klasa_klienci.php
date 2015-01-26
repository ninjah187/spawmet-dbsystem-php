<?php
	include 'Table.php';
	class Klienci extends Table {
		
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
							<a href="usun_klienta.php?customerID='.$id.'&lastPage=klienci.php"><div>Usuń</div></a>
							<a href="edytuj_klienta.php?customerID='.$id.'&lastPage=klienci.php"><div>Edytuj</div></a>
						</div>
					</div>
				</td>';
				echo '</tr>';
			}
			echo '</table>';
		}
		
		public function insert($nazwa, $miejscowosc, $telefon, $email, $nip, $wojewodztwo, $ulica, $kodPocztowy) {
			if($nazwa == '') {
				$this->noNameCommunicate();
			} else {
				//NULLE były bez apostrofów i też działało
				if($this->isNameUnique($nazwa)) {
					if($miejscowosc == '') {
						$miejscowosc = NULL;
					}
					if($telefon == '') {
						$telefon = NULL;
					}
					if($email == '') {
						$email = NULL;
					}
					if($nip == '') {
						$nip = NULL;
					}
					if($wojewodztwo == '') {
						$wojewodztwo = NULL;
					}
					if($ulica == '') {
						$ulica = NULL;
					}
					if($kodPocztowy == '') {
						$kodPocztowy = NULL;
					}
					DBManager::query('
						INSERT INTO klienci VALUES (
							DEFAULT,
							"'.$nazwa.'",
							"'.$miejscowosc.'",
							"'.$telefon.'",
							"'.$email.'",
							"'.$nip.'",
							"'.$wojewodztwo.'",
							"'.$ulica.'",
							"'.$kodPocztowy.'"
						)
					');
					$this->insertDoneCommunicate();
				} else {
					$this->suchCustomerExistsCommunicate();
				}
			}
		}
		
		public function delete($customerID) {
			DBManager::query('
				DELETE FROM zamowienia
				WHERE klient = '.$customerID.'
			');
			DBManager::query('
				DELETE FROM klienci
				WHERE id_klient = '.$customerID.'
			');
			$this->deleteDoneCommunicate();
		}
		
		public function edit($customerID, $nowaNazwa, $staraNazwa, $miejscowosc, $telefon,
								$email, $nip, $wojewodztwo, $ulica, $kodPocztowy) {
			//wojewodztwa z opcji select !!
			if($nowaNazwa == '') {
				$this->noNameCommunicate();
				return;
			}
			if($this->isNameUnique($nowaNazwa) || $nowaNazwa == $staraNazwa) {
				if($miejscowosc == '') {
					$miejscowosc = NULL;
				}
				if($telefon == '') {
					$telefon = NULL;
				}
				if($email == '') {
					$email = NULL;
				}
				
				if($nip == '') {
					$nip = NULL;
				}
				
				if($wojewodztwo == '') {
					$wojewodztwo = NULL;
				}
				if($ulica == '') {
					$ulica = NULL;
				}
				if($kodPocztowy == '') {
					$kodPocztowy = NULL;
				}
				DBManager::query('
					UPDATE klienci
					SET nazwa = "'.$nowaNazwa.'",
					miejscowosc = "'.$miejscowosc.'",
					telefon = "'.$telefon.'",
					email = "'.$email.'",
					nip = "'.$nip.'",
					wojewodztwo = "'.$wojewodztwo.'",
					ulica = "'.$ulica.'",
					kod_pocztowy = "'.$kodPocztowy.'"
					WHERE id_klient = '.$customerID.'
				');
				$this->editDoneCommunicate();
			} else {
				$this->suchCustomerExistsCommunicate();
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
		
		public function getCustomerName($i) {
			return DBManager::getRecord($this->table, $i, "nazwa");
		}
		
		public function getCustomerIdByName($nazwa) {
			//sprawdzanie błędów!! czy klient w ogóle istnieje
			return DBManager::getRecord(
				DBManager::query('SELECT id_klient FROM klienci WHERE nazwa = "'.$nazwa.'"'),
				0,
				'id_klient'
			);
		}
		
		public function noNameCommunicate() {
			echo '
				<h2>Musisz podać nazwę klienta!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php" style="position: relative; top: 10px;"><span class="menu_button">Powrót do menu</span></a>
					<a href="dodaj_klienta.php?lastPage=klienci.php" style="position: relative; top: 10px;"><span class="menu_button">Spróbuj jeszcze raz</span></a>
				</div>
			';
		}
		
		public function insertDoneCommunicate() {
			echo '
				<h2>Rekord dodany pomyślnie!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php" style="position: relative; top: 10px;"><span class="menu_button">Powrót do menu</span></a>
					<a href="dodaj_maszyne.php?lastPage=maszyny.php" style="position: relative; top: 10px;"><span class="menu_button">Dodaj kolejny rekord</span></a>
				</div>
			';
		}
		
		public function suchCustomerExistsCommunicate() {
			echo '
				<h2>Istnieje już klient o podanej nazwie!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php" style="position: relative; top: 10px;"><span class="menu_button">Powrót do menu</span></a>
					<a href="dodaj_klienta.php?lastPage=klienci.php" style="position: relative; top: 10px;"><span class="menu_button">Spróbuj jeszcze raz</span></a>
				</div>
			';
		}
		
		public function deleteQuestionCommunicate($customerID) {
			echo '
				<div id="menu" style="height: 42px;">
					<a href="delete_customer.php?customerID='.$customerID.'&lastPage=klienci.php"><span class="menu_button">Tak</span></a>
					<a href="klienci.php"><span class="menu_button">Nie</span></a>
				</div>
			';
		}
		
		private function deleteDoneCommunicate() {
			echo '
				<h2>Klient usunięty pomyślnie!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php"><span class="menu_button">Powrót do menu</span></a>
					<a href="klienci.php"><span class="menu_button">Powrót do tabeli Klienci</span></a>
				</div>
			';
		}
		
		public function editCustomerForm($customerID) {
			$nazwa = DBManager::getRecord($this->table, 0, "nazwa");
			$miejscowosc = DBManager::getRecord($this->table, 0, "miejscowość");
			$telefon = DBManager::getRecord($this->table, 0, "telefon");
			$email = DBManager::getRecord($this->table, 0, "email");
			$nip = DBManager::getRecord($this->table, 0, "nip");
			$wojewodztwo = DBManager::getRecord($this->table, 0, "województwo");
			$ulica = DBManager::getRecord($this->table, 0, "ulica");
			$kodPocztowy = DBManager::getRecord($this->table, 0, "kod pocztowy");
			echo '
			<div class="window">
				<form action="edit_customer.php?customerID='.$customerID.'&oldName='.$nazwa.'&lastPage=klienci.php" method="POST" class="form">
					<div id="inputs">
						<input type=text name=nazwa value="'.$nazwa.'"><br />
						<input type=text name=miejscowosc value="'.$miejscowosc.'"><br />
						<input type=text name=telefon value="'.$telefon.'"><br />
						<input type=text name=email value="'.$email.'"><br />
						<input type=text name=nip value="'.$nip.'"><br />
						<input type=text name=wojewodztwo value="'.$wojewodztwo.'"><br />
						<input type=text name=ulica value="'.$ulica.'"><br />
						<input type=text name=kodPocztowy value="'.$kodPocztowy.'"><br />
						<input type=submit name=accept value="Gotowe">
					</div>
					<div id="inputs_names">
						<div id="inputs_text">
							<div class="inputs_name">Nazwa:</div>
							<div class="inputs_name">Miejscowość:</div>
							<div class="inputs_name">Telefon:</div>
							<div class="inputs_name">Email:</div>
							<div class="inputs_name">NIP:</div>
							<div class="inputs_name">Województwo:</div>
							<div class="inputs_name">Ulica:</div>
							<div class="inputs_name">Kod pocztowy:</div>
						</div>
					</div>
				</form>
			</div>
			';
		}
		
		private function editDoneCommunicate() {
			echo '
				<h2>Klient edytowany pomyślnie!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php"><span class="menu_button">Powrót do menu</span></a>
					<a href="klienci.php"><span class="menu_button">Powrót do tabeli Klienci</span></a>
				</div>
			';
		}
	}
?>