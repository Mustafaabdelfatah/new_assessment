<?php

use App\Models\Assessment;
use App\Models\User;
use App\Jobs\SendWelcomeEmailJob;
use App\Http\Controllers\AdminAuth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\IndexController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
Route::get('test', function () {
    $getAll = Assessment::all();
    foreach ($getAll as $assess) {
        $assess->update(['slug' => strtolower(str_replace(' ', '-', $assess->title))]);
    }
});

require __DIR__ . '/auth.php';
// Route::get('testmail',function(){
//     // get all mails for users in system
//     $users = User::get();
//     foreach($users as $user){
//         $password = bin2hex(random_bytes(8));

//         $user->password = bcrypt($password);
//         $user->save();
//         $data = [
//             'name' => $user['name'],
//             'email' => $user['email'],
//             'link' => url('/'),
//             'password' => $password,
//         ];

//         $mail = dispatch(new SendWelcomeEmailJob($data));


//     }

// });
