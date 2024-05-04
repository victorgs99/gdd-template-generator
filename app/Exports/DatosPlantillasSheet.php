<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\StringValueBinder;

use App\Models\Plantilla;

class DatosPlantillasSheet extends StringValueBinder implements FromView, WithTitle, ShouldAutoSize, WithCustomValueBinder, WithStyles
{
    protected $filtro;
    
    public function __construct($filtro)
    {
        $this->filtro = $filtro;
    }

    public function title(): string
    {
        return 'Plantillas de creadores';
    }

    public function styles(Worksheet $sheet)
    {
        $styleArray_A1J1 = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['argb' => 'FF00000000'],
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['rgb' => '92CDDC']
            ],
            'font' => [
                'size' => 14,
            ],
        ];

        $styleArray_A2HRC = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => 'FF00000000'],
                ],
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['argb' => 'FF00000000'],
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['rgb' => 'DAEEF3']
            ],
            'font' => [
                'size' => 12,
            ],
        ];


        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();

        $sheet->getStyle("A2:{$lastColumn}{$lastRow}")->applyFromArray($styleArray_A2HRC);
        $sheet->getStyle('A1:J1')->applyFromArray($styleArray_A1J1);
    }

    public function view(): View
    {
        switch ($this->filtro) {
            case 'consola':
                $plantillas = Plantilla::whereHas('plataformas_lanzamiento', function($query){
                    $query->where('plataforma_lanzamiento_id', '1')->orWhere('plataforma_lanzamiento_id', '2')->orWhere('plataforma_lanzamiento_id', '3');
                })->get();
                break;

            case 'movil':
                $plantillas = Plantilla::whereHas('plataformas_lanzamiento', function($query){
                    $query->where('plataforma_lanzamiento_id', '4');
                })->get();
                break;

            case 'pc':
                $plantillas = Plantilla::whereHas('plataformas_lanzamiento', function($query){
                    $query->where('plataforma_lanzamiento_id', '5');
                })->get();
                break;
            
            default:
                $plantillas = Plantilla::all();
                break;
        }

        return view('exports.plantillasCreadores', [
            'plantillas' => $plantillas,
        ]);
    }
}
