<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\MakePostController;
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

}
