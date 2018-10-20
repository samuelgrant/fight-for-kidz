<?php

use App\Applicant;
use Illuminate\Database\Seeder;

class ContendersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 13; $i++){
            $app = Applicant::find($i);
            
            if($i < 6){
                $app->addToTeam('red');
            } else {
                $app->addToTeam('blue');
            }
        }
    }
}
