<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Log; // Tambahkan ini untuk debugging

class CountViews
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $post = $request->route('post');

        if ($post instanceof Post) {
            $postId = $post->id;
            $sessionKey = "viewed_posts_{$postId}";

            if (!$request->session()->has($sessionKey)) {
                // Tambahkan 1 view pada post hanya jika belum dilihat oleh pengguna di sesi ini
                $post->increment('views');
                // Tandai post ini sebagai sudah dilihat di sesi ini
                $request->session()->put($sessionKey, true);
            }
        }

        return $next($request);
    }
}
