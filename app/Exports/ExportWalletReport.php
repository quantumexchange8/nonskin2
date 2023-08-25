<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class ExportWalletReport implements FromCollection
{

    public function collection()
    {
        // Return the data you want to export as a collection
    }
}