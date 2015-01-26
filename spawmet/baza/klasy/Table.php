<?php
	include 'DBManager.php';
	class Table extends DBManager {
		public $table;
		protected $numberOfFields;
		public $numberOfRows;
		
		public function __construct($selectQuery) {
			DBManager::__construct();
			$this->table = DBManager::query($selectQuery);
			$this->numberOfFields = DBManager::numberOfFields($this->table);
			$this->numberOfRows = DBManager::numberOfRows($this->table);
		}
		
		/*function showTable() {
			echo '<table cellspacing="0">';
			for($i = 0; $i < $this->numberOfRows; $i++) {
				if($i % 30 == 0) {
					echo '<tr class="table_header">';
					echo '<td>Nr</td>';
					for($j = 0; $j < $this->numberOfFields; $j++) {
						echo '<td>'.DBManager::getFieldName($this->table, $j).'</td>';
					}
					echo '</tr>';
				}
				echo '<tr>';
				echo '<td>'.($i + 1).'</td>';
				for($j = 0; $j < $this->numberOfFields; $j++) {
					echo '<td>'.DBManager::getRecord($this->table, $i, DBManager::getFieldName($this->table, $j)).'</td>';
				}
				echo '</tr>';
			}
			echo '</table>';
		}*/
		
		function showTableWithoutOptions() {
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
				for($j = 0; $j < $this->numberOfFields; $j++) {
					$record = DBManager::getRecord($this->table, $i, DBManager::getFieldName($this->table, $j));
					if($record == NULL) {
						$record = '-';
					}
					echo '<td>'.$record.'</td>';
				}
			}
			echo '</table>';
		}
	}
?>