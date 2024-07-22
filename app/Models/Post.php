<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use Usamamuneerchaudhary\Commentify\Traits\Commentable;
class Post extends Model
{
    use HasFactory, Commentable;
    protected $table = 'posts';
    protected $fillable = ['title', 'author_id', 'body','slug','category_id','views'];
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $slug = Str::slug($post->title);
            $original_slug = $slug;
            $count = 1;
            while (static::where('slug', $slug)->exists()) {
                $slug = $original_slug . '-' . $count;
                $count++;
            }
            $post->slug = $slug;
        });
    }

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
