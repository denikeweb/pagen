<?php
abstract class eModel {
	/**
	*	Pagen Model parrent class
	*	Pagen v1.0
	*
	*/
	
	private $fields = array ();         # array
	private $condition = array ();      # assoc array
	private $data = array ();           # assoc array
	private $table = '';                # string || array
	private $order = array('', '');     # array (2)
	private $from = '';                 # integer/empty string
	private $limit = '';                # integer/empty string
	private $sql = '';                  # string
	private $union = 'AND';             # string
	private $assoc = true;              # boolean
	
	public function setFields($myFields){
		foreach ($myFields as $p) {
			$p = addslashes($p);
		}
		$this->fields = $myFields;
	}
	// setting array of table fields
	
	public function setConditions($myConditions){
		foreach ($myConditions as $k => $p) {
			$k = addslashes($k);
			$p = addslashes($p);
		}
		$this->condition = $myConditions;
	}
	// setting associative array of condition for WHERE (field->value)
	
	public function addCondition($field, $value, $sign = '='){
		$field = addslashes($field);
		$value = addslashes($value);
		$sign = addslashes($sign);
		$this->condition [$field] = $value;
		$this->condition [$field] [0] = $sign;
	}
	//add new condition to associative array of condition for WHERE

	public function setUnion($myUnion){
		$this->union = $myUnion;
	}
	// setting union for condition
	
	public function setData($myData){
		foreach ($myData as $p) {
			$p = addslashes($p);
		}
		$this->data = $myData;
	}
	// setting associative array of data (field->value)
	
	public function getData(){
		return $this->data;
	}
	// return associative array of data (field->value)
	
	public function setTable($myTable){
		$this->table = $myTable;
	}
	// setting tablename
	
	public function setOrder($myField, $myType){
		$this->order = array($myField, $myType);
	}
	// setting order
	
	public function setLimits($myFrom, $myLimit){
		$this->from = $myFrom;
		$this->limit = $myLimit;	
	}
	// setting limits
	
	public function setSQL($mySQL){
		$this->sql = $mySQL;
	}
	// setting SQL-query
	
	public function setResultType($myAssoc){
		$this->assoc = $myAssoc;
	}
	// setting type of result array
	
	public function getCount(){
	
	}
	// return count of records by $sql or $condition as $union
	
	public function create(){
		
	}
	// adding new record to $table by $data
	
	public function readById($id){
		
	}
	// set $data as $fields row by this $id and $condition as $union
	
	public function readFirst(){
		
	}
	// set $data as first $fields row by $sql or $condition as $union
	
	public function readLast($order = 'id'){
		$this->returnTableExist ();
		$all = $this->returnFields ();
		$conditions = $this->returnCondition ();
		$tablename = $this->returnTablename ();
		echo $t = "SELECT $all FROM $tablename WHERE $conditions ORDER BY `$order` DESC LIMIT 1";
		$query = mysql_query($t);
		$this->returnResult ($query);
	}
	// set $data as last $fields row by $sql or $condition as $union
	
	public function readBy($field, $value){
		
	}
	// set $data as $fields array by this $field $union $value, $order, $from, $limit, $assoc
	
	public function read(){
		
	}
	// set $data as $fields array by $sql or $condition as $union, $order, $from, $limit, $assoc
	
	public function update(){
		
	}
	// update record by $data and $sql or $condition as $union
	
	public function deleteById($id){
		
	}
	// delete record by this $id and $condition as $union
	
	public function deleteBy($field, $value){
		
	}
	// delete record by this $field $union $value
	
	public function delete(){
		
	}
	// delete record by $sql or $condition as $union
	
	public function search($search = array()){
		
	}
	// seach by database as LIKE by 
	
	public function eSearch($titles = array(), $metas = array(), $content = array()){
		
	}
	// extended relevant search ($titles x20, $metas x10, $content x1)
	
	private function returnResult ($query){
		if ($this->assoc) {
			$func = 'mysql_fetch_assoc';
		} else {
			$func = 'mysql_fetch_array';
		}
		if (mysql_num_rows($query) > 0) {
			$this->data = $func($query);
		}
	}

	private function returnTableExist () {
		if (empty($this->table)) {
			die ('Your tablename is not exist');
		}
	}

	private function returnFields () {
		return '*';
	}

	private function returnCondition () {
		return 1;
	}

	private function returnTablename () {
		if (is_array($this->table)) {
			$tables = array ();
			foreach ($this->table as $i => $t) {
				$tables [$i] = '`'.config::PREFIX.$t.'`';
			}
			 $result = implode(',', $tables);
			return $result;
		} else {
			return '`'.config::PREFIX.$this->table.'`';
		}
	}

	private function returnOrder () {
		$order = '';
		if (!empty($this->order [0]) and !empty($this->order [1])) {
			$order = "ORDER BY `{$this->order [0]}` {$this->order [1]}";
		}
		return $order;
	}

}
?>