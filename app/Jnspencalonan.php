<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class Jnspencalonan extends Model {

    

    

    protected $table    = 'jnspencalonan';
    
    protected $fillable = [
          'jenis_pencalonan',
          'keterangan'
    ];
    

    public static function boot()
    {
        parent::boot();

        Jnspencalonan::observe(new UserActionsObserver);
    }
    
    
    
    
}
