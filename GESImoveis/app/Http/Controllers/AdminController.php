<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Contrato;
use App\Models\Despesa;
use App\Models\Imovel;
use App\Models\Inquilino;
use App\Models\Pagamento;
use App\Models\TipoContrato;
use App\Models\TipoDespesa;
use App\Models\TipoImovel;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.index');
    }

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function AdminLogin()
    {
        return view('admin.admin_login');
    }

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile_view',compact('profileData'));
    }

    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->titulo = $request->titulo;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->telemovel = $request->telemovel;
        $data->telefone = $request->telefone;
        $data->nif = $request->nif;
        $data->pais = $request->pais;
        $data->cidade = $request->cidade;
        $data->morada = $request->morada;
        $data->morada = $request->morada;
        $data->codigo_postal = $request->codigo_postal;

        if($request->file('foto')){
            $file = $request->file('foto');
            @unlink(public_path('upload/admin_images/'.$data->foto));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['foto'] = $filename;
        }

        // Password change logic
        if($request->old_password && $request->new_password) {
            $request->validate([
                'old_password' => 'required',
                'new_password' => 'required|confirmed'
            ]);

            if(!Hash::check($request->old_password,auth::user()->password)){
                $notification = array(
                    'message' => 'Password antiga incorreta!',
                    'alert-type' => 'error'
                );
                return back()->with($notification);
            }

            $data->password = Hash::make($request->new_password);
        }

        $data->save();

        $notification = array(
            'message' => 'Perfil atualizado com sucesso',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

}
