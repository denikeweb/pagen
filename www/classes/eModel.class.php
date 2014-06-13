<?php
class eModel {
	/**
	*	Pagen Model parrent class
	*	Pagen v1.0
	*
	*/
	
	public $fields = array ();         # array
	public $condition = array ();      # assoc array
	public $data = array ();           # assoc array
	public $table = '';                # string
	public $order = array('', '');     # array (2)
	public $from = '';                 # integer/empty string
	public $limit = '';                # integer/empty string
	public $sql = '';                  # string
	public $union = 'AND';             # string
	public $assoc = true;              # boolean
	
	public function setFields($myFields){
		$this->fields = $myFields;
	}
	// setting array of table fields
	
	public function setCondition($myCondition){
		$this->condition = $myCondition;
	}
	// setting associative array of condition for WHERE (field->value)
	
	public function setUnion($myUnion){
		$this->union = $myUnion;
	}
	// setting union for condition
	
	public function setData($myData){
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
	
	public function readLast(){
		
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
	
}
?>