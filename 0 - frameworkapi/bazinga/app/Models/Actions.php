<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actions extends Model
{
    protected $filable=[
        'title',
        'description',
        'category_id',
        'points'
    ];
    public function categories(){
        return $this->belongsTo(Categories::class, 'category_id','id');
    }
}
