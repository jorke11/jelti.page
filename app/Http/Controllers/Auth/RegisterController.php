<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use DB;
use Mail;
use Illuminate\Http\Request;
use Hash;
use Illuminate\Support\Str;


class RegisterController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users',
                    'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) {
        return User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                    'role_id' => $data['role_id'],
                    'status_id' => $data['status_id'],
        ]);
    }

    public function register(Request $req) {
        $input = $req->all();
        $validator = $this->validator($input);

        $input["business"] = $input["name"] . " " . $input["last_name"];

        if (!$validator->failed()) {
            $valida_mail = DB::table("users")->where("email", $input["email"])->first();

            if (is_null($valida_mail)) {
                $input["role_id"] = 2;
                $input["status_id"] = 0;
                $input["password"] = str_random(6);
                $user = $this->create($input)->toArray();
                $user["link"] = str_random(30);
                $user["tmp_password"] = $input["password"];
                DB::table("users_activations")->insert(["user_id" => $user["id"], "token" => $user["link"]]);
                Mail::send("Notifications.activation", $user, function($message) use ($user) {
                    $message->to($user["email"]);
                    $message->subject("Superfuds - Codigo Activación");
                });
                return redirect()->to("login")->with("success", "Se ha enviado el codigo con la activación, por favor revisa tu email");
            } else {
                return back()->with("error_email", "¡Email ya existe en nuestro sistema!");
            }
        }

        return back()->with("error", $validator->errors());
    }

    public function showActivation($token) {
        return view("Administration.Profile.activation", compact("token"));
    }

    protected function userActivation(Request $req) {
        $in = $req->all();
        $check = DB::table("users_activations")->where("token", $in["token"])->first();

        if (is_null($check)) {
            return redirect()->to("login")->with("warning", "Tu usuario ya ha sido activado!");
        }

        $user = \App\Models\Security\Users::find($check->user_id);

        $validator = $this->validatorActivation($in);

        if (!$validator->failed()) {
            $user->status_id = 1;
            $user->save();
//            DB::table("users_activations")->where("token", $in["token"])->delete();
            $user->password = Hash::make($in["password"]);
            $user->save();

            
            

            $this->guard("admins")->login($user);

            return redirect()->to("home")->with("success", "Bienvenido");
        }


        return back()->with("error", $validator->errors());
    }

    protected function validatorActivation(array $data) {

        return Validator::make($data, [
                    'tmp_password' => 'required|string|max:255',
                    'password' => 'required|string|min:6|confirmed',
                    'password_confirmation' => 'required|string|min:6',
        ]);
    }

}
