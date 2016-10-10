<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Penyumbangkelompok extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'penyumbangkelompok';
    
    protected $fillable = [
          'nama',
          'alamat',
          'identitas_pimpinan',
          'telepon',
          'npwp',
          'nama_pemimpin',
          'alamat_pemimpin',
          'status',
          'keterangan'
    ];
    

    public static function boot()
    {
        parent::boot();

        Penyumbangkelompok::observe(new UserActionsObserver);
    }
    
    
    
    
}