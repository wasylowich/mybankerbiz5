<?php

namespace Mybankerbiz\Console\Commands;

use Mybankerbiz\Offer;
use Illuminate\Console\Command;

class ArchiveExpiredOffers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mybankerbiz:archive:offers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find all active offers with expired deadlines and mark as archived by system';

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
     * @return mixed
     */
    public function handle()
    {
        $offers = Offer::whereState('active')->where('deadline', '<', \Carbon\Carbon::now()->toDateTimeString())->get();

        $this->info(\Carbon\Carbon::now()->toDateTimeString());

        $bar = $this->output->createProgressBar(count($offers));

        foreach ($offers as $offer) {
            $this->info("Offer ID: " . $offer->id . " | Deadline: " . $offer->deadline);
            $offer->archive(class_basename(get_class($this)))->save();

            $bar->advance();
        }

        $bar->finish();
        $this->info("Finished archiving expired offers.");
    }
}
