<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Storage;

class PaymentsExportCSV extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payments:csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'last payment of each client during the last 30 days';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //30 days before
        $date=Carbon::now();
        $date->subDays(30);
        
        $name = 'last_30_days_payments_'.time().'.csv';
        $handle = fopen(public_path().'/csv/'.$name, 'w');
        //Get Data
        $data=Payment::getLast30Days($date);
        foreach($data as $payment){
            fputcsv($handle, array($payment['name'],$payment['surname'],$payment['amount'],$payment['date']));
        }
        fclose($handle);
        $headers = array(
            'Content-Type' => 'text/csv',
        );
        response()->download(public_path().'/csv/'.$name, $name, $headers);
        echo 'File '.$name.' created at public/csv ! ';
    }
}
