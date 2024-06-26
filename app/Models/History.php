<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'action', 'item_id', 'description', 'before_change', 'after_change', 'action_category', 'user'];
    protected $table = 'historys';
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class, 'item_id')->withDefault();
    }
}
