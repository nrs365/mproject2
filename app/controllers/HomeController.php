<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}
	// MProject specific
	public function showHome()
	{
		$index = true;
		return View::make('home.index')->with('index', $index);
	}

	public function showLogin()
	{
	 	return View::make('login');   
	}

	public function showRegistration()
	{
		$data = array(
			'user' => Auth::user()
		);
		return View::make('home.registration')->with($data);
	}

	public function doRegistration()
	{
		
		$rules = array(
        'first'    => 'required',
        'last'     => 'required',
        'username' => 'required|max:25',
        'password' => 'required|min:6',
        'email'    => 'required|email'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::action('HomeController@showRegistration')->withErrors($validator)->withInput(Input::except('password'));
        } else {  
			$user = new User;
			$user->first     = Input::get('first');
			$user->last      = Input::get('last');
			$user->username  = Input::get('username');
			$user->password  = Hash::make(Input::get('password'));
			$user->email     = Input::get('email');

			$user->save();
			
			return Redirect::action('UsersController@show', $user->username);
		}
	}

	public function doLogin()
	{
	    
		$eMessageValue = 'You are not a registered user.';

		$credentials = [
            'email'=>Input::get('email'),
            'password'=>Input::get('password')
        ];

		$rules = array(
            'email'    => 'required|email', 
            'password' => 'required|min:6'
        );
        // dd($credentials);
        $validator = Validator::make($credentials,$rules);
        
        if($validator->passes())
        {
            if(Auth::attempt($credentials)) {
		   		return Redirect::action('ClientsController@index');
			}
	    } else {
	        Session::flash('errorMessage', $eMessageValue);
			return Redirect::action('HomeController@showRegistration');
	    }
	}
	
	public function logout()
	{
		Auth::logout();
		Session::flash('successMessage', 'You have logged out.');
		return Redirect::action('HomeController@showThankYou');
	}
	
	public function showThankYou()
	{
		return View::make('home.thankyou');
	}


}
