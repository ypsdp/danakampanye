<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class Jnspenerimaan extends Model {

    

    

    protected $table    = 'jnspenerimaan';
    
    protected $fillable = [
          'jenis_penerimaan',
          'kategori_penerimaan',
          'keterangan'
    ];
    
    protected $appends = array('kategori');

    public function getKategoriAttribute()
    {
     return "$this->kategori_penerimaan - $this->jenis_penerimaan ";  
    }
    
    public static function boot()
    {
        parent::boot();

        Jnspenerimaan::observe(new UserActionsObserver);
    }
    
    
    
    
}