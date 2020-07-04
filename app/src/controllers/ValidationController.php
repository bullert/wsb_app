<?php

define('LOGIN_MIN_LENGTH', 4);
define('LOGIN_MAX_LENGTH', 32);
define('PASSWORD_MIN_LENGTH', 8);
define('PASSWORD_MAX_LENGTH', 32);

define('LOGIN_REGEX_PATTERN', '/^[\w]+$/');
define('PASSWORD_REGEX_PATTERN', '/^[a-zA-Z\d\040!"#$%&\'()*+,-.:;<=>?@[\]^_`{|}~\/\\\]+$/');

define('NOT_EMPTY_ERROR', 'To pole nie może być puste.');
define('LOGIN_MIN_LENGTH_ERROR', 'To pole musi mieć długość co najmniej ' . LOGIN_MIN_LENGTH . ' znaków.');
define('LOGIN_MAX_LENGTH_ERROR', 'To pole musi mieć długość najwyżej ' . LOGIN_MAX_LENGTH . ' znaków.');
define('LOGIN_NOT_ALLOWED_CHARS_ERROR', 'Login może się składać jedynie z liter, cyfr i znaku _');
define('EMAIL_PATTERN_VIOLATION_ERROR', 'To nie wygląda jak email.');
define('PASSWORD_MIN_LENGTH_ERROR', 'To pole musi mieć długość co najmniej ' . PASSWORD_MIN_LENGTH . ' znaków.');
define('PASSWORD_MAX_LENGTH_ERROR', 'To pole musi mieć długość najwyżej ' . PASSWORD_MAX_LENGTH . ' znaków.');
define(
	'PASSWORD_NOT_ALLOWED_CHARS_ERROR',
	'Hasło może się składać jedynie z liter, cyfr, spacji i następujących znaków !"#$%&\'()*+,-.:;<=>?@[\]^_`{|}~/'
);
define('PASSWORD_CONFIRM_ERROR', 'Hasła nie są identyczne.');

class ValidationController
{
	public function ValidateLogin($value)
	{
		if (empty($value))
		{
			return NOT_EMPTY_ERROR;
		}
		else if (strlen($value) < LOGIN_MIN_LENGTH)
		{
			return LOGIN_MIN_LENGTH_ERROR;
		}
		else if (strlen($value) > LOGIN_MAX_LENGTH)
		{
			return LOGIN_MAX_LENGTH_ERROR;
		}
		else if (!preg_match(LOGIN_REGEX_PATTERN, $value))
		{
			return LOGIN_NOT_ALLOWED_CHARS_ERROR;
		}

		return;
	}

	public function ValidateEmail($value)
	{
		if (empty($value))
		{
			return NOT_EMPTY_ERROR;
		}
		else if (!filter_var($value, FILTER_VALIDATE_EMAIL))
		{
			return EMAIL_PATTERN_VIOLATION_ERROR;
		}

		return;
	}

	public function ValidatePassword($value)
	{
		if (empty($value))
		{
			return NOT_EMPTY_ERROR;
		}
		else if (strlen($value) < PASSWORD_MIN_LENGTH)
		{
			return PASSWORD_MIN_LENGTH_ERROR;
		}
		else if (strlen($value) > PASSWORD_MAX_LENGTH)
		{
			return PASSWORD_MAX_LENGTH_ERROR;
		}
		else if (!preg_match(PASSWORD_REGEX_PATTERN, $value))
		{
			return PASSWORD_NOT_ALLOWED_CHARS_ERROR;
		}

		return;
	}

	public function ValidatePasswordConfirm($password, $password_conf)
	{
		if (empty($password_conf))
		{
			return NOT_EMPTY_ERROR;
		}
		else if ($password != $password_conf)
		{
			return PASSWORD_CONFIRM_ERROR;
		}

		return;
	}
}

?>
