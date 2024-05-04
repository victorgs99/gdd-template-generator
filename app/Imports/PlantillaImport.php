<?php

namespace App\Imports;

//use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithGroupedHeadingRow;

use App\Models\Plantilla;
use App\Models\PlantillaPlataformas;

class PlantillaImport implements WithHeadingRow, OnEachRow, WithGroupedHeadingRow
{
    private $creadorId;

    public function __construct($creadorId){
        $this->creadorId = $creadorId;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray();

        $plantilla = Plantilla::create([
            'img_referencias_visuales' => $row['imagen_referencias_visuales'],
            'titulo' => $row['titulo'],
            'descripcion_corta' => $row['descripcion_corta'],
            'publico_dirigido' => $row['publico_dirigido'],
            'creador_id' => $this->creadorId,
        ]);

        foreach($row['plataforma_lanzamiento'] as $plataformaLanzamiento){
            if (isset($plataformaLanzamiento)){
                $registroPlataforma = PlantillaPlataformas::create([
                    'plantilla_id' => $plantilla->id,
                    'plataforma_lanzamiento_id' => $plataformaLanzamiento,
                ]);
            }
        }

        foreach($row['juego_referencia'] as $referenciaJuego){
            if (isset($referenciaJuego)){
                $plantilla->referencias_juego()->create([
                    'referencia' => $referenciaJuego,
                    'plantilla_id' => $plantilla->id,
                ]);
            }
        }

        foreach($row['palabra_clave'] as $palabraClv){
            if (isset($palabraClv)){
                $plantilla->palabras_clave()->create([
                    'palabra' => $palabraClv,
                    'plantilla_id' => $plantilla->id,
                ]);
            }
        }

        $mecanicas = [];

        foreach ($row as $key => $value) {
            if (strpos($key, 'imagen_mecanica') !== false) {
                $index = str_replace('imagen_mecanica_', '', $key);
                $mecanicas[$index]['img'] = $value;
            }

            if (strpos($key, 'descripcion_mecanica') !== false) {
                $index = str_replace('descripcion_mecanica_', '', $key);
                $mecanicas[$index]['descripcion'] = $value;
            }
        }

        foreach ($mecanicas as $mecanica) {
            if (isset($mecanica['img']) && isset($mecanica['descripcion'])) {
                $mecanica['plantilla_id'] = $plantilla->id;
                $plantilla->mecanicas_juego()->create($mecanica);
            }
        }
    }
}
