<?php

class DatabaseController {

	private static $host = 'localhost';
	private static $user = 'id14244243_root';
	private static $password = 'N=3@+Xn_JQy#f6Ue';
	private static $db_name = 'id14244243_app';
	// private static $user = 'root';
	// private static $password = '';
	// private static $db_name = 'app';
	private static $conn;

	public static function Connect()
	{
		static::$conn = new mysqli(static::$host, static::$user, static::$password, static::$db_name);

		if (static::$conn->connect_error)
			return $this::Fail('Failed to connect to MySQL: ' . $conn->connect_error);
	}

	public static function Query($value)
	{
		return static::$conn->query($value);
	}

	public static function Fail($error)
	{
		return ['fatal_error'=>$error];
	}

	public static function getQueryError()
	{
		print_r(static::$conn);
		return static::$conn->error;
	}

	// public static function Fail2($error_msg)
	// {
	// 	return ['fatal_error'=>"{$error_msg}"];
	// }
}

?>
