<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logos extends Model
{
    
    protected $table = 'signali_logs';
    protected $guarded = ['ip'];
}
