<?php

namespace App\Models;

use App\Models\Category_blogs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function category()
    { 
        return $this->belongsTo(Category_blogs::class);
    }

    public function galleries()
    {
        return $this->hasMany(Blog_Gallery::class);
    }

    public function features()
    {
        return $this->hasMany(Blog_Feature::class);
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
