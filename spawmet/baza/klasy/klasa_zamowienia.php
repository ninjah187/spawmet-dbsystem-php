<?php
	include 'klasy/Table.php';
	
	abstract class StatusEnum {
		const Niezaakceptowane = 0;
		const WProdukcji = 1;
		const DoWysylki = 2;
		const Zaladunek = 3;
		const Wyslane = 4;
		const Zakonczone = 5;
	
		public static function convertToEnum($status) {
			switch($status) {
				case "Niezaakceptowane":
					return StatusEnum::Niezaakceptowane;
				case "W produkcji":
					return StatusEnum::WProdukcji;
				case "Do wysyłki":
					return StatusEnum::DoWysylki;
				case "Załadunek":
					return StatusEnum::Zaladunek;
				case "Wysłane":
					return StatusEnum::Wyslane;
				case "Zakończone":
					return StatusEnum::Zakonczone;
			}
		}
	}
	
	class Zamowienia extends Table {
		public function __construct($selectQuery) {
			parent::__construct($selectQuery);
		}
		
		public function showTable() {
			echo '<table cellspacing="0">';
			for($i = 0; $i < $this->numberOfRows; $i++) {
				if($i % 30 == 0) {
					echo '<tr class="table_header">';
					//echo '<td>Nr</td>';
					for($j = 0; $j < $this->numberOfFields; $j++) {
						echo '<td>'.DBManager::getFieldName($this->table, $j).'</td>';
					}
					echo '<td>Opcje</td>';
					echo '</tr>';
				}
				echo '<tr>';
				//echo '<td>'.($i + 1).'</td>';
				
				$orderID;
				
				//spróbuj zawsze pobierać wszystkie id, a następnie przydzielać pierwsze wolne; id mogą zbyt szybko rosnąć; co z zamówieniem 1230942?
				for($j = 0; $j < $this->numberOfFields; $j++) {
					$field = DBManager::getFieldName($this->table, $j);
					switch($field) {
						case 'id': {
							$orderID = DBManager::getRecord($this->table, $i, $field);
							echo '<td>'.$orderID.'</td>';
						} break;
						//pomyśl nad sensowniejszym wyszukiwaniem klientów (pobieranie id od razu z tabelą zamówień? analogicznie do reszty id)
						//nazwy klientów mogą się powtarzać dlatego NIE można po nich wyszukiwać!!!!
						case 'Klient': {
							$record = DBManager::getRecord($this->table, $i, $field);
							echo '<td><a href="klient_info.php?customerName='.$record.'&lastPage=zamowienia.php" class="table_a">'.$record.'</a></td>';
						} break;
						case 'Maszyna': {
							$machineName = DBManager::getRecord($this->table, $i, $field);
							$machineID = DBManager::getRecord(
								DBManager::query('SELECT * FROM maszyny WHERE nazwa = "'.$machineName.'"'),
								0,
								'id_maszyna'
							);
							echo '<td><a href="maszyna_info.php?machineID='.$machineID.'&lastPage=zamowienia.php" class="table_a">'.$machineName.'</a></td>';
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
				
				//options
				echo '
				<td class="option_row">
					<div class="options_button" id="optionsButton'.$i.'" onclick="showOptions(\'optionsButton'.$i.'\')">
						<div class="options_list">
							<a href="usun_zamowienie.php?orderID='.$orderID.'&lastPage=zamowienia.php"><div>Usuń</div></a>
							<a href="zmien_status.php?orderID='.$orderID.'&lastPage=zamowienia.php"><div>Zmień status...</div></a>
							<a href="ustaw_date.php?orderID='.$orderID.'&lastPage=zamowienia.php"><div>Ustaw wysyłkę</div></a>
						</div>
					</div>
				</td>';
				
				echo '</tr>';
			}
			echo '</table>';
		}
		
		public function showTableWithoutOptions() {
			echo '<table cellspacing="0">';
			for($i = 0; $i < $this->numberOfRows; $i++) {
				if($i % 30 == 0) {
					echo '<tr class="table_header">';
					//echo '<td>Nr</td>';
					for($j = 0; $j < $this->numberOfFields; $j++) {
						echo '<td>'.DBManager::getFieldName($this->table, $j).'</td>';
					}
					echo '</tr>';
				}
				echo '<tr>';
				//echo '<td>'.($i + 1).'</td>';
				
				$orderID;
				
				for($j = 0; $j < $this->numberOfFields; $j++) {
					$field = DBManager::getFieldName($this->table, $j);
					switch($field) {
						case 'id': {
							$orderID = DBManager::getRecord($this->table, $i, $field);
							echo '<td>'.$orderID.'</td>';
						} break;
						case 'Klient': {
							$record = DBManager::getRecord($this->table, $i, $field);
							echo '<td><a href="klient_info.php?customerName='.$record.'&lastPage=zamowienia.php" class="table_a">'.$record.'</a></td>';
						} break;
						case 'Maszyna': {
							$machineName = DBManager::getRecord($this->table, $i, $field);
							$machineID = DBManager::getRecord(
								DBManager::query('SELECT * FROM maszyny WHERE nazwa = "'.$machineName.'"'),
								0,
								'id_maszyna'
							);
							echo '<td><a href="maszyna_info.php?machineID='.$machineID.'&lastPage=zamowienia.php" class="table_a">'.$machineName.'</a></td>';
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
				echo '</tr>';
			}
			echo '</table>';
		}

		public function insert($nazwaKlienta, $nazwaMaszyny, $status, $dataZlozenia, $uwagi, $telefon, $email,
								$miejscowosc, $ulica, $kodPocztowy, $wojewodztwo) {
			if($nazwaKlienta == '') {
				$this->noNameCommunicate();
			} else {
				$t = DBManager::numberOfRows(
					DBManager::query('SELECT id_klient FROM klienci WHERE nazwa = "'.$nazwaKlienta.'"')
				);
				if($t == 0) {
					if($miejscowosc == '') {
						$miejscowosc = NULL;
					}
					if($telefon == '') {
						$telefon = NULL;
					}
					if($email == '') {
						$email = NULL;
					}
					if($wojewodztwo == '-') {
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
							"'.$nazwaKlienta.'",
							"'.$miejscowosc.'",
							"'.$telefon.'",
							"'.$email.'",
							"'.$wojewodztwo.'",
							"'.$ulica.'",
							"'.$kodPocztowy.'"
						)
					');
				}
				$id_klient = DBManager::getRecord(
					DBManager::query('SELECT id_klient FROM klienci WHERE nazwa = "'.$nazwaKlienta.'"'),
					0,
					"id_klient"
				);
				$id_maszyna = DBManager::getRecord(
					DBManager::query('SELECT id_maszyna FROM maszyny WHERE nazwa = "'.$nazwaMaszyny.'"'),
					0,
					"id_maszyna"
				);
				
				//fill all values with nulls
				if($uwagi == '') {
					$uwagi = NULL;
				}
				$dataWysylki = NULL;
				
				DBManager::query('
					INSERT INTO zamowienia VALUES (
						DEFAULT,
						'.$id_klient.',
						'.$id_maszyna.',
						"'.$status.'",
						"'.$dataZlozenia.'",
						"'.$dataWysylki.'",
						"'.$uwagi.'"
					)
				');
				$this->insertDoneCommunicate();
			}
		}
		
		public function insertIntoBase($nazwaKlienta, $nazwaMaszyny, $status, $dataZlozenia, $uwagi) {
			$id_klient = DBManager::getRecord(
				DBManager::query('SELECT id_klient FROM klienci WHERE nazwa = "'.$nazwaKlienta.'"'),
				0,
				"id_klient"
			);
			$id_maszyna = DBManager::getRecord(
				DBManager::query('SELECT id_maszyna FROM maszyny WHERE nazwa = "'.$nazwaMaszyny.'"'),
				0,
				"id_maszyna"
			);
			
			if($uwagi == '') {
				$uwagi = NULL;
			}
			$dataWysylki = NULL;
			
			DBManager::query('
				INSERT INTO zamowienia VALUES (
					DEFAULT,
					'.$id_klient.',
					'.$id_maszyna.',
					"'.$status.'",
					"'.$dataZlozenia.'",
					"'.$dataWysylki.'",
					"'.$uwagi.'"
				)
			');
			$this->insertDoneCommunicate();
		}
		
		public function delete($orderID) {
			DBManager::query('
				DELETE FROM zamowienia
				WHERE id_zamowienie = '.$orderID
			);
			$this->deleteDoneCommunicate();
		}
		
		public function changeStatus($orderID, $status) {
			$nazwaMaszyny = DBManager::getRecord($this->table, 0, "maszyna");
			$maszyna = DBManager::getRecord(
				DBManager::query('SELECT id_maszyna FROM maszyny WHERE nazwa = "'.$nazwaMaszyny.'"'),
				0,
				"id_maszyna"
			);
			echo $maszyna;
			$zestaw = new Table('SELECT * FROM zestawy_czesci WHERE maszyna = '.$maszyna);
			$staryStatus = DBManager::getRecord($this->table, 0, "status"); //string status
			
			$newStatus = StatusEnum::convertToEnum($status);
			$oldStatus = StatusEnum::convertToEnum($staryStatus);
			
			if($newStatus < StatusEnum::WProdukcji) {
				if($oldStatus >= StatusEnum::WProdukcji) {
					//dodac czesci do magazynu
					for($i = 0; $i < $zestaw->numberOfRows; $i++) {
						$czesc = DBManager::getRecord($zestaw->table, $i, "czesc");
						$potrzebnaIlosc = DBManager::getRecord($zestaw->table, $i, "ilosc_potrzebnych_cz");
						DBManager::query('
							UPDATE czesci
							SET ilosc = ilosc + '.$potrzebnaIlosc.'
							WHERE id_czesci = '.$czesc.'
						');
					}
				}
			}
			
			if($newStatus >= StatusEnum::WProdukcji) {
				if($oldStatus < StatusEnum::WProdukcji) {
					//usunac czesci z magazynu
					for($i = 0; $i < $zestaw->numberOfRows; $i++) {
						$czesc = DBManager::getRecord($zestaw->table, $i, "czesc");
						$potrzebnaIlosc = DBManager::getRecord($zestaw->table, $i, "ilosc_potrzebnych_cz");
						DBManager::query('
							UPDATE czesci
							SET ilosc = ilosc - '.$potrzebnaIlosc.'
							WHERE id_czesci = '.$czesc.'
						');
					}
				}
			}
			
			DBManager::query('
				UPDATE zamowienia
				SET status = "'.$status.'"
				WHERE id_zamowienie = '.$orderID.'
			');
			$this->statusChangedCommunicate();
		}
		
		public function setDate($orderID, $date) {
			if($date == '') {
				$date = NULL;
			}
			DBManager::query('
				UPDATE zamowienia
				SET data_wysylki = "'.$date.'"
				WHERE id_zamowienie = '.$orderID.'
			');
			$this->setDateDoneCommunicate();
		}
		
		private function noNameCommunicate() {
			echo '
				<h2>Musisz podać imię i nazwisko lub nazwę firmy!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php" style="position: relative; top: 10px;"><span class="menu_button">Powrót do menu</span></a>
					<a href="dodaj_zamowienie.php?lastPage=zamowienia.php" style="position: relative; top: 10px;"><span class="menu_button">Spróbuj jeszcze raz</span></a>
				</div>
			';
		}
		
		private function insertDoneCommunicate() {
			echo '
				<h2>Zamówienie dodane pomyślnie!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php" style="position: relative; top: 10px;"><span class="menu_button">Powrót do menu</span></a>
					<a href="dodaj_zamowienie.php?lastPage=zamowienia.php" style="position: relative; top: 10px;"><span class="menu_button">Dodaj kolejne zamówienie</span></a>
				</div>
			';
		}
		
		public function deleteQuestionCommunicate($orderID) {
			//<h2>Czy na pewno chcesz usunąć dane zamówienie?</h2>
			echo '
				<div id="menu" style="height: 42px;">
					<a href="delete_order.php?orderID='.$orderID.'&lastPage=zamowienia.php"><span class="menu_button">Tak</span></a>
					<a href="zamowienia.php"><span class="menu_button">Nie</span></a>
				</div>
			';
		}
		
		private function deleteDoneCommunicate() {
			echo '
				<h2>Zamówienie usunięte pomyślnie!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php"><span class="menu_button">Powrót do menu</span></a>
					<a href="zamowienia.php"><span class="menu_button">Powrót do tabeli Zamówienia</span></a>
				</div>
			';
		}
		
		private function statusChangedCommunicate() {
			echo '
				<h2>Status zmieniony pomyślnie!</h2>
				<div id="menu" style="height: 42px;">
					<a href="zamowienia.php"><span class="menu_button">OK</span></a>
				</div>
			';
		}
		
		public function setDateForm($orderID) {
			echo '
				<div class="window">
					<form action="set_date.php?orderID='.$orderID.'&lastPage=zamowienia.php" method="POST" class="form">
						<div id="inputs">
							<input type=text name=data><br />
							<input type=submit name=accept value="Gotowe">
						</div>
						<div id="inputs_names">
							<div id="inputs_text">
								<div class="inputs_name">Data wysyłki:</div>
							</div>
						</div>
					</form>
				</div>
			';
		}
		
		private function setDateDoneCommunicate() {
			echo '
				<h2>Data ustawiona pomyślnie!</h2>
				<div id="menu" style="height: 42px;">
					<a href="menu.php"><span class="menu_button">Powrót do menu</span></a>
					<a href="zamowienia.php"><span class="menu_button">Powrót do tabeli Zamówienia</span></a>
				</div>
			';
		}
	}
?>