<?php

namespace App\Http\Controllers;
use App\Http\requsest;
use App\Models\Post;
use app\Models\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function destroy(User $user, Post $post)
    {
        $user->posts()->detach($post->author_id);
        $user->delete();
        return back()->with('success', 'User deleted successfully.');
    }
    public function index()
    {
        $users = User::with('posts')->get();
        return view('user\user_managment', compact('users'));
    }
}
