<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('perfil.index');
    }

    public function store(Request $request){
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request,[
            'username' => ['required', 'unique:users,username,'.auth()->user()->id,'min:3','max:20','not_in:editar-perfil'],
            'email' => ['required','unique:users,username,'.auth()->user()->email,'email','max:60']
        ]);

        if($request->imagen){
            $image = $request->file('imagen');

            $nombreImagen = Str::uuid() . "." . $image->extension();
    
            $imagenServidor = Image::make($image);
            $imagenServidor->fit(1000,1000);
    
            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;
            $imagenServidor->save($imagenPath);
        }


        $usuario = User::find(auth()->user()->id);

        if(Hash::check($request->password, auth()->user()->password) ){
            if(!is_null($request->newpassword) && $request->newpassword != $request->password){
                $usuario->password = $request->newpassword;        
            }elseif($request->newpassword === $request->password ){
                return back()->with('newpasswordMensaje', 'El password nuevo es igual al antiguo');
            }else{
                return back()->with('newpasswordMensaje', 'El password esta vacio');
            }
        }else if(!is_null($request->password)){
            return back()->with('passwordMensaje', 'El password no es correcto');
        }else if(!is_null($request->newpassword) && is_null($request->password)){
            return back()->with('passwordMensaje', 'Debes de poner el password actual para poder cambiarlo');
        }


        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? auth()->user()->imagen ?? NULL;
        $usuario->email = $request->email;
        $usuario->save();

        return redirect()->route('posts.index',$usuario->username);
    }
}
