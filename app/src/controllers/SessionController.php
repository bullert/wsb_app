<?php


// include_once('../../public/router.php');
//
// controllers("DatabaseController.php");
// controllers("ValidationController.php");
// models("User.php");

// spl_autoload_register();

define('LOGIN_ALREADY_OCCUPIED', 'Ten login jest już zajęty.');
define('EMAIL_ALREADY_OCCUPIED', 'Ten email jest już zajęty.');
define('AUTHENTICATION_FAIL_ERROR', 'Błędny login lub hasło.');

// if ($cookie = isset($_COOKIE['rememberme']) ? $_COOKIE['rememberme'] : '')
// {
// 	echo json_encode($cookie);
// }
// else
// {
// 	echo json_encode('no cookie for u');
// }
if (session_status() != PHP_SESSION_ACTIVE) session_start();

function ArgumentError($method, $arg)
{
	return DatabaseController::Fail($method . ' argument error: ' . $arg . ' not found.');
}

class SessionController {

	public static function Authentication($data)
	{
		if (!array_key_exists('login', $data))
			return ArgumentError(__METHOD__, 'login');
		if (!array_key_exists('password', $data))
			return ArgumentError(__METHOD__, 'password');

		$login = $data['login'];
		$password = $data['password'];
		$stay_logged_in = array_key_exists('stay_logged_in', $data) ? true : false;

		// $pd = password_hash($password, PASSWORD_DEFAULT);
		// echo password_verify($password, $pd);
		
		$result = DatabaseController::Connect();
		if ($result)
			return $result;

		$select = 'select user_id, login, email from users where login = \'' . $login . '\' and password = \'' . $password . '\'';
		$result = DatabaseController::Query($select);

		if (!$result)
			return DatabaseController::Fail('Invalid query: ' . $db_conn->error);

		if ($result->num_rows == 0)
			return static::AuthenticationDeny();

		// if (session_status() != 2)
		// 	session_start();
		// session_regenerate_id();
		$row = $result->fetch_assoc();
		$_SESSION['session_id'] = session_id();
		$_SESSION['user'] = new User($row['user_id'], $row['login'], $row['email']);

		return SessionController::UpdateVehicles();

		// return static::StoreSession($_SESSION['session_id'], $row['user_id'], $stay_logged_in);

		return;
	}

	public static function UpdateVehicles()
	{
		$result = DatabaseController::Connect();
		if ($result)
			return $result;

		$user_id = $_SESSION['user']->GetId();
		// $select = "SELECT make, model, year_of_production FROM Vehicles WHERE user_id = '{$user_id}'";
		$select = "SELECT vehicle_unit_id, make, model FROM vehicles_units NATURAL JOIN vehicles WHERE user_id = '{$user_id}'";
		$result = DatabaseController::Query($select);

		if (!$result)
			// return DatabaseController::Fail('Invalid query: ' . $db_conn->error);
			return DatabaseController::Fail('Invalid query: ');

		$vehiclesList = [];
		if ($result->num_rows > 0)
		{
			while ($row = $result->fetch_assoc())
				array_push($vehiclesList, $row);
		}
		$_SESSION['vehicles'] = $vehiclesList;

		return;
	}

	public static function AuthenticationDeny()
	{
		return ['login'=>AUTHENTICATION_FAIL_ERROR, 'password'=>AUTHENTICATION_FAIL_ERROR];
	}

	public static function StoreSession($session_id, $user_id, $stay_logged_in)
	{
		$result = DatabaseController::Connect();
		if ($result)
			return $result;

		// echo "{$session_id} {$user_id} {$stay_logged_in}";
		// session_destroy();

		$insert = "insert into sessions (session_id, user_id, started_at) values ('{$session_id}', '{$user_id}', now());";
		$result = DatabaseController::Query($insert);

		if (!$result)
			return DatabaseController::Fail('Invalid query: ' . DatabaseController::getQueryError());

		if ($stay_logged_in) static::RememberMe($session_id);

		return;
	}

	public static function RestoreSession()
	{
		if (!isset($_COOKIE['rememberme']))
			return DatabaseController::Fail('no cookie for u');

		$session_id = $_COOKIE['rememberme'];

		$result = DatabaseController::Connect();
		if ($result)
			return $result;

		// echo $session_id;
		$query = "select user_id, login, email from Users natural join Sessions where session_id = '{$session_id}';";
		$result = DatabaseController::Query($query);

		if (!$result)
			return DatabaseController::Fail('Invalid query: ' . $db_conn->error);

		if ($result->num_rows == 0)
			return DatabaseController::Fail('no res');

		session_id($session_id);
		session_start();
		$row = $result->fetch_assoc();
		$_SESSION['session_id'] = session_id();
		$_SESSION['user'] = new User($row['user_id'], $row['login'], $row['email']);

		static::RememberMe($session_id);

		return;
	}

	public static function RememberMe($session_id)
	{
		setcookie('rememberme', $session_id, time() + (10 * 365 * 24 * 3600));
	}

	public static function Logout()
	{
		$_SESSION = array();
		session_destroy();
		return;

		// if (isset($_COOKIE['rememberme']))
		// 	setcookie('rememberme', null, time() - 3600);
	}

	public static function CreateAccount($data)
	{
		// print_r($data);
		// if (!array_key_exists('login', $data))
		// 	return ArgumentError(__METHOD__, 'login');
		// if (!array_key_exists('email', $data))
		// 	return ArgumentError(__METHOD__, 'email');
		// if (!array_key_exists('password', $data))
		// 	return ArgumentError(__METHOD__, 'password');
		// if (!array_key_exists('password_confirm', $data))
		// 	return ArgumentError(__METHOD__, 'password_confirm');

		$result = DatabaseController::Connect();
		if ($result)
			return $result;

		$errorList = [];

		foreach ($data as $propertyName => $value)
		{
			$error = null;
			switch ($propertyName) {
				case 'login':
					$error = ValidationController::ValidateLogin($value);
					if (!$error)
					{
						$select = 'select user_id from users where login = \'' . $value . '\'';
						$result = DatabaseController::Query($select);

						if (!$result)
							return DatabaseController::Fail('Invalid query: ' . $db_conn->error);

						if ($result->num_rows > 0)
							$error = LOGIN_ALREADY_OCCUPIED;
					}
					break;
				case 'email':
					$error = ValidationController::ValidateEmail($value);
					if (!$error)
					{
						$select = 'select user_id from users where email = \'' . $value . '\'';
						$result = DatabaseController::Query($select);

						if (!$result)
							return DatabaseController::Fail('Invalid query: ' . $db_conn->error);

						if ($result->num_rows > 0)
							$error = EMAIL_ALREADY_OCCUPIED;
					}
					break;
				case 'password':
					if ($data['header'] == 'single_field_validation' && array_key_exists('password_confirm', $data))
						continue;
					$error = ValidationController::ValidatePassword($value);
					break;
				case 'password_confirm':
					$error = ValidationController::ValidatePasswordConfirm($data['password'], $value);
					break;
			}
			if ($error) $errorList[$propertyName] = $error;
		}

		return empty($errorList) ? null : $errorList;
	}
}

?>
