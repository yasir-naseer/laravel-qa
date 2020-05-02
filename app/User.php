<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $appends = ['url', 'avatar'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function questions() {
        return $this->hasMany(Question::class);
    }

    public function getUrlAttribute() {
       // return route('questions.show', $this->id);
    }

    
    public function answers() {
        return $this->hasMany(Answer::class);
    }

    public function getAvatarAttribute() {
        $email = $this->email;
        $size = 40;

        return  "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?s=" . $size;

    }

    public function favorites() {
        return $this->belongsToMany(Question::class, 'favorites')->withTimeStamps();
    }

    public function voteQuestions()
    {
        return $this->morphedByMany(Question::class,'votable');
    }

    public function voteAnswers()
    {
        return $this->morphedByMany(Answer::class,'votable');
    }

    public function voteQuestion(Question $question, $vote) {
        $voteQuestion = $this->voteQuestions();

        if($voteQuestion->where('votable_id', $question->id)->exists()) {
            $voteQuestion->updateExistingPivot($question, ['vote' => $vote]);
        }
        else {
            $voteQuestion->attach($question, ['vote' => $vote]);
        }

        $question->load('votes');
        $voteUp = (int) $question->votes()->wherePivot('vote', 1)->sum('vote');
        $voteDown = (int) $question->votes()->wherePivot('vote', -1)->sum('vote');
        $question->votes_count = $voteDown + $voteUp;
        $question->save();

    }

    public function voteAnswer(Answer $answer, $vote) {
        $voteAnswer = $this->voteAnswers();

        if($voteAnswer->where('votable_id', $answer->id)->exists()) {
            $voteAnswer->updateExistingPivot($answer, ['vote' => $vote]);
        }
        else {
            $voteAnswer->attach($answer, ['vote' => $vote]);
        }

        $answer->load('votes');
        $voteUp = (int) $answer->votes()->wherePivot('vote', 1)->sum('vote');
        $voteDown = (int) $answer->votes()->wherePivot('vote', -1)->sum('vote');
        $answer->votes_count = $voteDown + $voteUp;
        $answer->save();

    }
}
