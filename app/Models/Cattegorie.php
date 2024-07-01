<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cattegorie extends Model
{
    use HasFactory;
    protected $table ='cattegories';
    protected $fillable=['name'];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'cattegorie_id' );
    }
}
