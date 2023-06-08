@extends('layouts.app')
@section('content')
    <div class="news-feed">
        @foreach($news as $article)
            @dd( asset($article->image))
            <div class="news-article">
                <h2>{{ $article->title }}</h2>
                <div class="article-image">
                    <img src="{{ asset($article->image) }}" alt="News Image">
                </div>
                <div class="article-content">
                    <div class="article-metadata">
                        <span class="likes-count">{{ $article->likes_count }}</span>
                        <span class="dislikes-count">{{ $article->dislikes_count }}</span>
                    </div>
                </div>
                <div class="article-actions">
                    <form action="{{ route('news.like', ['id' => $article->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="like-button">
                            <i class="fas fa-thumbs-up"></i> Like
                        </button>
                    </form>
                    <form action="{{ route('news.dislike', ['id' => $article->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="dislike-button">
                            <i class="fas fa-thumbs-down"></i> Dislike
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    {{ $news->links() }}
@endsection

@section('styles')
    <style>
        .news-feed {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .news-article {
            width: 300px;
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .news-article h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .article-image {
            margin-bottom: 20px;
        }

        .article-image img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }

        .article-content {
            margin-bottom: 20px;
        }

        .article-preview {
            font-size: 16px;
            line-height: 1.4;
            color: #555;
        }

        .article-metadata {
            font-size: 14px;
            color: #888;
        }

        .article-metadata span {
            margin-right: 10px;
        }

        .article-actions {
            display: flex;
            justify-content: space-between;
        }

        .like-button,
        .dislike-button {
            display: inline-flex;
            align-items: center;
            padding: 8px 12px;
            font-size: 14px;
            font-weight: bold;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .like-button {
            background-color: #4caf50;
        }

        .dislike-button {
            background-color: #f44336;
        }

        .like-button i,
        .dislike-button i {
            margin-right: 6px;
        }
    </style>
@endsection
