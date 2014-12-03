<?php
/**
 * Created by PhpStorm.
 * User: Денис
 * Date: 24.10.2014
 * Time: 21:59
 */

namespace Annex;


class Data {
	private $year;
	private $month;
	private $day;
	private $date;
	private $from = '1970-01-01';
	private $to   = '2025-01-01';

	/**
	 * @param null $year
	 * @param null $month
	 * @param null $day
	 */
	function __construct ($year = NULL, $month = NULL, $day = NULL) {
		$this->year  = $year;
		$this->month = $month;
		$this->day   = $day;
		$this->date  = $this->year.'-'.$this->month.'-'.$this->day;
		$this->date = date ('Y-m-d', strtotime ($this->date));
		if ($month === NULL and $day === NULL) {
			$this->date = $year;
		}
	}

	function getDate ($format = 'Y-m-d') {return date ($format, strtotime ($this->date));}
	function getFrom () {return $this->from;}
	function getTo () {return $this->to;}

	function placeConditionDate () {
		if (!is_null($this->year)) {
			$this->from = $this->year;
			$this->to   = $this->year;
			if (!is_null($this->month)) {
				if (!is_null($this->day)) {
					$this->from .= '-'.$this->month.'-'.$this->day;
					$this->to   .= '-'.$this->month.'-'.$this->day;
				} else {
					$this->from .= '-'.$this->month.'-01';
					if ($this->month == 12) {
						$this->to .= '-12-31';
					} else
						$this->to .= '-'.($this->month + 1).'-0';
				}
			} else {
				$this->from .= '-01-01';
				$this->to   .= '-12-31';
			}
		}
		$this->from = date ('Y-m-d', strtotime ($this->from));
		$this->to   = date ('Y-m-d', strtotime ($this->to));
	}

	/**
	 *
	 * Проверяет год на высокосность
	 *
	 * @return bool
	 */
	private function isLeapYear () {
		return (($this->year % 4 == 0 and $this->year % 100 != 0) or ($this->year % 400 == 0));
	}

	public function getYear () {return date("Y", strtotime($this->date));}
	public function getMonth () {return date("m", strtotime($this->date));}
	public function getDay () {return date("d", strtotime($this->date));}
	public function getWeekDay () {
		switch (date("w", strtotime($this->date))) {
			case 0 : $tmpTitle = 'Воскресенье'; break;
			case 1 : $tmpTitle = 'Понедельник'; break;
			case 2 : $tmpTitle = 'Вторник'; break;
			case 3 : $tmpTitle = 'Среда'; break;
			case 4 : $tmpTitle = 'Четверг'; break;
			case 5 : $tmpTitle = 'Пятница'; break;
			case 6 : $tmpTitle = 'Суббота'; break;
			default : $tmpTitle = 'Ошибка'; break;
		}
		return $tmpTitle;
	}
	public function getMonthName () {
		switch (date("m", strtotime($this->date))) {
			case 1 : $tmpTitle = 'Января'; break;
			case 2 : $tmpTitle = 'Февраля'; break;
			case 3 : $tmpTitle = 'Марта'; break;
			case 4 : $tmpTitle = 'Апреля'; break;
			case 5 : $tmpTitle = 'Мая'; break;
			case 6 : $tmpTitle = 'Июня'; break;
			case 7 : $tmpTitle = 'Июля'; break;
			case 8 : $tmpTitle = 'Августа'; break;
			case 9 : $tmpTitle = 'Сентября'; break;
			case 10 : $tmpTitle = 'Октября'; break;
			case 11 : $tmpTitle = 'Ноября'; break;
			case 12 : $tmpTitle = 'Декабря'; break;
			default : $tmpTitle = 'Ошибка'; break;
		}
		return $tmpTitle;
	}
} 