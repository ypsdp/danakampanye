<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class Jnsdana extends Model {

    

    

    protected $table    = 'jnsdana';
    
    protected $fillable = [
          'jenis_dana',
          'keterangan'
    ];
    

    public static function boot()
    {
        parent::boot();

        Jnsdana::observe(new UserActionsObserver);
    }
    
    
    
    
}