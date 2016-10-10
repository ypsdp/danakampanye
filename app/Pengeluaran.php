<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

use Carbon\Carbon; 

use Illuminate\Database\Eloquent\SoftDeletes;

class Pengeluaran extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'pengeluaran';
    
    protected $fillable = [
          'tanggal',
          'jnspengeluaran_id',
          'nilai',
          'unit',
          'satuan',
          'uraian'
    ];
    

    public static function boot()
    {
        parent::boot();

        Pengeluaran::observe(new UserActionsObserver);
    }
    
    public function jnspengeluaran()
    {
        return $this->hasOne('App\Jnspengeluaran', 'id', 'jnspengeluaran_id');
    }


    
    /**
     * Set attribute to date format
     * @param $input
     */
    public function setTanggalAttribute($input)
    {
        if($input != '') {
            $this->attributes['tanggal'] = Carbon::createFromFormat(config('quickadmin.date_format'), $input)->format('Y-m-d');
        }else{
            $this->attributes['tanggal'] = '';
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getTanggalAttribute($input)
    {
        if($input != '0000-00-00') {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('quickadmin.date_format'));
        }else{
            return '';
        }
    }


    
}