<?php

namespace Annex;


class Mailer {
	private $subject;
	private $text;
	private $getter;

	public function facade ($subject, $text, $getterEmail) {
		$this->text = $text;
		$this->subject = $subject;
		$this->getter = $getterEmail;

		$this->sendMail();
	}

	private function sendMail () {
		$subject = '['.$_SERVER ['SERVER_NAME'].'] '.$this->subject;
		$text = $this->text;

		/* Для отправки HTML-почты вы можете установить шапку Content-type. */
		$headers= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n";

		/* дополнительные шапки */
		$headers .= "From: Miradas-mailer <no-reply@miradas.ru>\r\n";

		return mail($this->getter, $subject, $text, $headers);
	}
} 