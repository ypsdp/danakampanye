<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class Saldo extends Model {

    

    

    protected $table    = 'saldo';
    
    protected $fillable = [
          'jenis_laporan',
          'kas_reksus',
          'kas_bendahara',
          'kendaraan',
          'peralatan',
          'lainnya',
          'unit_kendaraan',
          'unit_peralatan',
          'unit_lainnya',
          'tagihan',
          'utang'
    ];
    

    public static function boot()
    {
        parent::boot();

        Saldo::observe(new UserActionsObserver);
    }
    
    
    
    
}
