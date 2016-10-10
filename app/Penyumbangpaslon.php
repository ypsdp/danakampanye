<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

use Carbon\Carbon; 



class Penyumbangpaslon extends Model {

    

    

    protected $table    = 'penyumbangpaslon';
    
    protected $fillable = [
          'nik',
          'nama',
          'tempat_lahir',
          'tanggal_lahir',
          'alamat',
          'telepon',
          'npwp',
          'pekerjaan',
          'alamat_pekerjaan',
          'foto',
          'keterangan'
    ];
    

    public static function boot()
    {
        parent::boot();

        Penyumbangpaslon::observe(new UserActionsObserver);
    }
    
    
    /**
     * Set attribute to date format
     * @param $input
     */
    public function setTanggalLahirAttribute($input)
    {
        if($input != '') {
            $this->attributes['tanggal_lahir'] = Carbon::createFromFormat(config('quickadmin.date_format'), $input)->format('Y-m-d');
        }else{
            $this->attributes['tanggal_lahir'] = '';
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getTanggalLahirAttribute($input)
    {
        if($input != '0000-00-00') {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('quickadmin.date_format'));
        }else{
            return '';
        }
    }


    
}