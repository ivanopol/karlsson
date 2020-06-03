<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class UpdateButtonEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:buttons';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Flush button click events from Redis and write to DB';

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

        $button_keys = $redis->keys('*btn*');

        foreach ($button_keys as $button_key) {
            $button_event = json_decode($redis->get($button_key));

            $values = [
                'timestamp' => $button_event->timestamp,
                'button_id' => $button_event->btn_id,
                'user_ip' => $button_event->user_ip,
                'href' => $button_event->href,
                'location' => $button_event->location,
                'bp_uid' => $button_event->bp_uid
            ];

            DB::table('button_events')->insert($values);

            $redis->del($button_key);
        }
    }
}
