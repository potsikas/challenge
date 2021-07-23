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
        
        $name = 'last_30_days_payments'.time().'.csv';
        Storage::disk('csv')->put($name, '','public');
        $handle = fopen($_SERVER['DOCUMENT_ROOT'].'/csv/'.$name, 'w');
        //Get Data
        $data=Payment::getLast30Days($date);
        foreach($data as $payment){
            fputcsv($handle, array($payment->client->name,$payment->client->surname,$payment->amount,$payment->created_at));
        }
        fclose($handle);
        $headers = array(
            'Content-Type' => 'text/csv'
            
        );
         response()->download($_SERVER['DOCUMENT_ROOT'].'/csv/'.$name, $name, $headers);

    }
}
