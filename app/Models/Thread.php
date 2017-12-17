<?php

namespace App\Models;

 use App\RecordActivites;
 use App\User;
use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{

     protected $guarded=[];
     protected $with=['reply','user'];
      use RecordActivites;

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
        static::addGlobalScope('replyCount',function ($builder){

            $builder->withCount('reply');
        });
        static::deleting(function ($thread){
            $thread->reply()->delete();
        });

     }
 
    public function path(){

        return "/threads/{$this->channel->name}/".$this->id;

    }
     public function scopeFilter($query,$filter){
         return $filter->apply($query);
     }
    public function addReply($reply){

       return $this->reply()->create($reply);
    }
    //RelationShip
    public function user(){

        return $this->belongsTo(User::class);
    }
    /*
    *  public function getReplyCountAttribute(){

        return $this->ReplyCount();
    }
    * */
    public function reply (){

        return $this->hasMany(Reply::class);
    }

    public function channel(){

        return $this->belongsTo(Channel::class);

    }



}
