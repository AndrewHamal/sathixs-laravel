<?php

namespace App\Console\Commands\Rider;

use App\Events\RiderPackage;
use App\Models\Vendor\Package;
use Illuminate\Console\Command;

class SendPackageAlert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'package:alert';

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
        $package = Package::get()->where('process_step', null)->first();
        broadcast(new RiderPackage([$package]));
    }
}
