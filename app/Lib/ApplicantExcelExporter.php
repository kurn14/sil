<?php

namespace App\Lib;

use App\Models\Applicant;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ApplicantExcelExporter
{
    /**
     * Export all applicants to an Excel file.
     *
     * @return StreamedResponse
     */
    public static function downloadExcel(): StreamedResponse
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Define Header
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Email');
        $sheet->setCellValue('D1', 'Phone Number');
        $sheet->setCellValue('E1', 'NIK');
        $sheet->setCellValue('F1', 'Address');
        $sheet->setCellValue('G1', 'Institution');
        $sheet->setCellValue('H1', 'Registered At');

        // Style Header
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);

        $row = 2;
        foreach (Applicant::query()->cursor() as $applicant) {
            $sheet->setCellValue('A' . $row, $applicant->id);
            $sheet->setCellValue('B' . $row, $applicant->name);
            $sheet->setCellValue('C' . $row, $applicant->email);
            // Prefixing with a space or quote to prevent numbers from being parsed incorrectly if they are long
            $sheet->setCellValueExplicit('D' . $row, $applicant->phone_number, DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('E' . $row, $applicant->nik, DataType::TYPE_STRING);
            $sheet->setCellValue('F' . $row, $applicant->address);
            $sheet->setCellValue('G' . $row, $applicant->institution_name);
            $sheet->setCellValue('H' . $row, $applicant->created_at?->format('Y-m-d H:i:s'));
            $row++;
        }

        // Auto-size columns
        foreach (range('A', 'H') as $columnID) {
            $sheet->getColumnDimension($columnID)->setAutoSize(true);
        }

        return response()->streamDownload(function () use ($spreadsheet) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, 'applicants_data_' . date('Ymd_His') . '.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
