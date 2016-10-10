<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class Jnspemilihan extends Model {

    

    

    protected $table    = 'jnspemilihan';
    
    protected $fillable = [
          'jenis_pemilihan',
          'jabatan',
          'keterangan'
    ];
    

    public static function boot()
    {
        parent::boot();

        Jnspemilihan::observe(new UserActionsObserver);
    }
    
    
    
    
}