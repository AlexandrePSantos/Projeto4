<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }  
      

    public function confirmarLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/')->withSuccess('Signed in');
        }
  
        return redirect("login")->withErrors('Utilizador inválido.');
    }



    public function registro()
    {
        return view('auth.register');
    }
      

    public function confirmarRegistro(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("/login")->withSuccess('Conta criada com sucesso.');
    }


    public function create(array $data)
    {
      return User::create([
        'nome' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
        'telefone' => $data['email'],
        'cc' => $data['email'],
        'tipo' => 'prop',
      ]);
    }    
    

    public function dashboard()
    {
        if(Auth::check()){
            $user = Auth::user();
            if ($user->tipo == "prop") {
                return view('props.home');
            } elseif ($user->tipo == "adm") {
                $users = DB::table('users')->get();
                return view('admin.home', ['users' => $users]);
            } elseif ($user->tipo == "adm_cond") {
                $condominios = DB::table('condominios')
                ->where('id_user', '=', $user->id)
                ->get();
                //Session::put('condominio', 2);
                //print(Session::get('variableName'));
                return view('admin_cond.selecionar', ['condominios' => $condominios]);
            } 
        }
  
        return redirect("login");
    }
    

    public function signOut() {
        Session::flush();
        Auth::logout();
  
        return Redirect('login');
    }

    public function esquecerPw() {
        return view('auth.forgot-password');
    }

    public function confirmarEsquecerPw(Request $request) {
        $request->validate(['email' => 'required|email']);
    
        $status = Password::sendResetLink(
            $request->only('email')
        );
    
        return $status === Password::RESET_LINK_SENT
        ? redirect()->route('login')->withSuccess('Verifique o email.')
        : back()->withErrors(['email' => __($status)]);
    }

    public function resetPw($token) {
        return view('auth.reset-password', ['token' => $token]);
    }

    public function confirmarResetPw(Request $request) {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);
    
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );
    
        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->withSuccess('Password modficada.')
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
