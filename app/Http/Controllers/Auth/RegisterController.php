<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
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
            'email'      => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'   => ['required', 'string', 'min:6', 'confirmed'],
            'last_name'  => ['required', 'string', 'alpha', 'max:255'],
            'first_name' => ['required', 'string', 'alpha', 'max:255'],
            'patronymic' => ['required', 'string', 'alpha', 'max:255'],
            'phone'      => ['required', 'regex:/(380)[0-9]{9}/', 'unique:users'],
            ],

        /**
         * Сообщения об ошибке валидации
         */

        [
            'required'       => 'Поле \':attribute\' является обязательным к заполнению.',
            'string'         => 'Поле \':attribute\' должно быть строкой',
            'email'          => 'Значение поля \':attribute\' должно иметь вид электронной почты.',
            'max'            => 'Поле \':attribute\' не должно превышать :max символов.',
            'min'            => 'Поле \':attribute\' должно содержать минимум :min символов.',
            'email.unique'   => 'Аккаунт с таким эмейлом уже зарегистрирован.',
            'phone.unique'   => 'Аккаунт с таким номером телефона уже зарегистрирован.',
            'confirmed'      => 'Пароль не совпадает с введённым в поле подтверждения пароля.',
            'alpha'          => 'Поле \':attribute\' должно содержать только буквы.',
            'phone.regex'    => 'Номер должен начинаться с 380 и соответстовать формату украинского номера.',
        ],

        /**
         * Переопределённые названия аттрибутов
         */

        [
            'email'      => 'E-mail',
            'password'   => 'Пароль',
            'last_name'  => 'Фамилия',
            'first_name' => 'Имя',
            'patronymic' => 'Отчество',
            'phone'      => 'Номер телефона',
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
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'last_name' => $data['last_name'],
            'first_name' => $data['first_name'],
            'patronymic' => $data['patronymic'],
            'phone' => $data['phone'],
        ]);
    }
}
