<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;


class TestingCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testing:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $products =Product::get();
        foreach($products as $product){
        $product->current_time = date('Y-m-d H:i:s');
        $product->update();
        }



    }
}
