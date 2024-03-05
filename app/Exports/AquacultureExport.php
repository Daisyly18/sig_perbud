<?php

namespace App\Exports;

use App\Models\Aquaculture as ModelsAquaculture;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class AquacultureExport implements FromCollection, WithEvents, WithStyles
{
    protected $aquacultures;

    public function __construct($aquacultures)
    {
        $this->aquacultures = $aquacultures;
    }
    public function collection()
    {
        return $this->aquacultures->map(function ($aquaculture) {
            return [
                'Nama Pembudidaya' => $aquaculture->ponds,
                'Jenis Kelamin' => $aquaculture->gender,
                'Kecamatan' => $aquaculture->district,
                'Desa' =>  $aquaculture->village,
                'Luas Tambak'  => $aquaculture->pondArea,
                'status' => $aquaculture->status,
                // 'Jenis Budidaya' => $aquaculture->cultivationType,
                // 'Tahap Budidaya' => $aquaculture->cultivationStage
            ];
        });
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:J1');
        $sheet->getStyle('A1:J2')->getFont()->setBold(true);
        $sheet->getStyle('A1:J1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1:I1')->getAlignment()->setVertical('center');

        $sheet->getStyle('A1:I2')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(13);
        $sheet->getColumnDimension('C')->setWidth(13);
        $sheet->getColumnDimension('D')->setWidth(26);
        $sheet->getColumnDimension('E')->setWidth(12);
        $sheet->getColumnDimension('F')->setWidth(18);
        $sheet->getColumnDimension('G')->setWidth(12);
        // $sheet->getColumnDimension('H')->setWidth(20);
        // $sheet->getColumnDimension('I')->setWidth(20);
    }

    public function registerEvents() : array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;
                $sheet->getColumnDimension('A')->setAutoSize(true);
                $sheet->getColumnDimension('B')->setAutoSize(true);
                $sheet->getColumnDimension('C')->setAutoSize(true);
                $sheet->getColumnDimension('D')->setAutoSize(true);
                $sheet->getColumnDimension('E')->setAutoSize(true);
                $sheet->getColumnDimension('F')->setAutoSize(true);
                $sheet->getColumnDimension('G')->setAutoSize(true);
                // $sheet->getColumnDimension('H')->setAutoSize(true);
                // $sheet->getColumnDimension('I')->setAutoSize(true);

                $sheet->setCellValue('A1', 'Daftar Perikanan Budi Daya');

                // Set baris pertama untuk header
                $sheet->setCellValue('A2', 'No');
                $sheet->setCellValue('B2', 'Nama Pembudidaya'); 
                $sheet->setCellValue('C2', 'Jenis Kelamin');
                $sheet->setCellValue('D2', 'Kecamatan');
                $sheet->setCellValue('E2', 'Desa');
                $sheet->setCellValue('F2', 'Luas Tambak');
                $sheet->setCellValue('G2', 'Status');
                // $sheet->setCellValue('H2', 'Jenis Budi Daya');
                // $sheet->setCellValue('I2', 'Tahap Budi Daya');

                $row = 4;
                $no = 1;

                //Ambil data perikanan budi daya berdasarkan kecamatan dan urutkan sesuai kecamatan
                $aquacultures = ModelsAquaculture::orderBy('district')->get();

                foreach  ($aquacultures as $aquaculture) {
                    $sheet->setCellValue('A' . $row, $no);
                    $sheet->setCellValue('B' . $row, $aquaculture->ponds);
                    $sheet->setCellValue('C' . $row, $aquaculture->gender);
                    $sheet->setCellValue('D' . $row, $aquaculture->district);
                    $sheet->setCellValue('E' . $row, $aquaculture->village);
                    $sheet->setCellValue('F' . $row, $aquaculture->pondArea);
                    $sheet->setCellValue('G' . $row, $aquaculture->status);
                    // $sheet->setCellValue('H' . $row, $aquaculture->cultivationType);
                    // $sheet->setCellValue('I' . $row, $aquaculture->cultivationStage);

                    $sheet->getStyle('A3:I' .$row)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $row++;
                    $no++ ;
                }

            },
        ];
    }

}