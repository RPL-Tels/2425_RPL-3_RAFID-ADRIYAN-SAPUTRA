<?php

namespace App\Console\Commands;

use App\Models\projectDetail;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateProjectStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // $project = projectDetail::whereNotIn('category', ['Complete', 'Payment overdue'])
        //     ->whereDate('due_contract', '<', Carbon::now())
        //     ->get();
        // foreach($project as $projects) {
        //     $projects->update(['category' => 'Due contract']);
        // }
        projectDetail::whereNotIn('category', ['Complete', 'Payment overdue'])
            ->whereDate('due_contract', '<', Carbon::now())
            ->update(['category' => 'Due contract']);
        $this->info('Project categories updated successfully.');
    }
}
