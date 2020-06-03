<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class UpdateVisitsCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:visits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Flush visits count from Redis and write to DB';

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
        $today = date('Y-m-d');
        $redis = Redis::connection();

        $today_visits =
            DB::table('daily_visits')->where('date', '=', $today)->first('visitors');

        if ($today_visits === null) {
            $current_visits = $redis->get($today);

            if ($current_visits == null) {
                $current_visits = 0;
            }

            $values = [
                'date' => $today,
                'visitors' => $current_visits
            ];

            DB::table('daily_visits')->insert($values);

            $redis->set($today, 0);
        } else {
            $current_visits = $redis->get($today);

            if ($current_visits == null) {
                $current_visits = 0;
            }

            $visitors_sum = $current_visits + $today_visits->visitors;

            $values = [
                'visitors' => $visitors_sum
            ];

            DB::table('daily_visits')->where('date', '=', $today)->update($values);

            $redis->set($today, 0);
        }
    }
}
