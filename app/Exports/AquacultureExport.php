<?php

namespace App\Exports;

use App\Models\Aquaculture as ModelsAquaculture;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;


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
                'Jenis Budidaya' => $aquaculture->cultivationType,
                'Tahap Budidaya' => $aquaculture->cultivationStage
            ];
        });
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:I1');
        $sheet->getStyle('A1:J2')->getFont()->setBold(true);
        $sheet->getStyle('A1:J1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1:I1')->getAlignment()->setVertical('center');

        $sheet->getStyle('A1:I2')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        $sheet->getColumnDimension('A')->setWidth(30);
        $sheet->getColumnDimension('B')->setWidth(13);
        $sheet->getColumnDimension('C')->setWidth(13);
        $sheet->getColumnDimension('D')->setWidth(26);
        $sheet->getColumnDimension('E')->setWidth(12);
        $sheet->getColumnDimension('F')->setWidth(18);
        $sheet->getColumnDimension('G')->setWidth(12);
        $sheet->getColumnDimension('H')->setWidth(20);
        $sheet->getColumnDimension('I')->setWidth(20);

        $sheet->getRowDimension('1')->setRowHeight(60);
        $sheet->getStyle('A1')->getFont()->setSize(16);
    }

    public function registerEvents() : array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                $text = 'Daftar Perikanan Budi Daya';
                $event->sheet->setCellValue('A1', $text);


                $sheet = $event->sheet;
                $sheet->getColumnDimension('A')->setAutoSize(true);
                $sheet->getColumnDimension('B')->setAutoSize(true);
                $sheet->getColumnDimension('C')->setAutoSize(true);
                $sheet->getColumnDimension('D')->setAutoSize(true);
                $sheet->getColumnDimension('E')->setAutoSize(true);
                $sheet->getColumnDimension('F')->setAutoSize(true);
                $sheet->getColumnDimension('G')->setAutoSize(true);
                $sheet->getColumnDimension('H')->setAutoSize(true);
                $sheet->getColumnDimension('I')->setAutoSize(true);

                // Load the image
                $drawing = new Drawing();
                $drawing->setPath(public_path('img/logo_pohuwato.png')); // Path to your image file
                $drawing->setCoordinates('A1');

                // Set image width and height
                $rowHeight = $event->sheet->getRowDimension(1)->getRowHeight();
                $imageHeight = $rowHeight - 3; // Subtract some padding
                $ratio = $drawing->getHeight() / $drawing->getWidth();
                $imageWidth = $imageHeight / $ratio;
                $drawing->setWidth($imageWidth);
                $drawing->setHeight($imageHeight);

                // Calculate coordinates to position the image closer to the text
                $textLength = strlen($text);
                $textWidth = $textLength * 9; // Assuming 9 as average character width
                $imageOffsetX = $textWidth + 10; // Adjust this offset as needed
                $imageOffsetY = 10; // Adjust this offset as needed
                $drawing->setOffsetX($imageOffsetX);
                $drawing->setOffsetY($imageOffsetY);

                $drawing->setWorksheet($event->sheet->getDelegate());

                // Adjust alignment of text
                $event->sheet->getStyle('A1')->getAlignment()->setVertical('center');
                $event->sheet->getStyle('B1')->getAlignment()->setVertical('center');

                $sheet->setCellValue('A1', 'Daftar Perikanan Budi Daya');

                // Set baris pertama untuk header
                $sheet->setCellValue('A2', 'No');
                $sheet->setCellValue('B2', 'Nama Pembudidaya'); 
                $sheet->setCellValue('C2', 'Jenis Kelamin');
                $sheet->setCellValue('D2', 'Kecamatan');
                $sheet->setCellValue('E2', 'Desa');
                $sheet->setCellValue('F2', 'Luas Tambak');
                $sheet->setCellValue('G2', 'Status');
                $sheet->setCellValue('H2', 'Jenis Budi Daya');
                $sheet->setCellValue('I2', 'Tahap Budi Daya');

                $row = 3;
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
                    $sheet->setCellValue('H' . $row, $aquaculture->cultivationType);
                    $sheet->setCellValue('I' . $row, $aquaculture->cultivationStage);

                    $sheet->getStyle('A3:I' .$row)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $row++;
                    $no++ ;
                }

            },
        ];
    }

}