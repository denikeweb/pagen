<?php
	/**
	 * @author Denis Dragomiric <den@lux-blog.org>
	 * @version Pagen 1.1
	 */
	class Cdn {
		private $field;
		private $value;
		private $table1;
		private $table2;
		private $sign;

		private $cdnObj;
		private $parent;
		private $condition;
		private $union;

		function __construct () {
			if (func_num_args () != 0)
				$this->cdnObj = func_get_args();
			return $this;
		}

		/**
		 * @param string $union
		 *
		 * @return $this
		 */
		public function setType ($union = 'AND') {
			if ($union == 0 or strtolower($union) == 'or') {$this->union = 'OR';} else $this->union = 'AND';
			return $this;
		}

		/**
		 * @param null $parent
		 *
		 * @return bool
		 */
		public function process ($parent = NULL) {
			$this->parent = $parent;
			if (!is_null($this->cdnObj)) {
				foreach ($this->cdnObj as $cdn) {
					$cdn->process ($this);
				}
			}
			if ($this->hasParent ()) {
				$_conds = [];
				foreach ($this->getParent()->getCdnObj () as $cdn) {
					$_conds [] = $cdn->getSQL ();
				}
				$this->getParent()->setSQL ('('.implode(' '.$this->getParent()->getUnion ().' ', $_conds).')');
			}
			return $this;
		}

		/**
		 * Set condition
		 *
		 * @param        $field
		 * @param        $value
		 * @param null   $table1
		 * @param null   $table2
		 * @param string $sign
		 *
		 * @return $this
		 */
		public function setCond ($field, $value = NULL, $table1 = NULL, $table2 = NULL, $sign = '=') {
			$this->field  = $field;
			$this->value  = $value;
			$this->table1 = $table1;
			$this->table2 = $table2;
			$this->sign   = $sign;
			$this->condition = $this->generateSQL ();
			return $this;
		}

		/**
		 * return generated SQL condition
		 *
		 * #table-prefix == 'pagen_';
		 * setCond ('id', 12)                                   => `id`='12'
		 * setCond ('id', 12, 'blog')                           => `pagen_blog`.`id`='12'
		 * setCond ('id', 'cat_id', 'blog', 'categories')       => `pagen_blog`.`id`=`pagen_categories`.`cat_id`
		 * setCond ('id', 'cat_id', 'blog', 'categories', '!=') => `pagen_blog`.`id`!=`pagen_categories`.`cat_id`
		 * setCond ('id', 12, NULL, NULL, '<')                  => `id`<'12'
		 * setCond ("`pagen_blog`.`id`>'12' AND `pagen_blog`.`title` LIKE '%today%'") => Pagen duplicate sinle parameter
		 *
		 * @return string
		 */
		private function generateSQL () {
			if (is_null($this->value)) return $this->field;
			$left = '';
			$right = '';
			if (!is_null($this->table1) && is_null($this->table2)) {
				$left = '`'.DataBase::$mysqli->real_escape_string($this->table1).'`.`'
							.DataBase::$mysqli->real_escape_string($this->field).'`';
				$right = "'".DataBase::$mysqli->real_escape_string($this->value)."'";
			}
			if (!is_null($this->table1) && !is_null($this->table2)) {
				$left = '`'.DataBase::$mysqli->real_escape_string($this->table1).'`.`'
					.DataBase::$mysqli->real_escape_string($this->field).'`';
				$right = '`'.DataBase::$mysqli->real_escape_string($this->table2).'`.`'
					.DataBase::$mysqli->real_escape_string($this->value).'`';
			}
			if (is_null($this->table1) && is_null($this->table2)) {
				$left = '`'.DataBase::$mysqli->real_escape_string($this->field).'`';
				$right = "'".DataBase::$mysqli->real_escape_string($this->value)."'";
			}
			return $left.$this->sign.$right;
		}

		public function getSQL () {return $this->condition;}
		public function getCdnObj () {return $this->cdnObj;}
		public function getParent () {return $this->parent;}
		public function getUnion () {return $this->union;}
		public function setSQL ($sql) {$this->condition = $sql;}
		private function hasParent () {return !is_null($this->parent);}
	}