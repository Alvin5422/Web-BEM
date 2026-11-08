<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount(['posts' => fn ($q) => $q->published()])->get();

        $query = Post::published()->with(['category', 'user'])->orderBy('published_at', 'desc');

        if ($request->filled('category')) {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $posts = $query->paginate(9)->withQueryString();

        $recentPosts = Post::published()->orderBy('published_at', 'desc')->take(5)->get();

        $currentCategory = $request->filled('category')
            ? Category::where('slug', $request->category)->first()
            : null;

        return view('public.posts.index', compact('posts', 'categories', 'recentPosts', 'currentCategory'));
    }

    public function show(string $slug)
    {
        $post = Post::published()->where('slug', $slug)->with(['category', 'user'])->firstOrFail();

        $post->increment('views_count');

        $relatedPosts = Post::published()
            ->where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $categories = Category::withCount(['posts' => fn ($q) => $q->published()])->get();

        return view('public.posts.show', compact('post', 'relatedPosts', 'categories'));
    }
}
