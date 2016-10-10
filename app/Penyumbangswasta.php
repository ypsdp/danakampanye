<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Penyumbangswasta extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'penyumbangswasta';
    
    protected $fillable = [
          'nama',
          'alamat',
          'no_akte',
          'npwp',
          'nama_pimpinan',
          'alamat_pimpinan',
          'telepon_pimpinan',
          'nama_pemilik',
          'alamat_pemilik',
          'status',
          'keterangan'
    ];
    

    public static function boot()
    {
        parent::boot();

        Penyumbangswasta::observe(new UserActionsObserver);
    }
    
    
    
    
}