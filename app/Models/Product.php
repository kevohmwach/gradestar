<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory;
    use Sluggable;

    protected $guarded = [];
    protected $table = 'product';

    public function Sluggable():array {
        return [
            'slug' => [
                'source' => 'prod_title'
            ]
            ];
    }

    // public function getRouteKeyName(){
    //     return 'slug';
    // }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
