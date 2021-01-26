<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Backpack\CRUD\app\Models\Traits\SpatieTranslatable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Book
 * @package App\Models
 * @property $author_id
 * @property $name
 * @property $price
 */
class Book extends Model
{
    use CrudTrait;

    protected $table = 'books';
    protected $fillable = ['author_id', 'name', 'price'];

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class,'book_author','book_id','author_id');
    }
}
