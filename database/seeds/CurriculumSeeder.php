<?php

use Illuminate\Database\Seeder;

class CurriculumSeeder extends Seeder
{
    private $numRows = 30;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory( \Cyinf\Notification::class , $this->numRows )->create();
    }
}
