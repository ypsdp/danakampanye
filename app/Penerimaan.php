<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;

use Carbon\Carbon; 

use Illuminate\Database\Eloquent\SoftDeletes;


use App\Jnspenerimaan;
use App\Jnssumberdana;
use App\Penyumbangindividu;
use App\Penyumbangkelompok;
use App\Penyumbangpartai;
use App\Penyumbangpaslon;
use App\Penyumbangswasta;

class Penerimaan extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'penerimaan';
    
    protected $fillable = [
          'nomor',
          'tanggal',
          'jnspenerimaan_id',
          'nilai',
          'unit',
          'satuan',
          'jnssumberdana_id',
          'penyumbang_id',
          'no_rek_penyumbang',
          'no_rek_penerima',
          'uraian'
    ];

    protected $appends = array('penyumbang', 'identitas');

    public function getPenyumbangAttribute()
    {
        return $this->lookupPenyumbang();  
    }    

    public function getIdentitasAttribute()
    {
        return $this->lookupIdentitas();  
    }    

    public function lookupPenyumbang()
    {
    	$id = $this->attributes['penyumbang_id'];
    	$nama = '';
    	switch ($this->attributes['jnssumberdana_id']) {
    	case "1":
    	  $penyumbang = Penyumbangpaslon::find($id);	
    	  $nama = $penyumbang->nama;
          break;
    	case "2":
    	  $penyumbang = Penyumbangpartai::find($id);	
    	  $nama = $penyumbang->nama;
          break;
    	case "3":
    	  $penyumbang = Penyumbangindividu::find($id);	
    	  $nama = $penyumbang->nama;
          break;
    	case "4":
    	  $penyumbang = Penyumbangkelompok::find($id);
    	  $nama = $penyumbang->nama;
          break;
    	case "5":
    	  $penyumbang = Penyumbangswasta::find($id);	
    	  $nama = $penyumbang->nama;
    	}
    	
          return $nama;
    }


    public function lookupIdentitas()
    {
    	$id = $this->attributes['penyumbang_id'];
    	$nama = '';
    	switch ($this->attributes['jnssumberdana_id']) {
    	case "1":
    	  $penyumbang = Penyumbangpaslon::find($id);	
    	  $nama = $penyumbang->nik;
          break;
    	case "2":
    	  $penyumbang = Penyumbangpartai::find($id);	
    	  $nama = $penyumbang->no_akte;
          break;
    	case "3":
    	  $penyumbang = Penyumbangindividu::find($id);	
    	  $nama = $penyumbang->nik;
          break;
    	case "4":
    	  $penyumbang = Penyumbangkelompok::find($id);
    	  $nama = $penyumbang->npwp;
          break;
    	case "5":
    	  $penyumbang = Penyumbangswasta::find($id);	
    	  $nama = $penyumbang->no_akte;
    	}
    	
          return $nama;
    }

    public static function boot()
    {
        parent::boot();

        Penerimaan::observe(new UserActionsObserver);
    }
    
    public function jnspenerimaan()
    {
        return $this->hasOne('App\Jnspenerimaan', 'id', 'jnspenerimaan_id');
    }


    public function jnssumberdana()
    {
        return $this->hasOne('App\Jnssumberdana', 'id', 'jnssumberdana_id');
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
