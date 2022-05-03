<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shelve extends Model
{
    use HasFactory;

    protected $fillable = [
        'shelve'
    ];
    
    public $timestamps = false;

    public function onShelves()
    {
        return $this->hasMany(BookOnShelf::class);
    }
}
