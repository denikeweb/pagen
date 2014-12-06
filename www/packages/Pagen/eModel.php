<?php
	/**
	 *	Pagen Model parrent class
	 *  @author Denis Dragomiric <den@lux-blog.org>
	 *	@version Pagen 1.1.6
	 */
	namespace Pagen;

	abstract class eModel {
		private $fields = array ();         # array
		private $condition = array ();      # assoc array
		private $joins = array ();      	# assoc array
		private $data = array ();           # assoc array
		private $table = '';                # string || array
		private $order = array('', '');     # array (2)
		private $from = NULL;               # integer/NULL
		private $limit = NULL;              # integer/NULL
		private $sql = '';                  # string
		private $union = 'AND';             # string
		private $assoc = true;              # boolean
		private $is_buf = false;            # boolean
		protected  $mysqli = NULL;          # mysqli
		private $buffer = array ();         # array
		private $debug = false;
		private $lock = false;

		public function __construct ($table = ''){
			$this->mysqli = &DataBase::$mysqli;
			if (!empty($table)) {$this->setTable($table);}
		}

		public function __set($name, $value) {$this->data[$name] = $this->mysqli->real_escape_string ((string) $value);	return true;}
		public function __get($name) {return $this->data[$name];}
		public function __isset($name) {return isset($this->data[$name]);}
		public function __unset($name) {unset($this->data[$name]); return true;}
		public function debug ($bool = true) {$this->debug = (bool) $bool;}
		public function lock  ($bool = true) {$this->lock = (bool) $bool;}

		final public function setDefault(){
			#$this->table = '';
			$this->fields = array ();
			$this->condition = array ();
			$this->joins = array ();
			$this->data = array ();
			$this->order = array('', '');
			$this->from = NULL;
			$this->limit = NULL;
			$this->sql = '';
			$this->union = 'AND';
			$this->assoc = true;
		}
		//set default options

		public function mngItem ($key = NULL, $info = '', $replace = false, $many = false) {
			if ($replace) {
				if ($many) {
					if (count($this->data) > 0)
						foreach ($this->data as &$data) {
							$data [$key] = $data [$info];
						}
				} else {
					$this->data [$key] = $this->data [$info];
				}
			} else {
				$this->data [$key] = $info;
			}
		}

		final public function bufferQuery($isBuffered = true){
			$this->is_buf = (bool) $isBuffered;
		}

		final public function clearBuffer(){
			$this->setDefault ();
			$this->bufferQuery (false);
			$this->buffer = array ();
		}

		final public function renderBuffer($transaction = true, $union = false, $contents = false){
			if ($union) {$u = ' UNION ';} else {$u = '; ';}
			$t = implode($u, $this->buffer);
			if (!$union) {$t .= $u;}
			if ($transaction) {
				$t = "START TRANSACTION; \n".$t." \n COMMIT; \n";
			}
			$this->clearBuffer ();
			if ($this->debug) {
				echo $t;
				#return false;
			}

			if ($this->lock) {return false;}

			$query = $this->mysqli->multi_query ($t);
			if ($contents) {
				if ($this->assoc) {
					$func = 1;
				} else {
					$func = 2;
				}
				$nums = $query->num_rows;
				if ($nums > 0 or true) {
					do {
						if ($res = $this->mysqli->store_result()) {
							$this->data [] = $res->fetch_all($func);
							$res->free();
						}
					} while ($this->mysqli->more_results() && $this->mysqli->next_result());
				}
			}
			return $query;
		}

		final public function addBuffer ($expression) {
			$this->buffer [] = $expression;
			$this->setDefault ();
		}

		final public function setFields(array $myFields){
			foreach ($myFields as &$p) {
				$p = $this->mysqli->real_escape_string ($p);
			}
			$this->fields = $myFields;
		}
		// setting array of table fields

		final public function addJoin($table1, $id1, $table2, $id2, $type = 'INNER'){
			$this->joins [] = ' '.$type.' JOIN `'.\config::PREFIX.$table2.'` ON `'
				.\config::PREFIX."$table1`.`$id1` = `".\config::PREFIX."$table2`.`$id2` ";
		}

		final public function addConditions($cond){
			$this->condition [] = $cond->process();
		}

		final public function addCond($field, $value, $table1 = NULL, $table2 = NULL, $sign = '='){
			$this->condition [] = (new Cdn ())->setCond ($field, $value, $table1, $table2, $sign);
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

		final public function setOrder($myField, $myType = 0, $table = NULL){
			$myField = $this->mysqli->real_escape_string ($myField);
			if ($table !== NULL)
				$table = $this->mysqli->real_escape_string ($table);
			if ($myType == '0' or strtolower($myType) == 'desc') {
				$myType = 'DESC';
			} else {
				$myType = 'ASC';
			}
			$this->order = array($myField, $myType, $table);
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
			$this->assoc = $myAssoc; # 0 - rows | 1 - assoc | 2 - array
		}
		// setting type of result array

		final public function getCount(){
			$t = $this->returnQuery ('SELECT COUNT(*) FROM %s WHERE %s %s', array('tExist', 'tName', 'cond', 'order'));
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
			$t = $this->returnQuery ("SELECT %s FROM %s %s WHERE %s AND `id`='$id'", array('tExist', 'fields', 'join', 'tName', 'cond'));
			return $this->r($t, 1);
		}
		// set $data as $fields row by this $id and $condition as $union

		final public function readFirst($order = 'id'){
			$t = $this->returnQuery ("SELECT %s FROM %s %s WHERE %s ORDER BY `$order` ASC LIMIT 1", array('tExist', 'fields', 'join', 'tName', 'cond'));
			return $this->r($t, 1);
		}
		// set $data as first $fields row by $sql or $condition as $union

		final public function readLast($order = 'id'){
			$t = $this->returnQuery ("SELECT %s FROM %s %s WHERE %s ORDER BY `$order` DESC LIMIT 1", array('tExist', 'fields', 'join', 'tName', 'cond'));
			return $this->r($t, 1);
		}
		// set $data as last $fields row by $sql or $condition as $union

		final public function readBy($field, $value){
			$field = $this->mysqli->real_escape_string ($field);
			$value = $this->mysqli->real_escape_string ($value);
			$t = $this->returnQuery ("SELECT %s FROM %s %s WHERE %s AND `$field`='$value' %s %s", array('tExist', 'fields', 'join', 'tName', 'cond', 'order', 'limit'));
			return $this->r($t, 1);
		}
		// set $data as $fields array by this $field $union $value, $order, $from, $limit, $assoc

		final public function read($poly = false){
			$t = $this->returnQuery ("SELECT %s FROM %s %s WHERE %s %s %s", array('tExist', 'fields', 'join', 'tName', 'cond', 'order', 'limit'));
			return $this->r($t, 1, $poly);
		}
		// set $data as $fields array by $sql or $condition as $union, $order, $from, $limit, $assoc

		final public function update(){
			$t = $this->returnQuery ("UPDATE %s SET %s %s WHERE %s %s %s", array('tExist', 'tName', 'updates', 'join', 'cond', 'order', 'limit'));
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
			$trans = array("," => " ", '.' => ' ', '!' => ' ', '?' => ' ', '&' => ' ', ';' => ' ',
				':' => ' ', '\\' => ' ', '/' => ' ', '\'' => ' ', '"' => ' ', '+' => ' ', '-' => ' ',
				'=' => ' ', '%' => ' ', '_' => ' ', '*' => ' ', '(' => ' ', ')' => ' ', '^' => ' ');
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
			if (in_array('join',   $hash)) {$args [] = $this->returnJoins ();}
			if (in_array('param',  $hash)) {$args [] = $param;}
			if (in_array('cond',   $hash)) {$args [] = $this->returnCondition ();}
			if (in_array('order',  $hash)) {$args [] = $this->returnOrder ();}
			if (in_array('limit',  $hash)) {$args [] = $this->returnLimits ();}
			if (in_array('i0',     $hash) or in_array('i1',  $hash)) {
				$inputs = $this->returnInputs ();
				if (in_array('i0', $hash)) {$args [] = $inputs [0];}
				if (in_array('i1', $hash)) {$args [] = $inputs [1];}
			}
			$query = sprintf($queryf, $args [0], $args [1], $args [2], $args [3], $args [4], $args [5]);
			if ($this->debug) {echo $query;}
			return $query;
		}

		private function r ($t, $type = 0, $poly = false){
			if ($this->is_buf) {
				$this->addBuffer($t);
			} else {
				if ($this->lock) {return false;}
				if ($type == 0) {
					$this->mysqli->query ($t);
					return $this->mysqli->affected_rows;
				} elseif ($type == 1) {
					$query = $this->mysqli->query ($t);
					$this->returnResult ($query, $poly);
					return true;
				}
			}
		}

		private function returnResult ($query, $poly = false){
			switch ($this->assoc){
				case 0 : $func = 'fetch_row'; break;
				case 1 : $func = 'fetch_assoc'; break;
				case 2 : $func = 'fetch_array'; break;
				default : $func = 'fetch_assoc';
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
				foreach ($this->fields as $key => $item) {
					if (!is_int($key)) {
						$_fields [] = '`'.\config::PREFIX.$item.'`.`'.$key.'`';
					} else {
						$_fields [] = '`'.$item.'`';
					}
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
					$_conds = [];
					foreach ($this->condition as $item) $_conds [] = $item->getSQL ();
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
						$_tables [] = '`'.\config::PREFIX.$this->mysqli->real_escape_string ($t).'`';
					} else {
						$_tables [] = '`'.\config::PREFIX.$this->mysqli->real_escape_string ($t).'` as `'.$i.'`';
					}
				}
				$result = implode(',', $_tables);
				return $result;
			} else {
				return '`'.\config::PREFIX.$this->mysqli->real_escape_string ($this->table).'`';
			}
		}

		private function returnOrder () {
			$order = '';
			if (!empty($this->order [0]) and !empty($this->order [1])) {
				if (is_array($this->table)) {
					$orderTable = $this->table[0];
				} else {
					$orderTable = $this->table;
				}
				if (!empty($this->order [2]))
					$orderTable = $this->order [2];
				$order = "ORDER BY `".\config::PREFIX."$orderTable`.`{$this->order [0]}` {$this->order [1]}";
			}
			return $order;
		}

		private function returnLimits () {
			$limits = '';
			if ($this->from !== NULL) {
				$limits = 'LIMIT '.$this->from;
				if ($this->limit != 0) {
					$limits .= ','.$this->limit;
				}
			}
			return $limits;
		}

		private function returnJoins (){
			return implode('', $this->joins);
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