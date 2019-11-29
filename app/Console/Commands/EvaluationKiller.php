<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Evaluation;
use App\Http\Controllers\EvaluationController;

class EvaluationKiller extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'evaluation:killer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Destroy the evaluations.';

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
        $killer = new EvaluationController();
        $killer->destroy();
    }
}
