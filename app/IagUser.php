<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IagUser extends Model
{
    protected $table = "nug.users";
    protected $primaryKey = "ID";
    public $timestamps = false;
    
    public function iagsession(){
        $this->hasMany( IagUser::class,'userId', 'ID' );
    }
}
