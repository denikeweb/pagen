<?php
	/**
	 *  @author Denis Dragomiric <den@lux-blog.org>
	 *	@version Pagen 1.1.6
	 */
	namespace Pagen;

	abstract class PassMask {
		const IV = 'h9FhFMfZCxXUdGac12tbNHgGUuPeCzIyssRjKBz5zU0=';
			#base64_encode (mcrypt_create_iv (mcrypt_get_iv_size (MCRYPT_RIJNDAEL_256, MCRYPT_MODE_CBC), MCRYPT_RAND););
		const KEY = 'fB2xH9ms0gP3U5sgG';

		public static function mask ($text) {
			return base64_encode(
				mcrypt_encrypt (
					MCRYPT_RIJNDAEL_256,
					self::KEY,
					$text,
					MCRYPT_MODE_CBC,
					base64_decode (self::IV)
				)
			);
		}
		public static function demask ($maskedText) {
			return mcrypt_decrypt (
				MCRYPT_RIJNDAEL_256,
				self::KEY,
				base64_decode ($maskedText),
				MCRYPT_MODE_CBC,
				base64_decode (self::IV)
			);
		}
	}