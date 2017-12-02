<?php

namespace App\Models;

use App\Modles\Activity;
use App\User;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    //
    protected $guarded=[];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::addGlobalScope('replyCount',function ($builder){

            $builder->withCount('reply');
        });
        static::deleting(function ($thread){
            $thread->reply()->delete();
        });

        static::created(function ($threads){

            Activity::create([
                "user_id" =>auth()->user()->id,
                "type" =>"created".strtolower(new\ReflectionClass($threads)) ,
                "subject_id" =>$threads->id,
                "subject_type" =>get_class($threads)
            ]);
        });

    }


    public function path(){

        return "/threads/{$this->channel->name}/".$this->id;
     }


     public function scopeFilter($query,$filter){
         return $filter->apply($query);
     }
    public function addReply($reply){

        $this->reply()->create($reply);
    }













    //RelationShip

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function reply (){

        return $this->hasMany(Reply::class);
    }

    public function channel(){

        return $this->belongsTo(Channel::class);

    }

}
