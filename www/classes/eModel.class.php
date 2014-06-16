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
	private $table = '';                # string
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
	
	public function setCondition($myCondition){
		$this->condition = $myCondition;
	}
	// setting associative array of condition for WHERE (field->value)
	
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