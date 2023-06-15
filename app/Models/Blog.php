<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];
    public function blogcategory()
    { 
        return $this->belongsTo(Blogcategory::class);
    }

    public function galleries()
    {
        return $this->hasMany(Bloggallery::class);
    }

    public function features()
    {
        return $this->hasMany(Blogfeature::class);
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
