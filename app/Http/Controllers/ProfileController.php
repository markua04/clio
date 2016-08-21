<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Database\Eloquent;
use App\User;
use Illuminate\Http\RedirectResponse;

class ProfileController extends Controller {

    /*
     * Get the users name from the database and make it editable and save the new data to the database
     */
    public function edit()
    {
        if(isset($_POST['username'])){
            $username = $_POST['username'];
            $surname = $_POST['surname'];
            $lat = $_POST['lat'];
            $long = $_POST['long'];
            $id = $_POST['id'];
            $user = User::find($id);
            $user->name = $username;
            $user->surname = $surname;
            $user->lat = $lat;
            $user->long = $long;
            $user->save();

            return new RedirectResponse(url('/home'));
        }

        return view ('customer.edit');
    }
    /*
     * Only make the users data editable if they are logged in.
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'edit']);
    }


}
