<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class ListModels extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'models:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all Eloquent models';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $modelsPath = app_path('Models');
        if (!File::exists($modelsPath)) {
            $this->error('No models directory found.');
            return;
        }

        $models = File::files(directory: $modelsPath);

        foreach ($models as $model) {
            $this->info($model->getFilenameWithoutExtension());
        }
    }
}
