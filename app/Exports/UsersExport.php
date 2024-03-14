<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UsersExport implements FromCollection, WithEvents, WithStyles
{
    protected $users;

    public function __construct($users)
    {
        $this->users = $users;
    }
    public function collection()
    {
        return $this->users->map(function ($user) {
            return [
                'Nama' => $user->username,
                'Penyuluh' => $user->role,
                'Email' => $user->email,

            ];
        });
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:D1');
        $sheet->getStyle('A1:D2')->getFont()->setBold(true);
        $sheet->getStyle('A1:D1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1:D1')->getAlignment()-> setVertical('center');

        $sheet->getStyle('A1:D2')->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        $sheet->getColumnDimension('A')->setWidth(10);
        $sheet->getColumnDimension('B')->setWidth(13);
        $sheet->getColumnDimension('C')->setWidth(20);
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

                $sheet->setCellValue('A1', 'Daftar Pengguna');

                $sheet->setCellValue('A2', 'No');
                $sheet->setCellValue('B2', 'Nama'); 
                $sheet->setCellValue('C2', 'Penyuluh');
                $sheet->setCellValue('D2', 'Email');

                $row = 3;
                $no = 1;

                $users = User::orderBy('username')->get();
                foreach ($users as $user) {
                    $sheet->setCellValue ('A' . $row, $no);
                    $sheet->setCellValue ('B' . $row, $user->username);
                    $sheet->setCellValue ('C' . $row, $user->role);
                    $sheet->setCellValue ('D' . $row, $user->email);

                    $sheet->getStyle('A3:D'.$row)->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
                    $row++;
                    $no++ ;
                }
            },
        ];
    }

}
