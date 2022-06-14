<?php

namespace App\Console\Commands;

use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ScheduleActive extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:active';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update schedule status to active';

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
        \Log::info("Checking schedules..");

        $date_now = Carbon::now('Asia/Hong_Kong')->format('Y-m-d');

        Schedule::where([['date',  $date_now], ['status', 'pending']])
                            ->update(['status' => 'active']);

        // dd($schedule);


        // foreach ($schedule as $s) {
        //     if ($s->date == $date_now && $s->status == 'pending') {
        //         $s->update([
        //             'status' => 'active',
        //         ]);
        //     }
        // }

        $this->info('Schedule status successfully changed.');
    }
}
