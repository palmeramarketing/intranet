<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Evaluation;
use App\Http\Controllers\EvaluationController;

class EvaluationPlanner extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'evaluation:planner';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start the assessments.';

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
        //
        $evaluation = new EvaluationController();
        $evaluation->create();
    }
}
