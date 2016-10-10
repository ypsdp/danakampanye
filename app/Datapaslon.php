<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

use Carbon\Carbon; 

use Illuminate\Database\Eloquent\SoftDeletes;

class Datapaslon extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'datapaslon';
    
    protected $fillable = [
          'jnspemilihan_id',
          'jnspencalonan_id',
          'partai_pengusung',
          'provinsi',
          'kabupaten_kota',
          'kedudukan',
          'ketua_tim',
          'nik_ketua_tim',
          'alamat_ketua_tim',
          'bendahara_tim',
          'nik_bendahara_tim',
          'alamat_bendahara_tim',
          'tanggal_penetapan',
          'bank_reksus',
          'nama_pemilik_reksus',
          'no_reksus',
          'tanggal_reksus',
          'tanggal_ladk',
          'tanggal_lpsdk',
          'tanggal_ladk',
          'tanggal_kampanye_mulai',
          'tanggal_kampanye_selesai'
    ];
    

    public static function boot()
    {
        parent::boot();

        Datapaslon::observe(new UserActionsObserver);
    }
    
    public function jnspemilihan()
    {
        return $this->hasOne('App\Jnspemilihan', 'id', 'jnspemilihan_id');
    }
 
    public function jnspencalonan()
    {
        return $this->hasOne('App\Jnspencalonan', 'id', 'jnspencalonan_id');
    }


    
    /**
     * Set attribute to date format
     * @param $input
     */
    public function setTanggalPenetapanAttribute($input)
    {
        if($input != '') {
            $this->attributes['tanggal_penetapan'] = Carbon::createFromFormat(config('quickadmin.date_format'), $input)->format('Y-m-d');
        }else{
            $this->attributes['tanggal_penetapan'] = '';
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getTanggalPenetapanAttribute($input)
    {
        if($input != '0000-00-00') {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('quickadmin.date_format'));
        }else{
            return '';
        }
    }


    
}
