<?php namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use App\Models\UserModel;
use App\Models\UserSessionModel;
use App\Models\CarsTypeModel;
use App\Models\CarsModel;
use App\Models\UserCarsModel;
use Illuminate\Http\Request;
use Webpatser\Uuid\Uuid;
use Hash;
use Auth;

class CarsController extends BaseController
{
	//************************* ADD NEW CARS TO USER FUNCTION - CARS CONTROLLER *********************
	public function add(Request $request)
	{
		//Inputs Required
		$session_id = $request->input('session_id');
		$session_token = $request->input('session_token');
		$car_type = $request->input('car_type');

		//Data validations
		if(empty($session_id))
		return response()->json(array('status' => 'error', 'type' => 'credenciales'));

		if(empty($session_token))
		return response()->json(array('status' => 'error', 'type' => 'credenciales'));

		if(empty($car_type))
		return response()->json(array('status' => 'error', 'type' => 'empty car type'));

		$user_session = UserSessionModel::where('id',$session_id)->where('session_token', $session_token)->first();
		if(!$user_session)
			return response()->json(array('status' => 'error', 'type' => 'User not logged'));

		$token_free = true;
		do {
			$token = Uuid::generate(4);
			$is_free = CarsModel::where('car_token', $token)->first();
			if($is_free) {
				$token_free = true;
			} else {
				$token_free = false;
				$token_car = $token;
			}
		} while ($token_free);

		$new_car = new CarsModel();
		$new_car->car_token = $token_car;
		$new_car->type_id    = $car_type;
		$new_car->save();

		if(!$new_car)
			return response()->json(array('status' => 'error', 'type' => 'car wasn\'t added'));

		$new_user_cars = new UserCarsModel();
		$new_user_cars->alarm_active = false;
		$new_user_cars->shared_active = false;
		$new_user_cars->shared_token = null;
		$new_user_cars->user_id = $user_session->user_id;
		$new_user_cars->car_id = $new_car->id;
		$new_user_cars->save();

		return response()->json(array('status' => 'success', 'car_user' => $new_user_cars));
	}

	//************************* EDIT CARS FUNCTION - CARS CONTROLLER *********************//
	public function edit(Request $request)
	{
		//Inputs Required
		$user_id = $request->input('user_id');
		$session_id = $request->input('session_id');
		$session_token = $request->input('session_token');

		//Data Validations
		if(empty($user_id))
		return response()->json(array('status' => 'error', 'type' => 'Empty user_id'));

		if(empty($session_id))
		return response()->json(array('status' => 'error', 'type' => 'credenciales'));

		if(empty($session_token))
		return response()->json(array('status' => 'error', 'type' => 'credenciales'));

		$user = UserModel::where('id', $user_id)->first();
		if(!$user)
		return response()->json(array('status' => 'error', 'type' => 'The user doesn\'t exist'));

		$user_session = UserSessionModel::where('id', $session_id)->where('session_token', $session_token)->first();
		if(!$user_session)
		return response()->json(array('status' => 'error', 'type' => 'User not logged'));

		$user_logged = UserModel::find($user_session->user_id);

		if($user_logged)
		$car_types = CarsTypeModel::all();
		else
		$car_types = '';

		return response()->json(array('status' => 'success', 'user_editing' => $user, 'car_types' => $car_types));
	}

	//************************* SAVE CARS CHANGES FUNCTION - CARS CONTROLLER *********************//
	public function save(Request $request)
	{
		//Inputs Required
		$user_id = $request->input('user_id');
		$session_id = $request->input('session_id');
		$session_token = $request->input('session_token');
		$name = $request->input('name');
		$lastname = $request->input('lastname');
		$email = $request->input('email');
		$phone = $request->input('phone');

		//Data validations
		if(empty($user_id))
		return response()->json(array('status' => 'error', 'type' => 'Falta id de usuario'));

		if(empty($session_id))
		return response()->json(array('status' => 'error', 'type' => 'credenciales'));

		if(empty($session_token))
		return response()->json(array('status' => 'error', 'type' => 'credenciales'));

		if(empty($name))
		return response()->json(array('status' => 'error', 'type' => 'Empty name'));

		if(empty($lastname))
		return response()->json(array('status' => 'error', 'type' => 'Empty last name'));

		/*if(empty($phone))
		return response()->json(array('status' => 'error', 'type' => 'Empty phone'));*/

		if(empty($email))
		return response()->json(array('status' => 'error', 'type' => 'Empty email'));

		$email_exist = UserModel::where('email', $email)->first();

		$user_logged = UserSessionModel::where('id', $session_id)->where('session_token', $session_token)->first();
		if(!$user_logged)
		return response()->json(array('status' => 'error', 'type' => 'User not logged'));

		$user_to_be_edited = UserModel::where('id', $user_id)->first();
		if(!$user_to_be_edited)
		return response()->json(array('status' => 'error', 'type' => 'User doesn\'t exist'));


		if($email_exist && $email != $user_to_be_edited->email)
		return response()->json(array('status' => 'error', 'type' => 'email exist'));

		//Saving new data
		$user_to_be_edited->name      = trim($name, " ");
		$user_to_be_edited->lastname = $lastname;
		$user_to_be_edited->phone     = trim($phone, " ");
		$user_to_be_edited->email     = trim($email, " ");

		$user_to_be_edited->save();

		return response()->json(array('status' => 'success', 'user_edited' => $user_to_be_edited));
	}

	//************************* DELETE CARS FUNCTION - CARS CONTROLLER *********************//
	public function delete(Request $request)
	{
		//Inputs Required
		$user_car_id = $request->input('user_car_id');
		$session_id = $request->input('session_id');
		$session_token = $request->input('session_token');

		//Data Validations
		if(empty($session_token))
		return response()->json(array('status' => 'error', 'type' => 'credentials'));

		if(empty($session_id))
		return response()->json(array('status' => 'error', 'type' => 'credentials'));

		if(empty($user_car_id))
		return response()->json(array('status' => 'error', 'type' => 'empty user car id'));

		$user_session = UserSessionModel::where('id', $session_id)->where('session_token', $session_token)->first();
		if(!$user_session)
		return response()->json(array('status' => 'error', 'type' => 'User not logged'));

		$car_to_be_deleted = UserCarsModel::find($user_car_id);
		$car_to_be_deleted->delete();

		return response()->json(array('status' => 'success'));

	}
}
