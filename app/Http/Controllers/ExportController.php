<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\ExportWalletReport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\WalletHistory;
use Auth;

class ExportController extends Controller
{
    //
    public function exportCSV(Request $request)
    {
    //     $user = Auth::user();
    //    // Retrieve data to export (e.g., from a database)
    //     $data = WalletHistory::where('user_id', $user->id)->get();
    //     // dd($data);
    //     // Define CSV file name
    //     $filename = "Wallet Report.csv";

    //     // Create a CSV file
    //     $handle = fopen($filename, 'w');

    //     // Add CSV header row
    //     fputcsv($handle, array_keys($data[0]->toArray()));

    //     // Add data rows
    //     foreach ($data as $row) {
    //         fputcsv($handle, $row->toArray());
    //     }

    //     fclose($handle);

    //     // Set response headers for CSV download
    //     header('Content-Type: application/csv');
    //     header('Content-Disposition: attachment; filename="' . $filename . '"');

    //     // Output the CSV file to the browser
    //     readfile($filename);

    //     // Delete the temporary CSV file
    //     unlink($filename);
    }
}
