<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Message;
use App\Models\User;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//User registration
Route::post('/register', function(Request $request) {
    $input = $request->all();
    $missing = [];
    $required = ['email','password','first_name','last_name'];

    //Check that all the fields are supplied
    foreach ($required as $key) {
        if (array_key_exists($key,$input)==FALSE) {
            array_push($missing, $key);
        }
    }
    
    if (count($missing)>0) {
        return [
            "error_code"=>400,
            "error_title"=>"Registration failure",
            "error_message"=>"Missing required fields.",
            "error_data"=>$missing
        ];
    } else {
        //Create the user!
        $res = User::create([
            "email" => $input['email'],
            "password" => $input['password'],
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name']
        ]);
        return $res;
    }
    
});


//List all users, except the one specified
//If none is specified, return them all
Route::get('/list_all_users', function(Request $request) {
    $input = $request->all();

    if (array_key_exists("requester_user_id", $input)){
        $res = User::all()->except($input['requester_user_id']);
    } else {
        $res = User::all();
    }
    
    return $res;
});