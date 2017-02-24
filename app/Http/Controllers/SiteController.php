<?php namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModel;
use App\Models\UserSessionModel;
use App\Models\CarsTypeModel;
use App\Models\CarsModel;
use App\Models\UserCarsModel;
use Webpatser\Uuid\Uuid;

class Session {
	public $id = null;
	public $session_token = null;
	public $user_id = null;
}

class SiteController extends BaseController
{
	//************************* TEST FUNCTION - SITE CONTROLLER *********************//
	public function test() {
		$uuidv1 = Uuid::generate(4);
		/*$uuid3 = Uuid::generate(3, 'turing' , Uuid::NS_DNS);
		$uuid4 = Uuid::generate(4);
		$uuid5 = Uuid::generate(5, 'turing' , Uuid::NS_DNS);*/
		return $uuidv1;
	}

	//************************* LOGIN FUNCTION - SITE CONTROLLER *********************//
	public function login()
  {
    if(Auth::check())
    {
      $car_types = CarsTypeModel::all();
      $current_session = UserSessionModel::where('user_id', Auth::user()->id)->where('session_token', '!=', '')->first();
      return redirect ('/')->with('user', Auth::user())->with('user_session', $current_session)->with('car_types', $car_types);
    }
    return view('login');
  }

	//************************* REGISTER FUNCTION - SITE CONTROLLER *********************//
  public function register()
  {
    if(Auth::check())
    {
      $car_types = CarsTypeModel::all();
      $current_session = UserSessionModel::where('user_id', Auth::user()->id)->where('session_token', '!=', '')->first();
      return redirect ('/')->with('user', Auth::user())->with('user_session', $current_session)->with('car_types', $car_types);
    }
    return view('register');
  }

	//************************* FORGOT FUNCTION - SITE CONTROLLER *********************//
  public function forgot()
  {
    return view('forgot_password');
  }

	//************************* VEHICLES FUNCTION - SITE CONTROLLER *********************
  public function vehicles()
  {
		if(Auth::check())
    {
      $car_types = CarsTypeModel::all();
			$formated_all_user_cars = [];
			$all_cars_user = UserCarsModel::where('user_id', Auth::user()->id)->get();

			foreach($all_cars_user as $cars_user)
	    {
	      $formated_user_car = new \stdClass();
	      $formated_user_car->id = $cars_user->id;
	      $formated_user_car->alarm_active  = $cars_user->alarm_active;
	      $formated_user_car->shared_active  = $cars_user->shared_active;
	      $formated_user_car->shared_token =  $cars_user->shared_token;
	      $formated_user_car->user_id  = $cars_user->user_id;
				$formated_user_car->car_type = CarsModel::find($cars_user->car_id)->type_id;
				$formated_all_user_cars []     = $formated_user_car;
	    }
	    json_encode($formated_all_user_cars);

      $current_session = UserSessionModel::where('user_id', Auth::user()->id)->where('session_token', '!=', '')->first();
      return view('cars')->with('user', Auth::user())->with('user_session', $current_session)->with('car_types', $car_types)->with('user_cars', $formated_all_user_cars)->with('count_cars', count($formated_all_user_cars));
    }
		$car_types = CarsTypeModel::all();
    $user_session = new Session();
    return view('welcome')->with('user', null)->with('user_session', $user_session)->with('car_types', $car_types);
  }

	//************************* LOCATION FUNCTION - SITE CONTROLLER *********************//
  public function map()
  {
    return view('map');
  }

	//************************* WELCOME FUNCTION - SITE CONTROLLER *********************//
  public function account () {
    if(Auth::check())
    {
      return view('account');
    }
		$car_types = CarsTypeModel::all();
    $user_session = new Session();
    return view('welcome')->with('user', null)->with('user_session', $user_session)->with('car_types', $car_types);
  }

	//************************* WELCOME FUNCTION - SITE CONTROLLER *********************//
  public function welcome () {
    if(Auth::check())
    {
      $car_types = CarsTypeModel::all();
			$all_cars_user = UserCarsModel::where('user_id', Auth::user()->id)->get();
      $current_session = UserSessionModel::where('user_id', Auth::user()->id)->where('session_token', '!=', '')->first();
      return view('welcome')->with('user', Auth::user())->with('user_session', $current_session)->with('car_types', $car_types)->with('user_cars', $all_cars_user)->with('count_cars', count($all_cars_user));
    }
		$car_types = CarsTypeModel::all();
    $user_session = new Session();
    return view('welcome')->with('user', null)->with('user_session', $user_session)->with('car_types', $car_types);
  }
}
