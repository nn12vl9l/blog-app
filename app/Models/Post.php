<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use HasFactory;

    //$fillableを使用することで、フォームからPOSTされたデータをまとめて代入することが可能
    protected $fillable = [
        'title',
        'body',
    ];

    //一つの記事に対するuserは一人しかいないので、単数形user
    //belongsToを使用する1対1の関係
    //データを参照する場合は「$post->user」
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImageUrlAttribute()
    {
        return Storage::url($this->image_path);
    }

    public function getImagePathAttribute()
    {
        return 'images/posts/' . $this->image;
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
