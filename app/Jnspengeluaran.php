<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class Jnspengeluaran extends Model {

    

    

    protected $table    = 'jnspengeluaran';
    
    protected $fillable = [
          'jenis_pengeluaran',
          'kategori_pengeluaran',
          'keterangan'
    ];
    

   protected $appends = array('kategori');

    public function getKategoriAttribute()
    {
     return "$this->kategori_pengeluaran - $this->jenis_pengeluaran ";  
    }

    public static function boot()
    {
        parent::boot();

        Jnspengeluaran::observe(new UserActionsObserver);
    }
    
    
    
    
}