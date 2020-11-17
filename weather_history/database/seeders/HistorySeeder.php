<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HistorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $start = strtotime('-6 months');
        $end = time();
        while($start < $end)
        {
            DB::table('history')->insert([
                'temp' => mt_rand(100, 300) / 10,
                'date_at' => date('Y-m-d', $start)
            ]);
            $start = strtotime("+1 day", $start);
        }
        
        // for ($i = 1; $i < 30; $i++) {
        //     DB::table('history')->insert([
        //         'temp' => mt_rand(100, 300) / 10,
        //         'date_at' => now()
        //     ]);
        // }
    }
}
