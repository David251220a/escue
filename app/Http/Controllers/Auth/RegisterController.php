<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Persona;
use App\Models\User;
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
    protected $redirectTo = '/home';

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'documento' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    if (User::where('documento', $value)->exists()) {
                        $fail('Ya existe un usuario registrado con este número de documento.');
                    }
                },
            ],
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

        $documento = $data['documento'];
        $persona = Persona::firstOrCreate(
            ['documento' => $documento],
            [
                'nombre' => $data['name'],
                'apellido' => $data['lastname'],
                'pais_id' => 1,
                'estado_id' => 1,
                'fecha_nacimiento' => null,
                'sexo' => 1,
                'email' => $data['email'],
                'celular' => null,
                'direccion' => ' ',
                'foto' => null,
            ]
        );

        return User::create([
            'documento' => $data['documento'],
            'name' => $data['name'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
