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

class UserController extends BaseController
{
	public function test(Request $request)
	{
		$account = $request->input('account');
    $password = $request->input('password');

		return $account." this is your pass".$password;
	}
	//************************* LOGIN FUNCTION - USER CONTROLLER *********************//
	public function login(Request $request)
	{
		//Inputs Required
    $account = $request->input('account');
    $password = $request->input('password');

    //Data validations
    if(empty($account))
      return response()->json(array('status' => 'error', 'type' => 'empty account'));

    if(empty($password) || strlen($password)<5) //This needs to be changed to 6
      return response()->json(array('status' => 'error', 'type' => 'password too short'));

    $user = UserModel::where('email',$account)->first();  // Traducido a SQL select * from users where username = 'account' or email = 'account' toma el primer registro
    if(!$user)
      return response()->json(array('status' => 'error', 'type' => 'user doesn\'t exist'));

    if(!Hash::check($password, $user->password))
      return response()->json(array('status' => 'error', 'type' => 'wrong password'));

    $is_already_logged = UserSessionModel::where('user_id', $user->id)->where('session_token', '!=', '')->first();
    if($is_already_logged)  //We check if the user isnt already logged
    {
      $is_already_logged->session_token = '';  //if he is logged we log him out making the session_token null
      $is_already_logged->save();
    }

    Auth::login($user);
    $new_user_session = new UserSessionModel();
    $new_user_session->session_token = sha1(time());
    $new_user_session->user_id = $user->id;
    $new_user_session->save();

		$car_types = CarsTypeModel::all();

    return redirect('/')->with('user', Auth::user())->with('user_session',$new_user_session)->with('car_types', $car_types);   //login succesfull
  }

	//************************* REGISTER FUNCTION - USER CONTROLLER *********************//
	public function register(Request $request)
	{
		//Data inputs
		//$username = $request->input('username');
		$email = $request->input('email');
		$password = $request->input('password');
		$name = $request->input('name');
		$lastname = $request->input('lastname');

		/*if(empty($username))
			return response()->json(array('status' => 'error', 'type' => 'empty username'));*/
		if(empty($name))
			return response()->json(array('status' => 'error', 'type' => 'empty name'));
		if(empty($lastname))
			return response()->json(array('status' => 'error', 'type' => 'empty last name'));
		if(empty($password) || strlen($password) < 6)
			return response()->json(array('status' => 'error', 'type' => 'password too short'));
		if(empty($email))
			return response()->json(array('status' => 'error', 'type' => 'empty email'));


		$email_exist = UserModel::where('email', $email)->first();
		if($email_exist)
      return response()->json(array('status' => 'error', 'type' => 'email exist'));

		$new_user = new UserModel();
		$new_user->email = $email;
		$new_user->password = Hash::make($password);
		$new_user->name = $name;
		$new_user->lastname = $lastname;
		$new_user->save();

		if(!$new_user)
		return response()->json(array('status' => 'error', 'type' => 'user wasn\'t registered'));

		Auth::login($new_user);

		$new_user_session = new UserSessionModel();
		$new_user_session->session_token = sha1(time());
		$new_user_session->user_id = $new_user->id;
		$new_user_session->save();

		$car_types = CarsTypeModel::all();

		return redirect('/')->with('user', Auth::user())->with('user_session', $new_user_session)->with('car_types', $car_types);   //login succesfull
	}

	//************************* FORGOT PASSWORD FUNCTION - USER CONTROLLER *********************
	public function forgot(Request $request)
	{
		//Inputs Required
		$account = $request->input('account');

		if(empty($account))
		return response()->json(array('status' => 'error', 'type' => 'Empty account'));

		$user = UserModel::where('email', $account)->first();
		if(!$user)
		return response()->json(array('status' => 'error', 'type' => 'The user doesn\'t exist'));

		$remember_token = sha1(time());

		//MailService::sendForgot($user, $remember_token);
		return response()->json(array('status' => 'success'));
	}

	//************************* RECOVER PASSWORD FUNCTION - USER CONTROLLER *********************
	public function recover($remember_token)
	{
		$user = UserModel::where('remember_token', $remember_token)->first();
		if(!$user)
		return response()->json(array('status' => 'error', 'type' => 'Expired or invalid token'));
		$new_password         = substr(time(), -6);
		$user->password       = Hash::make($new_password);
		$user->remember_token = null;
		$user->save();

		return response()->json(array('status' => 'success', 'new_password' => $new_password));
	}

	//************************* EDIT USER FUNCTION - USER CONTROLLER *********************//
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

	//************************* SAVE USER CHANGES FUNCTION - USER CONTROLLER *********************//
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

	//************************* DELETE USER FUNCTION - USER CONTROLLER *********************//
	public function delete(Request $request)
	{
		//Inputs Required
		$user_id = $request->input('user_id');
		$session_id = $request->input('session_id');
		$session_token = $request->input('session_token');

		//Data Validations
		if(empty($session_token))
		return response()->json(array('status' => 'error', 'type' => 'credentials'));

		if(empty($session_id))
		return response()->json(array('status' => 'error', 'type' => 'credentials'));

		if(empty($user_id))
		return response()->json(array('status' => 'error', 'type' => 'Falta id de usuario'));

		$user_session = UserSessionModel::where('id', $session_id)->where('session_token', $session_token)->first();
		if(!$user_session)
		return response()->json(array('status' => 'error', 'type' => 'User not logged'));

		$user_to_be_deleted = UserModel::find($user_id);
		$user_to_be_deleted->delete();

		return response()->json(array('status' => 'success'));

	}

	//************************* LOGOUT FUNCTION - USER CONTROLLER *********************
	public function logout(Request $request)
	{
		//Inputs Required
		$session_id     = $request->input('session_id');
		$session_token  = $request->input('session_token');

		//Data validations
		if(empty($session_id))
		return response()->json(array('status' => 'error', 'type' => 'credentials'));

		if(empty($session_token))
		return response()->json(array('status' => 'error', 'type' => 'credentials'));

		$user_is_logged = UserSessionModel::where('id', $session_id)->where('session_token', $session_token)->first();

		if(!$user_is_logged)
		return response()->json(array('status' => 'error', 'type' => 'User not logged'));

		$user_is_logged->session_token = '';
		$user_is_logged->save();
		Auth::logout(); //Esto desaparece la session que esta atrapada dentro del navegador.
		return response()->json(array('status' => 'success'));
	}
}
