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

//Login, for now just check that email/password are correct
Route::post('/login', function(Request $request) {
    $input = $request->all();
    if (!array_key_exists('email',$input) || !array_key_exists('password',$input)) {
        return [
            "error_code"=>400,
            "error_title"=>"Login failure",
            "error_message"=>"Both email and password must be provided."
        ];
    } else {
        $getUser = User::where([
            ['email','=',$input['email']],
            ['password','=',$input['password']]
            ])->get();
        if (count($getUser)==0) {
            return [
                "error_code"=>101,
                "error_title"=>"Login Failure",
                "error_message"=>"Email or Password was Invalid!"
            ];
        } else {
            return $getUser;
        }
    }
    
});

//View messages between specified users
Route::post('/view_messages', function(Request $request) {
    $input = $request->all();
});

//Send a message
Route::post('/send_message', function(Request $request) {
    $input = $request->all();
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