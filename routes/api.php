<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/user/login', function(Request $request) {

	$response = ['success' => false];
	$data = $request->all();

	if( \Auth::attempt(array('email' => $data['email'], 'password' => $data['password'])) ) {
		$user = \Auth::user();

		$response['success'] = true;
    	$response['token'] = \JWTAuth::fromUser($user);
    	$response['data'] = ['id' => $user->id, 'name'=> $user->name];
    	$response['permission'] = $user->permission;
	}

	return response()->json($response);
});

Route::post('/user/logout', function(Request $request) {

	\Auth::logout();
    \Session::flush();
    \Session::regenerate();
});

Route::post('/user/token', function(Request $request) {

	try {

        if (! $user = JWTAuth::parseToken()->authenticate()) {
            return response()->json(['success' => false, 'reason' => 'user_not_found'], 404);
        }

    } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {

        return response()->json(['success' => false, 'reason' => 'token_expired'], $e->getStatusCode());

    } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {

        return response()->json(['success' => false, 'reason' => 'token_invalid'], $e->getStatusCode());

    } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {

        return response()->json(['success' => false, 'reason' => 'token_absent'], $e->getStatusCode());

    }

    $response['success'] = true;
    $response['token'] = \JWTAuth::fromUser($user);
    $response['data'] = ['id' => $user->id, 'name'=> $user->name];
    $response['permission'] = \App\User::find($user->id)->permission;

    return response()->json($response);
})->middleware('jwt.refresh');

Route::post('/user/register', function(Request $request) {

	$data = $request->all();
	
	try {
		$user = \App\User::create([
	        'name' => $data['name'],
	        'email' => $data['email'],
	        'password' => bcrypt($data['password']),
	    ]);

		$permission = ['user_id' => $user->id];
	    if( \App\User::count() == 1 ) {
	    	$permission['write'] = '1';
	    	$permission['read'] = '1';
	    } else {
	    	$permission['write'] = '0';
	    	$permission['read'] = '1';
	    }

	    \App\Permission::create($permission);

	} catch(\Illuminate\Database\QueryException $e) {
		$user = false;
	}

	$response = ['success' => false];

    if( $user ) {
    	$user = \Auth::loginUsingId($user->id);
    	$response['success'] = true;
    	$response['token'] = \JWTAuth::fromUser(\Auth::user());
    }

    return response()->json($response);
});

Route::post('/file/list', function(Request $request){

	$response = [
		1 => 'a.jpg',
		12 => 'b.jpg',
		21 => 'c.jpg',
		31 => 'd.jpg',
	];

	return response()->json($response);
})->middleware('jwt.auth');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');