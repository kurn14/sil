<?php

namespace App\Lib;

use App\Models\Applicant;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;

class ApplicantPdfExporter
{
    /**
     * Export all applicants to a PDF file.
     *
     * @return Response
     */
    public static function downloadPdf()
    {
        $applicants = Applicant::all();

        $pdf = Pdf::loadView('pdf.applicants', [
            'applicants' => $applicants
        ])->setPaper('a4', 'landscape');

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'applicants_data_' . date('Ymd_His') . '.pdf');
    }
}
