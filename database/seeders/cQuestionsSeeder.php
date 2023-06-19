<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class cQuestionsSeeder extends Seeder
{

    public function run()
    {


        foreach (config('question') as  $value) {
            DB::table('questions')->insert([
                'title' => $value,
            ]);
        }

    }
}
