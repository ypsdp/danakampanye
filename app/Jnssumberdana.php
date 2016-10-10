<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class Jnssumberdana extends Model {

    

    

    protected $table    = 'jnssumberdana';
    
    protected $fillable = [
          'sumber_dana',
          'kategori',
          'keterangan'
    ];
    

    public static function boot()
    {
        parent::boot();

        Jnssumberdana::observe(new UserActionsObserver);
    }
    
    
    
    
}