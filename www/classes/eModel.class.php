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
	private $is_buf = false;            # boolean
	private $mysqli = NULL;             # mysqli
	private $buffer = array ();         # array

	final public function __construct ($table = ''){
		global $mysqli;
		$this->mysqli = &$mysqli;
		if (!empty($table)) {$this->setTable($table);}
	}

	public function __set($name, $value) {$this->data[$name] = $this->mysqli->real_escape_string ($value); return true;}
	public function __get($name) {return $this->data[$name];}
	public function __isset($name) {return isset($this->data[$name]);}
	public function __unset($name) {unset($this->data[$name]); return true;}
	
	final public function setDefault(){
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

	final public function bufferQuery($isBuffered = true){
		$this->is_buf = (bool) $isBuffered;
	}

	final public function clearBuffer(){
		$this->setDefault ();
		$this->bufferQuery (false);
		$this->buffer = array ();
	}

	final public function renderBuffer($transaction = true, $union = false){
		$t = '';
		if ($union) {$u = ' UNION ';} else {$u = '; ';}
		foreach ($this->buffer as $query) {
			$t .= $query.$u;
		}
		if ($transaction = true) {
			$t = 'START TRANSACTION;'.$t.'COMMIT;';
		}
		$this->clearBuffer ();
		return $query = $this->mysqli->query ($t);
	}

	final public function setFields(array $myFields){
		foreach ($myFields as &$p) {
			$p = $this->mysqli->real_escape_string ($p);
		}
		$this->fields = $myFields;
	}
	// setting array of table fields
	
	final public function addJoin(array $joinRules){
		
		#!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	}
	
	final public function addCond($field, $value, $sign = '=', $table = NULL){
		if ($table !== NULL) {
			$field = $this->mysqli->real_escape_string ($table).'`.`'.$this->mysqli->real_escape_string ($field);
		} else {
			$field = $this->mysqli->real_escape_string ($field);
		}
		$value = $this->mysqli->real_escape_string ($value);
		$sign = $this->mysqli->real_escape_string ($sign);
		$this->condition [$field] [0] = $value;
		$this->condition [$field] [1] = $sign;
	}
	//add new condition to associative array of condition for WHERE

	final public function setUnion($myUnion){
		$myUnion = $this->mysqli->real_escape_string ($myUnion);
		if ($myUnion == 0 or strtolower($myUnion) == 'or') {
			$myUnion = 'OR';
		} else {
			$myUnion = 'AND';
		}
		$this->union = $myUnion;
	}
	// setting union for condition AND [1] | OR [0]
	
	final public function setData($myData){
		foreach ($myData as &$p) {
			$p = $this->mysqli->real_escape_string ($p);
		}
		$this->data = $myData;
	}
	// setting associative array of data (field->value)
	
	final public function getData(){
		return $this->data;
	}
	// return associative array of data (field->value)
	
	final public function setTable($myTable){
		$this->table = $myTable;
	}
	// setting tablename or array of tablenames
	
	final public function setOrder($myField, $myType = 0){
		$myField = $this->mysqli->real_escape_string ($myField);
		if ($myType == 0 or strtolower($myType) == 'desc') {
			$myType = 'DESC';
		} else {
			$myType = 'ASC';
		}
		$this->order = array($myField, $myType);
	}
	// setting order ASC [1] | DESC [0]
	
	final public function setLimits($myFrom, $myLimit = ''){
		$this->from = (int) $myFrom;
		$this->limit = (int) $myLimit;	
	}
	// setting limits
	
	final public function setSQL($sql){
		$this->sql = $sql;
	}
	// setting SQL-query [no escaping]
	
	final public function setResultType($myAssoc){
		$this->assoc = (boolean) $myAssoc;
	}
	// setting type of result array
	
	final public function getCount(){
		$t = $this->returnQuery ('SELECT COUNT(*) FROM %s WHERE %s %s %s', array('tExist', 'tName', 'cond', 'order', 'limit'));
		$query = $this->mysqli->query ($t);
		$result = $query->fetch_array ();
		return $result [0];
	}
	// return count of records by $sql or $condition as $union
	
	final public function create(){
		$t = $this->returnQuery ('INSERT INTO %s (%s) VALUES (%s)', array('tExist', 'tName', 'i0', 'i1'));
		return $this->r($t, 0);
	}
	// adding new record to $table by $data
	
	final public function readById($id){
		$id = $this->mysqli->real_escape_string ($id);
		$t = $this->returnQuery ("SELECT %s FROM %s WHERE %s AND `id`='$id'", array('tExist', 'fields', 'tName', 'cond'));
		return $this->r($t, 1);		
	}
	// set $data as $fields row by this $id and $condition as $union
	
	final public function readFirst($order = 'id'){
		$t = $this->returnQuery ("SELECT %s FROM %s WHERE %s ORDER BY `$order` ASC LIMIT 1", array('tExist', 'fields', 'tName', 'cond'));
		return $this->r($t, 1);
	}
	// set $data as first $fields row by $sql or $condition as $union
	
	final public function readLast($order = 'id'){
		$t = $this->returnQuery ("SELECT %s FROM %s WHERE %s ORDER BY `$order` DESC LIMIT 1", array('tExist', 'fields', 'tName', 'cond'));
		return $this->r($t, 1);
	}
	// set $data as last $fields row by $sql or $condition as $union
	
	final public function readBy($field, $value){
		$field = $this->mysqli->real_escape_string ($field);
		$value = $this->mysqli->real_escape_string ($value);
		$t = $this->returnQuery ("SELECT %s FROM %s WHERE %s AND `$field`='$value' %s %s", array('tExist', 'fields', 'tName', 'cond', 'order', 'limit'));
		return $this->r($t, 1);
	}
	// set $data as $fields array by this $field $union $value, $order, $from, $limit, $assoc
	
	final public function read($poly = false){
		$t = $this->returnQuery ("SELECT %s FROM %s WHERE %s %s %s", array('tExist', 'fields', 'tName', 'cond', 'order', 'limit'));
		return $this->r($t, 1, $poly);
	}
	// set $data as $fields array by $sql or $condition as $union, $order, $from, $limit, $assoc
	
	final public function update(){
		$t = $this->returnQuery ("SELECT %s FROM %s WHERE %s %s %s", array('tExist', 'fields', 'updates', 'cond', 'order', 'limit'));
		return $this->r($t, 0);
	}
	// update record by $data and $sql or $condition as $union
	
	final public function deleteById($id){
		$id = $this->mysqli->real_escape_string ($id);
		$t = $this->returnQuery ("DELETE FROM %s WHERE %s AND `id`='$id'", array('tExist', 'tName', 'cond', 'order', 'limit'));
		return $this->r($t, 0);
	}
	// delete record by this $id and $condition as $union
	
	final public function deleteBy($field, $value) {
		$field = $this->mysqli->real_escape_string ($field);
		$value = $this->mysqli->real_escape_string ($value);
		$t = $this->returnQuery ("DELETE FROM %s WHERE %s AND `$field`='$value'", array('tExist', 'tName', 'cond', 'order', 'limit'));
		return $this->r($t, 0);
	}
	// delete record by this $field $union $value
	
	final public function delete(){
		$t = $this->returnQuery ("DELETE FROM %s WHERE %s %s %s", array('tExist', 'tName', 'cond', 'order', 'limit'));
		return $this->r($t, 0);
	}
	// delete record by $sql or $condition as $union
	
	final public function search($field = '', $request = ''){
		#$trimmed = ',.!&/\\?;:\'"-=+%_*()^';
		$trans = array("," => " ", '.' => ' ', '!' => ' ', '?' => ' ', '&' => ' ', ';' => ' ', ':' => ' ', '\\' => ' ', '/' => ' ', '\'' => ' ', '"' => ' ', '+' => ' ', '-' => ' ', '=' => ' ', '%' => ' ', '_' => ' ', '*' => ' ', '(' => ' ', ')' => ' ', '^' => ' ');
		$request = trim(strtr($request, $trans));
		$r_array = explode(' ', $request);
		foreach ($r_array as $key => &$value) {
			$value = trim($value);
			if (empty($value)) {unset($r_array [$key]);}
			$value = '`'.$field.'` LIKE \'%'.$value.'%\'';
		}
		$search_sql = implode(' OR ', $r_array);
		$t = $this->returnQuery ("SELECT %s FROM %s WHERE (%s) AND %s %s %s", array('tExist', 'fields', 'tName', 'cond', 'order', 'limit', 'param'), $search_sql);
		return $this->r($t, 1, true);
	}
	// seach by database as LIKE by 
	
	final public function eSearch($titles = array(), $metas = array(), $content = array()){
		
	}
	// extended relevant search ($titles x20, $metas x10, $content x1)
	
	/**
		* 
		* Part of private functions
		* 
	*/

	private function returnQuery ($queryf = '', array $hash = NULL, $param = NULL){
		$args = array ();
		if (in_array('tExist', $hash)) {$this->returnTableExist ();}
		if (in_array('fields', $hash)) {$args [] = $this->returnFields ();}
		if (in_array('tName',  $hash)) {$args [] = $this->returnTablename ();}
		if (in_array('updates',$hash)) {$args [] = $this->returnUpdates ();}
		if (in_array('param',  $hash)) {$args [] = $param;}
		if (in_array('cond',   $hash)) {$args [] = $this->returnCondition ();}
		if (in_array('order',  $hash)) {$args [] = $this->returnOrder ();}
		if (in_array('limit',  $hash)) {$args [] = $this->returnLimits ();}
		if (in_array('i0',     $hash) or in_array('i1',  $hash)) {$inputs = $this->returnInputs ();}
		if (in_array('i0',     $hash)) {$args [] = $inputs [0];}
		if (in_array('i1',     $hash)) {$args [] = $inputs [1];}
		$query = sprintf($queryf, $args [0], $args [1], $args [2], $args [3], $args [4], $args [5]);
		return $query;
	}

	private function r ($t, $type = 0, $poly = false){
		if ($this->is_buf) {
			$this->buffer [] = $t;
		} else {
			if ($type == 0) {
				$query = $this->mysqli->query ($t);
				return $this->mysqli->affected_rows;
			} elseif ($type == 1) {
				$query = $this->mysqli->query ($t);
				$this->returnResult ($query, $poly);
				return true;
			}
		}
	}

	private function returnResult ($query, $poly = false){
		if ($this->assoc) {
			$func = 'fetch_assoc';
		} else {
			$func = 'fetch_array';
		}
		$nums = $query->num_rows;
		if ($nums > 0) {
			if ($nums == 1 and !$poly) {
				$this->data = $query->$func ();
			} else {
				$tmp_data = $query->$func ();
				do {
					$this->data [] = $tmp_data;
				} while ($tmp_data = $query->$func ());
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
				$_fields [] = '`'.$item.'`';
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
					$_conds [] = '`'.$field.'`'.$value [1]."'".$value [0]."'";
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
				if (is_int($i)){
					$_tables [] = '`'.config::PREFIX.$this->mysqli->real_escape_string ($t).'`';
				} else {
					$_tables [] = '`'.config::PREFIX.$this->mysqli->real_escape_string ($t).'` as `'.$i.'`';
				}
			}
			$result = implode(',', $_tables);
			return $result;
		} else {
			return '`'.config::PREFIX.$this->mysqli->real_escape_string ($this->table).'`';
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
			$_updates [] = '`'.$this->mysqli->real_escape_string ($field)."`='".$value."'";
		}
		$result = implode(',', $_updates);
		return $result;
	}

	private function returnInputs () {
		$_fields = array ();
		$_values = array ();
		foreach ($this->data as $field => $value) {
			$_fields [] = '`'.$this->mysqli->real_escape_string ($field).'`';
			$_values [] = "'".$value."'";
		}
		$result [0] = implode(',', $_fields);
		$result [1] = implode(',', $_values);
		return $result;
	}

}
?>