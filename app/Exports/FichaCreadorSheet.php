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
use App\Models\Creador;

class FichaCreadorSheet extends StringValueBinder implements FromView, WithTitle, ShouldAutoSize, WithCustomValueBinder, WithStyles
{
    protected $filtro;
    
    public function __construct($filtro)
    {
        $this->filtro = $filtro;
    }

    public function title(): string
    {
        return 'Datos de contacto de creadores';
    }

    public function styles(Worksheet $sheet)
    {
        $styleArray_A1E1 = [
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

        $styleArray_A2E2 = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['argb' => 'FF00000000'],
                ],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'color' => ['rgb' => 'B7DEE8']
            ],
            'font' => [
                'size' => 13,
            ],
        ];

        $styleArray_A3HRC = [
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
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

        $styleArray_AllColumn = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['argb' => 'FF00000000'],
                ],
            ],
        ];


        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();

        $sheet->getStyle("A3:{$lastColumn}{$lastRow}")->applyFromArray($styleArray_A3HRC);
        $sheet->getStyle('A1:E1')->applyFromArray($styleArray_A1E1);
        $sheet->getStyle('A2:E2')->applyFromArray($styleArray_A2E2);
        $sheet->getStyle("A3:A{$lastRow}")->applyFromArray($styleArray_AllColumn);
        $sheet->getStyle("B3:B{$lastRow}")->applyFromArray($styleArray_AllColumn);
        $sheet->getStyle("C3:C{$lastRow}")->applyFromArray($styleArray_AllColumn);
        $sheet->getStyle("D3:D{$lastRow}")->applyFromArray($styleArray_AllColumn);
        $sheet->getStyle("E3:E{$lastRow}")->applyFromArray($styleArray_AllColumn);
    }

    public function view(): View
    {
        switch ($this->filtro) {
            case 'consola':
                $creadores = Creador::whereHas('plantillas', function($query){
                    $query->whereHas('plataformas_lanzamiento', function($query){
                        $query->where('plataforma_lanzamiento_id', '1')->orWhere('plataforma_lanzamiento_id', '2')->orWhere('plataforma_lanzamiento_id', '3');
                    });    
                })->get();
                break;

            case 'movil':
                $creadores = Creador::whereHas('plantillas', function($query){
                    $query->whereHas('plataformas_lanzamiento', function($query){
                        $query->where('plataforma_lanzamiento_id', '4');
                    });
                })->get();
                break;

            case 'pc':
                $creadores = Creador::whereHas('plantillas', function($query){
                    $query->whereHas('plataformas_lanzamiento', function($query){
                        $query->where('plataforma_lanzamiento_id', '5');
                    });
                })->get();
                break;
            
            default:
                $creadores = Creador::whereHas('plantillas', function($query){})->get();
                break;
        }

        return view('exports.fichasCreador', [
            'creadores' => $creadores,
        ]);
    }
}
