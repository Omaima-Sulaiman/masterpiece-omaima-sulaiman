<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;

class Post extends Model implements HasMedia
{
    use HasMediaTrait;
    protected $fillable = ['user_id', 'title', 'post-text','image'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function reservations(){
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
        $categories = $this->categories()->get()->map(function($category) {
            return '<a href="'.route('articles.index').'?category_id='.$category->id.'">'.$category->name.'</a>';
        })->implode(' | ');

        if ($categories == '') return 'none';

        return $categories;
    }

}
