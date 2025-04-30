<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Service;
use App\Models\Application;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class MainController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function showLoginForm()
    {
        return view("login");
    }
    public function showRegistrationForm()
    {
        return view("register");
    }

    // Обрабатывает запрос регистрации пользователя
    public function register(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'username' => ['required', 'string', 'max:255', 'unique:users'],
        //     'surname' => ['required', 'string', 'max:255'],
        //     'patronymic' => ['nullable', 'string', 'max:255'],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        //     'phone' => ['required', 'regex:/^\+?[1-9]\d{1,14}$/', 'unique:users'],
        //     'password' => ['required', 'string', 'min:8', 'confirmed'],
        //     'login' => ['required', 'string', 'max:255', 'unique:users']
        // ]);
        // if ($validator->fails()) {
        //     return redirect()->back()
        //         ->withErrors($validator)
        //         ->withInput();}

        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput();
        // }

        User::create([
        'name' => $request->input('username'),
        'surname' => $request->input('surname'),
        'patronymic' => $request->input('patronymic'),
        'email' => $request->input('email'),
        'phone' => $request->input('phone'),
        'adress' => $request->input('adress'),
        'password' => Hash::make($request->input('password')),
        'login' => $request->input('login'),
        'role_id ' => 2
    ]);

        return redirect()->route('login')->with('success', 'Вы успешно зарегистрировались!');
    }



    // Обрабатывает запрос входа пользователя
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            return redirect()->back()->withErrors(['email' => 'Неверный адрес электронной почты или пароль']);
        }

        $user = Auth::user();
        $request->session()->regenerate();

        if ($user->role === 'Администратор') {
            return redirect()->route('admin.dashboard')->with('success', 'Добро пожаловать в админ-панель!');
        }

        return redirect('/');
    }
 
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function applications()
    {
        $app = Application::where('user_id', Auth::id())->get();        
        return view('applicaions', compact('app'));
    }
    public function applicationCreate()
    {
        $services  = Service::all();
        return view('makeApplication', compact('services'));
    }
    public function store(Request $request)
{
 
    $validatedData = $request->validate([
        'service_id' => 'required|exists:services,id',
        'date' => 'required|date',
        'time' => 'required|date_format:H:i',
        'phone' => 'required|regex:/^\+?[1-9]\d{1,14}$/',
        'payment_type' => 'required|in:cash,card'
    ]);
  
         

        $application = Application::create([
            'service_id' => $validatedData['service_id'],
            'date' => $validatedData['date'],
            'time' => $validatedData['time'],
            'phone' => $validatedData['phone'],
            'user_id' => Auth::id(),
            'payment_type' => $validatedData['payment_type'],
            'status' => 1 
        ]);

        return redirect()->route('applications')
            ->with('success', 'Заявка успешно создана');
     }
}
