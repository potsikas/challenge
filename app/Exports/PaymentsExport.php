<?php

namespace App\Exports;

use App\Models\Payment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Carbon\Carbon;


class PaymentsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $date=Carbon::now();
        $date->subDays(30);
        
        return Payment::getLast30Days($date); 
    }
}
