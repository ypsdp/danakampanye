<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;




class Faq extends Model {

    

    

    protected $table    = 'faq';
    
    protected $fillable = [
          'kategori',
          'pertanyaan',
          'jawaban'
    ];
    

    public static function boot()
    {
        parent::boot();

        Faq::observe(new UserActionsObserver);
    }
    
    
    
    
}