<?php

namespace Database\Seeders;

use App\Models\Tools;
use Illuminate\Database\Seeder;

class ToolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 10; $i++) {
            $tools = new Tools();
            $tools->name = 'Tools ' . $i;
            $tools->location = 'Location Tools ' . $i;
            $tools->status = 0;
            $tools->info = 'Tools Information ' . $i;
            $tools->save();
        }
    }
}
