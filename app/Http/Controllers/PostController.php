<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use app\Models\Comment;
use Illuminate\Support\Facades\Gate;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\View\ViewServiceProvider;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function manage()
    {
        $posts = Post::where('author_id', Auth::user()->id)->get();
        return view('blog\managment', compact('posts'));
    }
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories= Category::all();
        return view('blog.createpost', ['categories' => $categories, 'title' => 'Upload Article ']);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : RedirectResponse
    {
        $request->validate([
            'title' => 'required','string','max:50',
            'category'=> 'required','exists:categories,category_id',
            'body' => 'required','string','max:250',
        ]);
        Post::create([
        'title'=>$request->title,
        'author_id'=>Auth::user()->id,
        'category_id'=>$request->category,
        'body'=>$request->body,
        'views'=>0,
        ]);
        return redirect()->route('posts')->with('success', 'Post created successfully.');
    }
    /**
     * Display the specified resource.
     */
    public function show(Request $request, Post $post)
    {
            if ($this->authorize('read posts', $post)) {

                return view('blog\post',['title' => "Single Post"],compact('post'));
            }
            else{
                return view('login');
            }

        }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required','string','max:50',
            'category'=> 'required','exists:categories,category_id',
            'body' => 'required','string','max:250',
        ]);
        $post->update([
        'title'=>$request->title,
        'category_id'=>$request->category,
        'body'=>$request->body,
        ]);
        return to_route('manage-post')->with('success', 'Post updated successfully.');
    }

    public function editform(Request $request, Post $post)
    {

        $categories= Category::all();
        return view('blog.editpost', ['categories' => $categories],['post' => $post]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
    $post->delete();
    return to_route('manage-post')->with('success', 'Post deleted successfully.');
    }
}
