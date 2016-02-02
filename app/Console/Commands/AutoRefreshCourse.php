<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Cyinf\Services\CourseService;

class AutoRefreshCourse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'course:refresh {D0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto refresh course by using D0 semester';

    protected $courseService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CourseService $courseService)
    {
        parent::__construct();
        $this->courseService = $courseService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   
        $this->courseService->autoAddCourse($this->argument('D0'), $this->output);
        $this->line();
    }
}
