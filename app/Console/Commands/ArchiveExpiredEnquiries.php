<?php

namespace Mybankerbiz\Console\Commands;

use Mybankerbiz\Enquiry;
use Illuminate\Console\Command;

class ArchiveExpiredEnquiries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mybankerbiz:archive:enquiries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find all active enquiries with expired deadlines and mark as archived by system';

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
        $enquiries = Enquiry::whereIsActive(true)->where('bidding_deadline', '<', \Carbon\Carbon::now()->toDateTimeString())->get();

        $this->info(\Carbon\Carbon::now()->toDateTimeString());

        $bar = $this->output->createProgressBar(count($enquiries));

        foreach ($enquiries as $enquiry) {
            // $this->info("Enquiry ID: " . $enquiry->id . " | BidDeadline: " . $enquiry->bidding_deadline);
            $enquiry->archive(class_basename(get_class($this)))->save();

            $bar->advance();
        }

        $bar->finish();
        // $this->info("Finished archiving expired enquiries.");
    }
}
