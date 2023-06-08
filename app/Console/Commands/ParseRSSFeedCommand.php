<?php
namespace App\Console\Commands;

use App\Job\AddImageJob;
use App\Models\News;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class ParseRSSFeedCommand extends Command
{
    protected $signature = 'rss:parse';
    protected $description = 'Parse the RSS feed and store news articles';

    public function handle()
    {
        $rssFeedUrl = 'https://lenta.ru/rss/news';
        $response = Http::get($rssFeedUrl);

        if ($response->ok()) {
            $xml = simplexml_load_string($response->body());

            $newsData = [];

            foreach ($xml->channel->item as $item) {
                $description = (string)$item->description;
                $guid = (string)$item->guid;
                $author = (string)$item->author;
                $title = (string)$item->title;
                $link = (string)$item->link;
                $category = (string)$item->category;
                $pubDate = (string)$item->pubDate;
                $imageUrl = current($item->enclosure->attributes())['url'];

                $image = base64_encode(file_get_contents($imageUrl));

                $newsData[] = [
                        'title' => $title,
                        'link' => $link,
                        'guid' => $guid,
                        'author' => $author,
                        'pubDate' => $pubDate,
                        'image' => $image,
                        'description' => $description,
                        'category' => $category,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];


                AddImageJob::dispatch($newsData);
            }
        } else {
            $this->error('Failed to fetch the RSS feed.');
        }
    }
}