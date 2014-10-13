<?php
	/**
	 * @author Denis Dragomiric <den@lux-blog.org>
	 * @version Pagen 0.4
	 */
abstract class RandKey {
	const LN = 62;
	const KEYC = "AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789";
	private static function get_ctrl($key){
		$ctrl = NULL;
		switch ($key){
			case 1:  $ctrl = "q1LExINeSXhG68ayoPFjHtDgZfuRnzMd3rKAsvlViY95J4C2bQWTUpmOkw0B7c"; break;
			case 2:  $ctrl = "ie7wGm6Vyv9rUBD4CTkR2HJFd03gSYQoWL85ZhlNsxAbzcpKOEjfaPXtInqMu1"; break;
			case 3:  $ctrl = "Rc36n42ozHTtsYNZg5GJWQlBUFMbwedOKAmjqSVuPxEI9CpLry1DaXh0ki8v7f"; break;
			case 4:  $ctrl = "3pTikLI5dU6ugV4OSvDenQRAZJEzbcX7Mo9GqBCWwlsHPh2xjrNy0Y1fFKmt8a"; break;
			case 5:  $ctrl = "uoFR0NJscvUhzIaq12Xj5BKkEDnVYe97pyOlTgCAHZiw4tmPQd6fSW83MGxLrb"; break;
			case 6:  $ctrl = "yvYChN8tX3KSB6ZH0RwFexDaou7Jn4pOcP2WA5mgiVbkQzdsMrIE1TqlU9GjfL"; break;
			case 7:  $ctrl = "MHIlrwmq1TYo4U7v3VKZJkzFiCOdLQGX2gpc8hxEDfsyea9jSnBP0b5utWAN6R"; break;
			case 8:  $ctrl = "AgNkpKO7bUu324RMHjw6hLBYF9ZxatEylmSevsrq80CofzTQ5dDWPXicInGV1J"; break;
			case 9:  $ctrl = "1gwYBxACSyj9nIoT3NVfJdO6cMaXHuGl570Q2bism4tEZWUrKkRq8FLPDphzev"; break;
			case 10:  $ctrl = "R6SauAWCv2LE4li3qGZbyOeTVQ590kwPj8KX7FxfpIhYmDrHoBsMngN1UtzdJc"; break;
			case 11:  $ctrl = "qsypiQkbSal50nB68YDNWofU4HGhdMFzV7KvEJjZRTxXgr1cmtAIP2OuCLe39w"; break;
			case 12:  $ctrl = "lud5TEhLoMAvIkfXBK8SC4Jz0c6nxpV3F9brQZYyeWsPwDUq2aN1iRjgOtGH7m"; break;
			case 13:  $ctrl = "768hMNxXCRvbjuHZ4kplLJy3ictaOGSdY1A9TewfgoIBVnDzWqEUFmKsQ2P05r"; break;
			case 14:  $ctrl = "05nHExVvDzKBj1crGs26J3RSe78XglYOTNt9dLFobACUPIiuyafWZmhqMp4Qkw"; break;
			case 15:  $ctrl = "CdnGAwMYQ12Xf9rUWOa7Fl4DHyRTL0bs8ughqK6mJPpkNjSVoZE3cex5tiBvzI"; break;
			case 16:  $ctrl = "ykO4DpAioVQxEcWsTUS8eGqrmvBguIhYPwLdt0b3CJHNMjRf6nl52azFK1X7Z9"; break;
			case 17:  $ctrl = "GOL7cYepWKRbuXlwB3nhmfSV9FTiIao2E4CAysx8M6t0vZ1QHUrzjdPD5qgJkN"; break;
			case 18:  $ctrl = "hZqVnlbaXM61T4mIPKkL3gJpUNWBCzc9EvYOjys2xQtuAoDeGr5Rf0i78dFwSH"; break;
			case 19:  $ctrl = "jSpnK6v47ieYJ8aXDwczAo1qCxT9LQ5UGy2IRNusEkg0bZlhWrmMtFBP3VHfdO"; break;
			case 20:  $ctrl = "GOdyqnwL0JxP5E16YfFK3NogjBhQ4kVAs2vI7aeXrb8TuUlmCDcHWSipz9RtZM"; break;
			case 21:  $ctrl = "M2zIS4H5yiPcbXrewTsWf3UoCpqLG9EAKuDOnNZxdY80Jthvm1Fg7RjBQalkV6"; break;
			case 22:  $ctrl = "IrUOiH90xjslWFygSeB4JdZhk5ocQTVvtmLzXPbA3MCYu8a7EGf2NpKRq1D6wn"; break;
			case 23:  $ctrl = "tVuhmkDZjHlTrS5i4dU31Gspe07yRbAa6nxcOzXqKvQYLNJCIPwfF29EgWMoB8"; break;
			case 24:  $ctrl = "iW0abHAvgL2pz19PcCZujryXEewnqKxODtldGfSQYUMBh5J8o7N3IVsTR4Fk6m"; break;
			case 25:  $ctrl = "G8rkhFwRCIvUNQm613pYe2VtcPfX4EoaHudJgxWSjZMi9s0ynqDzKOT57LlABb"; break;
			case 26:  $ctrl = "ATudl5psPVSGQBoR2zJZ4xvN3IXmW6haMwLFktKrnHDU0bcijO7CEg8qYeyf91"; break;
			case 27:  $ctrl = "BmPlsDghqjMyUWLxrOd7A40G2FicHvItJYnue89kpQwaZRSfEbX5KC1N36VTzo"; break;
			case 28:  $ctrl = "Nnk8ZebKtDWycfgXM3UzSVFQY2xGPLAdOH5uq7hwCp1smIjE0ToR4la6JvB9ir"; break;
			case 29:  $ctrl = "pvBQmUATjJKNIYq748C3ox5HWGsreby6MFf9gh10DzEcPR2liOXkdZVaStnLwu"; break;
			case 30:  $ctrl = "VF3oLJ49CfUY1hI0sGdqXgRcE7wpxADu8OzkTKHWNaeQtryniBlM2S6vbPZjm5"; break;
			case 31:  $ctrl = "WLXeETjyFv2Z46DrktHIVmp3MnNYOqf5G1Qwg8CbB9PRAuKaSshxU0cJi7ldoz"; break;
			case 32:  $ctrl = "q9SO4gZe0JUbLWsCrEAKNv2jIYudXtTlkmH5ynDiPQB76pz8ahfwFGx3o1RVcM"; break;
		}
	return $ctrl;
	}
	public static function mask ($password) {
		$ln = self::LN;
		$keyc = self::KEYC;
		$key = mt_rand (1, 32);
		$ctrl = self::get_ctrl($key);
		$mpass = $ctrl [mt_rand (0, $ln-1)];
		$mpass .= $ctrl [self::pos_c ($ctrl, $password [0])];
		for ($i = 1; $i <= strlen($password); $i ++) {
			$mpass .= $ctrl [self::pos_c ($ctrl, $password [$i])];
			for ($j = 0; $j <= $i; $j++){
				$mpass .= $ctrl[mt_rand (0, $ln-1)];
			}
		}
		$k = mt_rand(5, strlen($password)*2);
		for ($j = 0; $j <= $k; $j ++)
		{
			$mpass .= $ctrl [mt_rand (0, $ln - 1)];
		}
		$mpass .= $keyc [$key];
		$mpass .= $ctrl [strlen ($password)];
		$mpass .= $ctrl [mt_rand (0, $ln - 1)];
		return $mpass;
	}
		
	public static function demask ($mask) {
		$n = strlen ($mask);
		$keyc = self::KEYC;
		$ln = self::LN;
		$key = self::pos_t ($keyc, $mask [$n - 3]);
		$ctrl = self::get_ctrl ($key);
		$plen = self::pos_t ($ctrl, $mask [$n - 2]);
		$password = $ctrl [self::pos_b ($ctrl, $mask [1])];
		$j = 2;
		for ($i = 1; $i < $plen; $i ++){
			$password .= $ctrl [self::pos_b($ctrl, $mask[$j])];
			$j = $j+$i+2;
		}
		return $password;
	}
		
	private static function pos_c ($ctrl1, $chr){
		$ln = self::LN;
		$mdb = NULL;
		for ($k = 0; $k < $ln; $k ++){
			if ($chr == $ctrl1 [$k]) {
				$mdb = $k;
			}
		}
		$mdb = $mdb - 4;
		if ($mdb < 0) {
			$mdb = $ln + $mdb;
		}
		return $mdb;
	}
		
	private static function pos_b($ctrl1,$chr){
		$ln = self::LN;
		$mdb = NULL;
		for ($k = 0; $k < $ln; $k ++){
			if ($chr == $ctrl1 [$k]) {
				$mdb = $k;
			}
		}
		$mdb = $mdb + 4;
		if ($mdb > ($ln - 1)) {$mdb = $mdb - $ln;}
		return $mdb;
	}
		
	private static function pos_t($c1,$chr){
		$ln = self::LN;
		$mdb = NULL;
		for ($k = 0; $k < $ln; $k ++){
			if ($chr == $c1 [$k]) {$mdb = $k;}
		}
		return $mdb;
	}
}
?>