<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'description', 'quantity', 'price'];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'category_id');
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }
}
