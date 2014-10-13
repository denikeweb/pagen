<?php
	/**
	 * @author Denis Dragomiric <den@lux-blog.org>
	 * @version Pagen 1.1
	 */
	class Cnd {
		private $field;
		private $value;
		private $table1;
		private $table2;
		private $sign;

		function __construct () {
			return $this;
		}

		public function setType ($union = 'AND') {

			return true;
		}

		public function setCond ($field, $value, $table1 = NULL, $table2 = NULL, $sign = '=') {
			$this->field = $field;
			$this->value = $value;
			$this->table1 = $table1;
			$this->table2 = $table2;
			$this->sign = $sign;


			if ($table1 !== NULL) {
				$field = \config::PREFIX.$this->mysqli->real_escape_string ($table1).'`.`'.$this->mysqli->real_escape_string ($field);
			} else {
				$field = $this->mysqli->real_escape_string ($field);
			}
			if ($table2 !== NULL) {
				$value = \config::PREFIX.$this->mysqli->real_escape_string ($table2).'`.`'.$this->mysqli->real_escape_string ($value);
			} else {
				$value = $this->mysqli->real_escape_string ($value);
			}
			$sign = $this->mysqli->real_escape_string ($sign);
			$this->condition [$field] [0] = $value;
			$this->condition [$field] [1] = $sign;

			if (strpos($value [0], '`.`') > 0) {$tmp = "`".$value [0]."`";} else {$tmp = "'".$value [0]."'";}
			$_conds [] = '`'.$field.'`'.$value [1].$tmp;
		}

		public function getSQL () {

			return true;
		}
	}