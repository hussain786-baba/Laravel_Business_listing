<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Add extends Model
{
    use HasFactory;
    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function category()
    { 
        return $this->belongsTo(Addcategory::class);
    }

    public function galleries()
    {
        return $this->hasMany(Addgallery::class);
    }

    public function features()
    {
        return $this->hasMany(Addfeature::class);
    }

    public function agent()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
