<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

use App\Models\Creador;
use App\Models\Plantilla;

class PerfilController extends Controller
{
    public function create(Request $request): View
    {
        $creador = Creador::whereHas('usuario', function($query) use ($request){
            $query->where('name', $request->usuario);
        })->first();

        $listaPlantillas = Plantilla::where('creador_id', $creador->id)->get();
        
        //dd($listaPlantillas);
        return view('perfil')->with(['creador' => $creador, 'plantillas' => $listaPlantillas]);
    }

    public function createEdicionPerfil(): View{
        $creador = Creador::find(Auth::user()->creador->id);

        return view('editaPerfil')->with('creador', $creador);
    }

    public function editaDatosContacto(Request $request){
        $creador = Creador::find(Auth::user()->creador->id);

        $creador->nombre = $request->nombre;
        $creador->descripcion_personal = $request->descripcionPersonal;
        $creador->correo_contacto = $request->correoContacto;
        $creador->telefono_contacto = $request->telefonoContacto;

        $creador->save();

        return redirect()->route('carga-perfil', ['usuario' => Auth::user()->name])->with('bandEditado', true);
    }
}
