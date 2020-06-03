<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class UpdatePageVisits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:pages';

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
     * @return mixed
     */
    public function handle()
    {
        $redis = Redis::connection();

        $visit_keys = $redis->keys('*visit*');

        foreach ($visit_keys as $visit_key) {
            $visit_event = json_decode($redis->get($visit_key));

            $values = [
                'created_at' => $visit_event->timestamp,
                'location' => $visit_event->location,
                'bp_uid' => $visit_event->bp_uid
            ];

            DB::table('page_visits')->insert($values);

            $redis->del($visit_key);
        }
    }
}
