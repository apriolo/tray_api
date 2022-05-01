<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\SaleMail;


class DailyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dailyreport:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Sales daily report';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        info("Cron Job running at ". now());
  
        /*------------------------------------------
        --------------------------------------------
            Get the sales of day and generate a report
        --------------------------------------------
        --------------------------------------------*/
        //New instance of sale
        $sale = new Sale();
        //Get sales by date
        $sales = $sale->getSalesByDate(Carbon::today());
        // Sum value of the day
        $totalValue = 0;
        foreach ($sales as $sale)
        {
            $totalValue += $sale->value;
        }

        // Send to SaleMail
        Mail::to('teste@tray.com')->send(new SaleMail($sales, $totalValue));
  
        return 0;
    }
}
