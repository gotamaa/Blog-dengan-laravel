<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\MakePostController;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = ['title', 'author_id', 'body','slug'];
    protected $with =['author','category'];
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function category() :BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter(Builder $query, array $filters) : void
    {
        $query->when($filters['search'] ?? false,
        fn($query, $search)=>
        $query->where('title','LIKE','%'. $search .'%')
        );

        $query->when($filters['category'] ?? false,
        fn($query, $category)=>
        $query->wherehas('category', fn($query)=> $query->where('slug',$category))
        );

        $query->when($filters['author'] ?? false,
        fn($query, $author)=>
        $query->wherehas('author', fn($query)=> $query->where('username',$author))
        );
    }
}
