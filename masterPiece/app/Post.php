<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;

class Post extends Model implements HasMedia
{
    // use SoftDeletes;
    use HasMediaTrait;
    protected $fillable = ['user_id', 'title', 'post_text', 'image', 'type', 'city'];

    // public function user(){
    //     return $this->belongsTo('App\User');
    // }

    public function reservations()
    {
        return $this->hasMany('App\Reservation');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comment()
    {
        return $this->hasMany('App\Comment');
    }


    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(200)
            ->height(200);

        $this->addMediaConversion('main')
            ->width(600)
            ->height(200);
    }
    public function getCategoriesLinksAttribute()
    {
        $categories = $this->categories()->get()->map(function ($category) {
            return '<a href="' . route('posts.index') . '?category_id=' . $category->id . '">' . $category->name . '</a>';
        })->implode(' | ');

        if ($categories == '') return 'none';

        return $categories;
    }
    public function getTagsLinksAttribute()
    {
        $tags = $this->tags()->get()->map(function ($tag) {
            return '<a href="' . route('posts.index') . '?tag_id=' . $tag->id . '">' . $tag->name . '</a>';
        })->implode(' | ');

        if ($tags == '') return 'none';

        return $tags;
    }
}
