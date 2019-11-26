<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $fillable =['title','content']; // MassAssignment 대응 

    public function user(){
        //일대다 관계에서 one쪽은 단수
        return $this->belongsTo(User::class);
        //나 아티클은 User에 속한 것이다.
    }
}
