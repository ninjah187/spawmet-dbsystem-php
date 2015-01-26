<?php
	class DBManager {
		public function __construct() {
			$this->connect();
		}
		public function connect() {
			mysql_connect('serwer1455044.home.pl', '14431041_spawmet', 'sp4wb4s3');
			@mysql_select_db('14431041_spawmet') or die("Błąd połączenia z bazą danych!");
			//mysql_connect('localhost', 'root', '');
			//@mysql_select_db('spawmet_baza') or die("Błąd połączenia z bazą danych!");
		}
		public function query($query) {
			return mysql_query($query);
		}
		function numberOfRows($table) {
			return mysql_numrows($table);
		}
		function numberOfFields($table) {
			return mysql_num_fields($table);
		}
		function getFieldName($table, $index) {
			return mysql_field_name($table, $index);
		}
		function getRecord($table, $index, $fieldName) {
			return mysql_result($table, $index, $fieldName);
		}
		public function close() {
			mysql_close();
		}
	}
?>