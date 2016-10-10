<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class Jnslaporan extends Model {

    

    

    protected $table    = 'jnslaporan';
    
    protected $fillable = [
          'jenis_laporan',
          'keterangan'
    ];
    

    public static function boot()
    {
        parent::boot();

        Jnslaporan::observe(new UserActionsObserver);
    }
    
    
    
    
}