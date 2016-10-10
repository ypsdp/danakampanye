<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

use Carbon\Carbon; 

use Illuminate\Database\Eloquent\SoftDeletes;

class Penyumbangindividu extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'penyumbangindividu';
    
    protected $fillable = [
          'nik',
          'nama',
          'tempat_lahir',
          'tgl_lahir',
          'alamat',
          'telepon',
          'npwp',
          'pekerjaan',
          'alamat_pekerjaan',
          'keterangan'
    ];
    

    public static function boot()
    {
        parent::boot();

        Penyumbangindividu::observe(new UserActionsObserver);
    }
    
    
    /**
     * Set attribute to date format
     * @param $input
     */
    public function setTglLahirAttribute($input)
    {
        if($input != '') {
            $this->attributes['tgl_lahir'] = Carbon::createFromFormat(config('quickadmin.date_format'), $input)->format('Y-m-d');
        }else{
            $this->attributes['tgl_lahir'] = '';
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getTglLahirAttribute($input)
    {
        if($input != '0000-00-00') {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('quickadmin.date_format'));
        }else{
            return '';
        }
    }


    
}