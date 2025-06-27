<?php

namespace App\Exports;

use App\Models\SumberEmisi;
use Maatwebsite\Excel\Concerns\FromCollection;

class SumberEmisiExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SumberEmisi::all();
    }
}
