<?php namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModel;
use App\Models\UserSessionModel;
use App\Models\CarsTypeModel;
use App\Models\UserCarsModel;

class Session {
	public $id = null;
	public $session_token = null;
}

class SiteController extends BaseController
{
	//************************* TEST FUNCTION - SITE CONTROLLER *********************//
	public function test() {
		$user_session = new Session();
		return view('welcome')->with('user', null)->with('user_session', $user_session);
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
      $car_types = CarsTypeModel::all();
			$all_cars_user = UserCarsModel::where('user_id', Auth::user()->id)->get();
      $current_session = UserSessionModel::where('user_id', Auth::user()->id)->where('session_token', '!=', '')->first();
      return view('account')->with('user', Auth::user())->with('user_session', $current_session)->with('car_types', $car_types)->with('user_cars', $all_cars_user)->with('count_cars', count($all_cars_user));
    }
    $user_session = new Session();
    return view('welcome')->with('user', null)->with('user_session', $user_session);
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
    $user_session = new Session();
    return view('welcome')->with('user', null)->with('user_session', $user_session);
  }
}
