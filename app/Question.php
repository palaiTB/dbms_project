<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Question extends Model
{
    use HasApiTokens,Notifiable;
    //
    protected $fillable = [
        'subject', 'exam', 'year','description','file','size'
    ];

    public function followers()
    {
        return $this->belongsToMany(User::class);
    }
}
