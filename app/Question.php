<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['title', 'body'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function setTitleAttribute($value) {

        $this->attributes['title'] = $value;
        $this->attributes['slug'] =  strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $value)));;
        
    }
}
