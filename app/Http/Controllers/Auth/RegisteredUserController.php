<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
{
    $request->validate(

        [
            'name' => ['required', 'string', 'max:255'],

            'username' => [
                'required',
                'string',
                'max:255',
                'unique:users'
            ],

            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users'
            ],

            'phone' => [
                'required',
                'regex:/^[0-9]{9}$/'
            ],

            'password' => [
                'required',
                'confirmed',
                'min:8',
                'regex:/[@$!%*#?&^]/'
            ],
        ],

        [
            'phone.regex' =>
                'Numărul de telefon trebuie să conțină exact 9 cifre.',

            'password.regex' =>
                'Parola trebuie să conțină cel puțin un caracter special.',
        ]

    );

        $user = User::create([
    'name' => $request->name,

    'username' => $request->username,

    'email' => $request->email,

    'phone' => $request->phone,

    'password' => Hash::make($request->password),

    'role' => 'user',
]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('loading');
    }
}
