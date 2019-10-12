<?php

namespace App\Console\Commands;

use App\Models\App;
use Illuminate\Console\Command;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CalculateAppsAverageStar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apps:calculateAverageStar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Calculate apps average star update to every app star field';

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
        $average_stars = Comment::whereStatus(1)->groupBy('app_id')->get(['app_id', DB::raw('ROUND(AVG(star), 0) * 100 as star')]);
        if ($average_stars->count() > 0) {
            foreach($average_stars as $star)
            {
                $app = App::find($star->app_id);
                if ($app->star !== $star->star) {
                    $app->star = $star->star;
                    $app->save();
                }
            }
        }

        $info = 'update average star success';
        Log::info($info);
        $this->info($info);
    }
}
