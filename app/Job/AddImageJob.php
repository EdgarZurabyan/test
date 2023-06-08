<?php

namespace App\Job;


use App\Models\News;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private array $newsData;

    public function __construct(array $newsData)
    {
        $this->newsData = $newsData;
    }

    public function handle()
    {
        if (!empty($this->newsData)) {
            News::insert($this->newsData);
            $newsCount = count($this->newsData);
            info($newsCount . ' news articles have been added to the site.');
        } else {
            info('No new news articles found.');
        }
    }
}