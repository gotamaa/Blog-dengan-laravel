<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Post;

class CountViews
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->route('posts.single')) {
            $post=Post::find($request->route('posts.single')->id);
            Post::where('id', $post->id)
            ->increment('views');
        }
        return $next($request);
    }
}
