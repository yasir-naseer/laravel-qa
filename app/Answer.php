<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = ['body', 'user_id'];
    
    public function question() {
        return $this->belongsTo(Question::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public static function boot() {
        parent::boot();

        static::created(function($answer) {
            $answer->question->increment('answers_count');

        });

        static::deleted(function($answer) {
            $question = $answer->question;
            $answer->question->decrement('answers_count');

            if($answer->id === $question->best_answer_id) {
                $question->best_answer_id = NULL;
                $question->save();
            }
        });
    }

    public function getCreatedDateAttribute() {
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute() {
        if($this->id === $this->question->best_answer_id) {
            return "vote-accepted";
        }
    }

    public function getAcceptedAttribute() {
        return $this->isAccepted();
    }

    public function isAccepted() {
       return  $this->id === $this->question->best_answer_id;
    }

    public function votes() {
        return $this->morphToMany(User::class, 'votable');
    }

    
}
