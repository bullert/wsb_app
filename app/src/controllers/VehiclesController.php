<?php

if (session_status() != PHP_SESSION_ACTIVE) session_start();
// if (!isset($_SESSION)) session_start();

class VehiclesController
{
	public static function GetAllMakes()
	{
		$result = DatabaseController::Connect();
		if ($result)
			return $result;

		$select = "SELECT DISTINCT make FROM vehicles";
		$result = DatabaseController::Query($select);

		if (!$result)
			// return DatabaseController::Fail('Invalid query: ' . $db_conn->error);
			return DatabaseController::Fail('Invalid query: ');

		$vehiclesList = [];
		if ($result->num_rows > 0)
		{
			while ($row = $result->fetch_assoc())
			{
				array_push($vehiclesList, $row['make']);
			}
		}
		return $vehiclesList;
	}

	public static function GetAllModelsOfMake($data)
	{
		if (!array_key_exists('makes_list', $data))
			return ArgumentError(__METHOD__, 'makes_list');

		$make = $data['makes_list'];

		$result = DatabaseController::Connect();
		if ($result)
			return $result;

		$select = "SELECT model FROM vehicles WHERE make = '{$make}'";
		$result = DatabaseController::Query($select);

		if (!$result)
			// return DatabaseController::Fail('Invalid query: ' . $db_conn->error);
			return DatabaseController::Fail('Invalid query: ');

		$vehiclesList = [];
		if ($result->num_rows > 0)
		{
			while ($row = $result->fetch_assoc())
			{
				array_push($vehiclesList, $row['model']);
			}
		}
		return $vehiclesList;
	}

	public static function AddVehicle($data)
	{
		if (!array_key_exists('makes_list', $data))
			return ArgumentError(__METHOD__, 'makes_list');
		if (!array_key_exists('models_list', $data))
			return ArgumentError(__METHOD__, 'models_list');

		$user_id = $_SESSION['user']->GetId();
		$make = $data['makes_list'];
		$model = $data['models_list'];

		$result = DatabaseController::Connect();
		if ($result)
			return $result;

		$insert = "INSERT INTO vehicles_units (vehicle_id, user_id) VALUES ((SELECT vehicle_id FROM vehicles WHERE make = '{$make}' AND model = '{$model}'), '{$user_id}');";
		$result = DatabaseController::Query($insert);

		if (!$result)
			return DatabaseController::Fail('Invalid query: ' . DatabaseController::getQueryError());

		SessionController::UpdateVehicles();

		return;
	}

	public static function DeleteVehicles($data)
	{
		$vehicles = $data['vehicles'];

		if (!$vehicles) return;

		$result = DatabaseController::Connect();
		if ($result)
			return $result;

		$insert = "DELETE FROM vehicles_units WHERE vehicle_unit_id in ({$vehicles});";
		$result = DatabaseController::Query($insert);

		if (!$result)
			return DatabaseController::Fail('Invalid query: ' . DatabaseController::getQueryError());

		SessionController::UpdateVehicles();

		return;
	}

	public static function CalculateFuelConsumption($data)
	{
		return $data;
	}
}

?>
