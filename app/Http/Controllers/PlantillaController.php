<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PlantillasExcelExport;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Plantilla;

class PlantillaController extends Controller
{
    public function create(Request $request): View
    {
        $plantilla = Plantilla::where('titulo', $request->titulo)->first();
        //dd($plantilla->plataformas_lanzamiento);
        return view('plantilla')->with(['plantilla' => $plantilla]);
    }

    public function eliminarPlantilla(Request $request){
        $plantilla = Plantilla::find($request->id);

        $nombrePlantillaEliminada = $plantilla->titulo;
        $plantilla->delete();

        return redirect()->route('carga-perfil', ['usuario' => Auth::user()->name])->with([
            'bandEliminado' => true,
            'nombrePlantillaEliminada' => $nombrePlantillaEliminada
        ]);
    }

    public function exportaPlantillaPdf(Request $request){
        //dd($request->id);
        $plantilla = Plantilla::find($request->id);

        $pdf = Pdf::loadView('exports.plantillaPDF', compact('plantilla'));
        
        return $pdf->download('Plantilla GDD - '.$plantilla->titulo.'.pdf');
    }

    public function exportarPlantillasExcel(Request $request){
        switch ($request->filtro) {
            case 'consola':
                $nombreReporte = "Plantillas GDD - Plantillas de consola.xlsx";
                break;

            case 'movil':
                $nombreReporte = "Plantillas GDD - Plantillas de móvil.xlsx";
                break;

            case 'pc':
                $nombreReporte = "Plantillas GDD - Plantillas de PC.xlsx";
                break;
            
            default:
                $nombreReporte = "Plantillas GDD - Todas las plantillas.xlsx";
                break;
        }

        //dd($nombreReporte);
        return (new PlantillasExcelExport($request->filtro))->download($nombreReporte);
    }
}
