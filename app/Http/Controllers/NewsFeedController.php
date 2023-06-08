<?php

namespace App\Http\Controllers;

use App\Models\Dislike;
use App\Models\Like;
use App\Models\News;

class NewsFeedController extends Controller
{
    public function index()
    {
        $news = News::withCount('likes', 'dislikes')
            ->orderByDesc('likes_count')
            ->orderByDesc('dislikes_count')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('news.index', compact('news'));
    }

    public function like( $id)
    {
        $news = News::findOrFail($id);
        $like = new Like();
        $like->news()->associate($news);
        $like->save();

        return redirect()->back();
    }

    public function dislike($id)
    {
        $news = News::findOrFail($id);
        $dislike = new Dislike();
        $dislike->news()->associate($news);
        $dislike->save();

        return redirect()->back();
    }
}
