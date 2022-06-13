<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\TipoUsuarios;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'image' => ['required', 'string'],
            'imagePreview' => ['required', 'string'],
            'name' => ['required', 'string', 'max:255'],
            'usuario' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $tipoUsuarios = TipoUsuarios::all();
        if ($tipoUsuarios->isEmpty()) {
            $tipos = [
                ['nombre' => 'Administrador', 'descripcion' => 'Administrador del sistema'],
                ['nombre' => 'Usuario', 'descripcion' => 'Usuario del sistema'],
            ];
            TipoUsuarios::insert($tipos);
        }
        $user =  User::create([
            'name' => $data['name'],
            'usuario' => $data['usuario'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $imagen = $data['imagePreview'];
        $imagen = explode(',', $imagen);
        $imagenName = $user->id.'.png';
        $path = 'storage/images/profiles/'.$imagenName;
        file_put_contents($path, base64_decode($imagen[1]));
        $user->imagen = $path;
        $user->save();
        return $user;
    }


}
