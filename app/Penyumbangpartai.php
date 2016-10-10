<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Penyumbangpartai extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'penyumbangpartai';
    
    protected $fillable = [
          'nama',
          'alamat',
          'no_akte',
          'npwp',
          'nama_pimpinan',
          'alamat_pimpinan',
          'telepon_pimpinan',
          'nama_sekjen',
          'alamat_sekjen',
          'telepon_sekjen'
    ];
    

    public static function boot()
    {
        parent::boot();

        Penyumbangpartai::observe(new UserActionsObserver);
    }
    
    
    
    
}