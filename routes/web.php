<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CreaPlantillaController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\PlantillaController;

use App\Models\Plantilla;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
/*Route::get('/index', function () {
    return view('welcome');
});*/


/*Rutas generales*/
Route::get('/', function () {
    $plantillas = Plantilla::all();

    return view('index')->with('plantillas', $plantillas);
})->name('index');




Route::get('/vistadatosreporte', function () {
    $plantillas = Plantilla::whereHas('plataformas_lanzamiento', function($query){
        $query->where('plataforma_lanzamiento_id', '2')->orWhere('plataforma_lanzamiento_id', '3');
    })->get();

    return view('exports.fichasCreador')->with('plantillas', $plantillas);
})->name('pruebareporte');

Route::get('/vistaplantillasreporte', function () {
    $plantillas = Plantilla::whereHas('plataformas_lanzamiento', function($query){
        $query->where('plataforma_lanzamiento_id', '1');
    })->get();

    return view('exports.plantillasCreadores')->with('plantillas', $plantillas);
})->name('pruebareporte');

Route::get('/vistapdf', function () {
    $plantilla = Plantilla::find('5');

    return view('exports.plantillaPDF')->with('plantilla', $plantilla);
})->name('pruebareporte');





Route::get('/acercade', function () {
    return view('acercade');
})->name('acercaDe');

Route::get('/plantilla/{titulo}', [PlantillaController::class, 'create'])->middleware([])->name('ver-plantilla');

/* Rutas usuarios autenticados */
Route::middleware('auth')->group(function(){
    // Ver perfil de creador
    Route::get('/perfil/{usuario}', [PerfilController::class, 'create'])->middleware([])->name('carga-perfil');

    // Editar perfil
    Route::get('/perfil/datosContacto/editar', [PerfilController::class, 'createEdicionPerfil'])->middleware([])->name('editar-perfil');
    Route::post('/edita/datosContacto', [PerfilController::class, 'editaDatosContacto'])->middleware([])->name('edita-datosContacto');

    /* Operaciones de plantilla */
    // Crear - importar plantilla
    Route::get('/plantilla/operacion/crear', [CreaPlantillaController::class, 'create'])->middleware([])->name('crear-plantilla');
    Route::post('/plantilla/crear/crea', [CreaPlantillaController::class, 'crearPlantillaPorFormulario'])->middleware([])->name('crea-plantillaFormulario');
    Route::post('/plantilla/crear/importa', [CreaPlantillaController::class, 'crearPlantillaPorImportacion'])->middleware([])->name('crea-plantillaImportacion');

    // Eliminar plantilla
    Route::get('/plantilla/operacion/eliminar', [PlantillaController::class, 'eliminarPlantilla'])->middleware([])->name('elimina-plantilla');

    // Exportar plantilla en pdf
    Route::get('/plantilla/operacion/exporta-pdf/{id}', [PlantillaController::class, 'exportaPlantillaPdf'])->middleware([])->name('exporta-plantillaPdf');

    // ADMIN - Exportar plantillas en excel
    Route::get('/plantilla/operacion/exporta-excel/{filtro}', [PlantillaController::class, 'exportarPlantillasExcel'])->middleware([])->name('exporta-plantillaExcel');
});


/*Rutas default breeze*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
