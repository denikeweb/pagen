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
	
	public function setDefault(){
		#$this->table = '';           
		$this->fields = array ();    
		$this->condition = array (); 
		$this->data = array ();      
		$this->order = array('', '');
		$this->from = '';            
		$this->limit = '';           
		$this->sql = '';             
		$this->union = 'AND';        
		$this->assoc = true;         
	}
	//set default options
	
	public function setFields($myFields){
		foreach ($myFields as &$p) {
			$p = mysql_real_escape_string($p);
		}
		$this->fields = $myFields;
	}
	// setting array of table fields
	
	/*public function setConditions($myConditions){
		foreach ($myConditions as $k => $p) {
			$k = mysql_real_escape_string($k);
			$p = mysql_real_escape_string($p);
		}
		$this->condition = $myConditions;
	}
	// setting associative array of condition for WHERE (field->value)*/
	
	public function addCond($field, $value, $sign = '='){
		$field = mysql_real_escape_string($field);
		$value = mysql_real_escape_string($value);
		$sign = mysql_real_escape_string($sign);
		$this->condition [$field] [0] = $value;
		$this->condition [$field] [1] = $sign;
	}
	//add new condition to associative array of condition for WHERE

	public function setUnion($myUnion){
		$myUnion = mysql_real_escape_string($myUnion);
		if ($myUnion == 0 or strtolower($myUnion) == 'or') {
			$myUnion = 'OR';
		} else {
			$myUnion = 'AND';
		}
		$this->union = $myUnion;
	}
	// setting union for condition AND [1] | OR [0]
	
	public function setData($myData){
		foreach ($myData as &$p) {
			$p = mysql_real_escape_string($p);
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
	// setting tablename or array of tablenames
	
	public function setOrder($myField, $myType){
		$myField = mysql_real_escape_string($myField);
		if ($myType == 0 or strtolower($myType) == 'desc') {
			$myType = 'DESC';
		} else {
			$myType = 'ASC';
		}
		$this->order = array($myField, $myType);
	}
	// setting order ASC [1] | DESC [0]
	
	public function setLimits($myFrom, $myLimit = ''){
		$this->from = (int) $myFrom;
		$this->limit = (int) $myLimit;	
	}
	// setting limits
	
	public function setSQL($mySQL){
		$this->sql = $mySQL;
	}
	// setting SQL-query [no escaping]
	
	public function setResultType($myAssoc){
		$this->assoc = (boolean) $myAssoc;
	}
	// setting type of result array
	
	public function getCount(){
		$this->returnTableExist ();
		$conditions = $this->returnCondition ();
		$tablename = $this->returnTablename ();
		$limits = $this->returnLimits ();
		$order = $this->returnOrder ();
		$t = "SELECT COUNT(*) FROM $tablename WHERE $conditions $order $limits";
		$query = mysql_query($t);
		$result = mysql_fetch_array($query);
		return $result [0];
	}
	// return count of records by $sql or $condition as $union
	
	public function create(){
		$this->returnTableExist ();
		$tablename = $this->returnTablename ();
		$inputs = $this->returnInputs ();
		$fields = $inputs [0];
		$values = $inputs [1];
		$t = "INSERT INTO $tablename ($fields) VALUES ($values)";
		$query = mysql_query($t);
		return $query;
	}
	// adding new record to $table by $data
	
	public function readById($id){
		$id = addslashes($id);
		$this->returnTableExist ();
		$all = $this->returnFields ();
		$conditions = $this->returnCondition ();
		$tablename = $this->returnTablename ();
		$t = "SELECT $all FROM $tablename WHERE $conditions AND `id`='$id' LIMIT 1";
		$query = mysql_query($t);
		$this->returnResult ($query);		
	}
	// set $data as $fields row by this $id and $condition as $union
	
	public function readFirst($order = 'id'){
		$this->returnTableExist ();
		$all = $this->returnFields ();
		$conditions = $this->returnCondition ();
		$tablename = $this->returnTablename ();
		$t = "SELECT $all FROM $tablename WHERE $conditions ORDER BY `$order` ASC LIMIT 1";
		$query = mysql_query($t);
		$this->returnResult ($query);
	}
	// set $data as first $fields row by $sql or $condition as $union
	
	public function readLast($order = 'id'){
		$this->returnTableExist ();
		$all = $this->returnFields ();
		$conditions = $this->returnCondition ();
		$tablename = $this->returnTablename ();
		$t = "SELECT $all FROM $tablename WHERE $conditions ORDER BY `$order` DESC LIMIT 1";
		$query = mysql_query($t);
		$this->returnResult ($query);
	}
	// set $data as last $fields row by $sql or $condition as $union
	
	public function readBy($field, $value){
		$field = addslashes($field);
		$value = addslashes($value);
		$this->returnTableExist ();
		$all = $this->returnFields ();
		$conditions = $this->returnCondition ();
		$tablename = $this->returnTablename ();
		$limits = $this->returnLimits ();
		$order = $this->returnOrder ();
		$t = "SELECT $all FROM $tablename WHERE $conditions AND `$field`{$this->union}'$value' $order $limits";
		$query = mysql_query($t);
		$this->returnResult ($query);
	}
	// set $data as $fields array by this $field $union $value, $order, $from, $limit, $assoc
	
	public function read(){
		$this->returnTableExist ();
		$all = $this->returnFields ();
		$conditions = $this->returnCondition ();
		$tablename = $this->returnTablename ();
		$limits = $this->returnLimits ();
		$order = $this->returnOrder ();
		$t = "SELECT $all FROM $tablename WHERE $conditions $order $limits";
		$query = mysql_query($t);
		$this->returnResult ($query);
	}
	// set $data as $fields array by $sql or $condition as $union, $order, $from, $limit, $assoc
	
	public function update(){
		$this->returnTableExist ();
		$tablename = $this->returnTablename ();
		$conditions = $this->returnCondition ();
		$updates = $this->returnUpdates ();
		$t = "UPDATE $tablename SET $updates WHERE $conditions";
		$query = mysql_query($t);
		return $query;
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
		$nums = mysql_num_rows($query);
		if ($nums > 0) {
			if ($nums == 1) {
				$this->data = $func($query);
			} else {
				$tmp_data = $func($query);
				do {
					array_push($this->data, $tmp_data);
				} while ($tmp_data = $func($query));
			}
		}
	}

	private function returnTableExist () {
		if (empty($this->table)) {
			die ('Your tablename is not exist');
		}
	}

	private function returnFields () {
		if (count($this->fields) == 0) {
			return '*';
		} else {
			$_fields = array();
			foreach ($this->fields as $item) {
				array_push($_fields, '`'.$item.'`');
			}
			$result = implode(',', $_fields);
			return $result;
		}
	}

	private function returnCondition () {
		if (empty($this->sql)) {
			if (count($this->condition) == 0) {
				return 1;
			} else {
				$_conds = array();
				foreach ($this->condition as $field => $value) {
					array_push($_conds, '`'.$field.'`'.$value [1]."'".$value [0]."'");
				}
				$glue = ' '.$this->union.' ';
				$result = implode($glue, $_conds);
				return $result;
			}
		} else {
			return $this->sql;
		}
	}

	private function returnTablename () {
		if (is_array($this->table)) {
			$_tables = array ();
			foreach ($this->table as $i => $t) {
				$_tables [$i] = '`'.config::PREFIX.mysql_real_escape_string($t).'`';
			}
			$result = implode(',', $_tables);
			return $result;
		} else {
			return '`'.config::PREFIX.mysql_real_escape_string($this->table).'`';
		}
	}

	private function returnOrder () {
		$order = '';
		if (!empty($this->order [0]) and !empty($this->order [1])) {
			$order = "ORDER BY `{$this->order [0]}` {$this->order [1]}";
		}
		return $order;
	}

	private function returnLimits () {
		$limits = '';
		if (!empty($this->from)) {
			$limits = 'LIMIT '.$this->from;
			if (!empty($this->limit)){
				$limits .= ','.$this->limit;
			}
		}
		return $limits;
	}

	private function returnUpdates () {
		$_updates = array ();
		foreach ($this->data as $field => $value) {
			array_push($_updates, '`'.mysql_real_escape_string($field)."`='".$value."'");
		}
		$result = implode(',', $_updates);
		return $result;
	}

	private function returnInputs () {
		$_fields = array ();
		$_values = array ();
		foreach ($this->data as $field => $value) {
			array_push($_fields, '`'.mysql_real_escape_string($field).'`');
			array_push($_values, "'".$value."'");
		}
		$result [0] = implode(',', $_fields);
		$result [1] = implode(',', $_values);
		return $result;
	}

}
?>