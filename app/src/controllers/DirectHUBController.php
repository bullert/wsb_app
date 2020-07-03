<?php

// echo "b".file_exists('../controllers/SessionController.php')."b";

require_once('../../public/router2.php');

// spl_autoload_register();

// include_once('../../public/router.php');
// include_once('router.php');

// controllers('SessionController.php');

// spl_autoload_register();
// spl_autoload_register('Autoloader');

class DirectHUBController {

	private static $data;

	public static function PostListener($post)
	{
		static::$data = json_decode(json_encode($post), true);
		if (!array_key_exists('header', static::$data))
		{
			DirectHUBController::Fail('DirectHUBController PostListener error: No header detected.');
		}
		static::$data = DirectHUBController::DirectHUB($post['header']);
		DirectHUBController::Response();
	}

	public static function DirectHUB($header)
	{
		switch ($header) {
			case 'authentication':
				return SessionController::Authentication(static::$data);
				break;
			case 'auto_authentication':
				return SessionController::RestoreSession();
				break;
			case 'logout':
				return SessionController::Logout();
				break;
			case 'single_field_validation':
				return SessionController::CreateAccount(static::$data);
				break;
			case 'form_validation':
				return SessionController::CreateAccount(static::$data);
				break;
			case 'get_all_vehicles_makes':
				return VehiclesController::GetAllMakes();
				break;
			case 'get_all_models_of_make':
				return VehiclesController::GetAllModelsOfMake(static::$data);
				break;
			case 'add_vehicle':
				return VehiclesController::AddVehicle(static::$data);
				break;
			case 'delete_vehicles':
				return VehiclesController::DeleteVehicles(static::$data);
				break;
			case 'fuel_consumption_calculation':
				return VehiclesController::CalculateFuelConsumption(static::$data);
				break;
			default:
				DirectHUBController::Fail('DirectHUBController PostListener error: No destination found for header: ' . $header);
				break;
		}
	}

	public static function Response()
	{
		echo json_encode(static::$data);
		exit;
	}

	public static function Fail($error)
	{
		// print_r(static::$data);
		static::$data['fatal_error'] = $error;
		DirectHUBController::Response();
	}
}

if ($_POST) DirectHUBController::PostListener($_POST);

?>
