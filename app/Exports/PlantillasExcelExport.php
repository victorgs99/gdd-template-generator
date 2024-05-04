<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PlantillasExcelExport implements WithMultipleSheets
{
    use Exportable;

    protected $filtro;
    
    public function __construct($filtro)
    {
        $this->filtro = $filtro;
    }

    public function sheets(): array
    {
        $sheets = [];

        $sheets[] = new FichaCreadorSheet($this->filtro);
        $sheets[] = new DatosPlantillasSheet($this->filtro);

        return $sheets;
    }
}
