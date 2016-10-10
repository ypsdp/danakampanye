<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class Gambar extends Model {

    

    

    protected $table    = 'gambar';
    
    protected $fillable = [
          'jenis_gambar',
          'keterangan',
          'gambar'
    ];
    

    public static function boot()
    {
        parent::boot();

        Gambar::observe(new UserActionsObserver);
    }
    
    
    
    
}