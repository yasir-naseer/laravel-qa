<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Answer;

class Question extends Model
{
    protected $fillable = ['title', 'body'];

    protected $appends = ['created_date', 'is_favorited', 'favorited_count'];


    public function user() {
        return $this->belongsTo(User::class);
    }

    public function setTitleAttribute($value) {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] =  strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $value)));;
    }

    public function getUrlAttribute() {
        return route('questions.show', $this->slug);
    }

    public function getCreatedDateAttribute() {
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute() {
        if($this->answers_count > 0) {
            if($this->best_answer_id) {
                return "answer-accepted";
            }
            return "answered";
        }
        return "un-answered";
    }

    public function answers() {
        return $this->hasMany(Answer::class)->orderBy('votes_count', "DESC");
    }

    public function acceptBestAnswer(Answer $answer) {
        $this->best_answer_id = $answer->id;
        $this->save();
    }

    public function favorites() {
       return  $this->belongsToMany(User::class, 'favorites')->withTimeStamps();
    }

    public function isFavorited() {
        return $this->favorites()->where('user_id', auth()->id())->count() > 0;
    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }

    public function getFavoritedCountAttribute()
    {
        return $this->favorites->count();
    }

    public function votes() {
        return $this->morphToMany(User::class, 'votable');
    }

    
}

