<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Signal extends Model
{
    protected $table = 'iag112new.signali';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function podelenie()
    {
        return $this->hasOne(Podelenia::class,'Pod_Id','pod_id');
    }
    
    public function rdg()
    {
        return $this->hasOne(Rdg::class,'Pod_Id','glav_pod');
    }
    
    public function scopePodid($query, $ap)
    {   
        return $query->where('iag112new.signali.pod_id', '=', $ap);
    }

    public static function filter(){
        static::where('id', 'like', "%{$search}%")
                                    ->orWhere('pod_id','like',"%{$search}%")
                                    ->orWhere('glav_pod','like',"%{$search}%")
                                    ->orWhere('name','like',"%{$search}%")
                                    ->orWhere('phone','like',"%{$search}%")
                                    ->orWhere('signaldate','like',"%{$search}%")
                                    ->orWhere('opisanie','like',"%{$search}%");
    }
}
