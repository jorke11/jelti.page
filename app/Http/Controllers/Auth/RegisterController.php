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
use App\Traits\InformationClient;

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
    use InformationClient;

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
                    'last_name' => 'required|string|max:255',
                    'document' => 'required|string|max:255|min:6',
                    'email' => 'required|string|email|max:255|unique:users',
                    'phone_contact' => 'required|string|min:10'
                ])->validate();
//        ]);
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
                    'document' => $data['document'],
                    'password' => bcrypt($data['password']),
                    'role_id' => $data['role_id'],
                    'status_id' => $data['status_id'],
        ]);
    }

    public function register(Request $req) {
        $input = $req->all();
        $input["document"] = (isset($input["document_client"])) ? $input["document_client"] : $input["document"];
        $input["phone_contact"] = (isset($input["phone"])) ? $input["phone"] : $input["phone_contact"];
        $val = $this->validator($input);


        $input["phone"] = (isset($input["phone_contact"])) ? $input["phone_contact"] : $input["phone"];
        $input["business"] = $input["name"] . " " . $input["last_name"];

        $valida_mail = DB::table("users")->where("email", $input["email"])->first();



        if (is_null($valida_mail)) {
            $valida_doc = DB::table("stakeholder")->where("document", $input["document"])->first();

            if (is_null($valida_doc)) {

                $input["role_id"] = 2;
                $input["status_id"] = 0;
                $input["password"] = str_random(6);
                $user = $this->create($input)->toArray();
                $user["link"] = str_random(30);
                $user["phone_contact"] = $input["phone_contact"];

                DB::table("users_activations")->insert(["user_id" => $user["id"], "token" => $user["link"]]);

                //id yeni ruiz
                $new["responsible_id"] = 184;

                $new["login_web"] = true;
                $new["document"] = $input["document"];
                $new["verification"] = $this->numberVerification($input["document"]);
                $new["type_document"] = 1;
                $new["business"] = isset($input["business_name"]) ? $input["business_name"] : '';
                $new["business_name"] = $input["name"] . " " . $input["last_name"];
                $new["user_insert"] = $user["id"];
                $new["status_id"] = 2;
                $new["type_stakeholder_id"] = json_encode([1]);
                $new["term"] = 1;
                $new["phone"] = trim($input["phone_contact"]);
                $new["email"] = $input["email"];

                DB::table("stakeholder")->insert($new);
                $stake = \App\Models\Administration\Stakeholder::where("document", $input["document"])->first();
                $users = \App\Models\Security\Users::find($user["id"]);
                $users->stakeholder_id = $stake->id;
                $users->save();

                $email = \App\Models\Administration\Email::where("description", "page")->first();

                if ($email != null) {
                    $emDetail = \App\Models\Administration\EmailDetail::where("email_id", $email->id)->get();

                    if ($emDetail != null) {
                        foreach ($emDetail as $value) {
                            $this->mails[] = $value->description;
                        }
                    }
                }

                Mail::send("Notifications.activation", $user, function($message) use ($user) {
                    $message->to($user["email"]);
                    $message->bcc($this->mails);
                    $message->subject("Superfuds - Codigo Activación");
                });
                return redirect()->to("login")->with("success", "Se ha enviado el codigo con la activación, por favor revisa tu email");
            } else {
                return back()->with("error_email", "¡Documento ya existe en nuestro sistema!");
            }
        } else {
            return back()->with("error_email", "¡Email ya existe en nuestro sistema!");
        }
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

        $this->validatorActivation($in);

        $user->status_id = 1;
        $user->save();
        DB::table("users_activations")->where("token", $in["token"])->delete();
        $user->password = Hash::make($in["password"]);
        $user->save();
        $this->guard("admins")->login($user);

        return redirect()->to("home")->with("success", "Bienvenido");



//        return back()->with("error", $validator->errors());
    }

    protected function validatorActivation(array $data) {
        return Validator::make($data, [
                    'password' => 'required|string|min:6|confirmed',
                ])->validate();
    }

}
