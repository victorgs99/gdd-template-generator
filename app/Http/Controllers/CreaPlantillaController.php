<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

use App\Imports\PlantillaImport;

use App\Models\MecanicaJuego;
use App\Models\PalabraClave;
use App\Models\Plantilla;
use App\Models\PlantillaPlataformas;
use App\Models\PlataformaLanzamiento;
use App\Models\ReferenciaJuego;

class CreaPlantillaController extends Controller
{
    public function create(): View
    {
        $listaPlataformas = PlataformaLanzamiento::all();
        //dd($listaPlataformas);
        return view('agregaPlantilla')->with(['plataformas' => $listaPlataformas]);
    }

    public function crearPlantillaPorFormulario(Request $request){
        //dd(Auth::user()->name);
        //dd($request);

        /* Almacenar imágenes en storage*/

        // Guarda imagen de referencias visuales en storage
        $request->file('imgReferenciasVisuales')->storeAs('public/plantillas/'.$request->titulo, 'Referencias-Visuales.'.$request->file('imgReferenciasVisuales')->getClientOriginalExtension());
        
        // Guarda imagenes de mecanicas de juego en storage
        $imgMecanicasNombre = array();
        $i = 0;

        foreach($request->file('mecanica') as $mecanica){
            $i++;
            $mecanica['img']->storeAs('public/plantillas/'.$request->titulo, 'Mecanica-Juego-'.$i.'.'.$mecanica['img']->getClientOriginalExtension());
            $imgMecanicasNombre[] = 'Mecanica-Juego-'.$i.'.'.$mecanica['img']->getClientOriginalExtension();
        }


        /* Guarda la información del formulario */

        // Crea plantilla
        $plantilla = new Plantilla();
        $plantilla->titulo = $request->titulo;
        $plantilla->descripcion_corta = $request->descripcionCorta;
        $plantilla->img_referencias_visuales = 'Referencias-Visuales.'.$request->file('imgReferenciasVisuales')->getClientOriginalExtension();
        $plantilla->publico_dirigido = $request->publicoDirigido;
        $plantilla->creador_id = Auth::user()->creador->id;
        $plantilla->save();
        
        // Crea enlace de plataformas de lanzamiento a la plantilla recién creada
        foreach($request->plataformasLanzamiento as $idPlataforma){
            $plataformasPlantilla = new PlantillaPlataformas();
            $plataformasPlantilla->plantilla_id = $plantilla->id;
            $plataformasPlantilla->plataforma_lanzamiento_id = $idPlataforma;
            $plataformasPlantilla->save();
        }

        // Crea las referencias de juego de la plantilla
        foreach($request->referenciasJuego as $referencia){
            $referenciaJuego = new ReferenciaJuego();
            $referenciaJuego->referencia = $referencia;
            $referenciaJuego->plantilla_id = $plantilla->id;
            $referenciaJuego->save();
        }

        // Crea las palabras clave de la plantilla
        foreach($request->palabrasClave as $palabraClv){
            $palabraClave = new PalabraClave();
            $palabraClave->palabra = $palabraClv;
            $palabraClave->plantilla_id = $plantilla->id;
            $palabraClave->save();
        }
        
        // Crea las mecánicas de juego de la plantilla
        $j = 0;

        foreach($request->mecanica as $mecanica){
            $mecanicaJuego = new MecanicaJuego();
            $mecanicaJuego->img = $imgMecanicasNombre[$j];
            $mecanicaJuego->descripcion = $mecanica['descripcion'];
            $mecanicaJuego->plantilla_id = $plantilla->id;
            $mecanicaJuego->save();
            $j++;
        }

        return redirect()->route('carga-perfil', ['usuario' => Auth::user()->name]);
    }

    public function crearPlantillaPorImportacion(Request $request){
        Excel::import(new PlantillaImport(Auth::user()->creador->id), $request->file('plantilla_importada'));
        
        return redirect()->route('carga-perfil', ['usuario' => Auth::user()->name]);
    }
}
