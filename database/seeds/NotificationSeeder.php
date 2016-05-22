<?php

use Illuminate\Database\Seeder;

class NotificationSeeder extends Seeder
{
    private $numRows = 10;
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
