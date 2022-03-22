<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    public function coverPhoto()
    {
        return $this->hasOne(BookImage::class)->where('is_cover', TRUE);
    }

    public function uploader()
    {
        return $this->hasOne(User::class, 'id', 'added_by');
    }

    public function authors()
    {
        return $this->hasMany(BookAuthor::class);
    }
}
