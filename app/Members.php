<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Members extends Model
{
    protected $fillable =['name','comments','filename']; // MassAssignment 대응 


    // public function attachments(){
    //     return $this->hasMany(Attachment::class);
    // }
    // public function members(){
    //     return Members::class;
    // }
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    // /**
    //  * The attributes that should be cast to native types.
    //  *
    //  * @var array
    //  */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

}
