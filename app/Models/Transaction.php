<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $guarded = ['id'];

    protected $dates   = ['date_transactions', 'created_at', 'update_at'];

    public function scopeGetCode($query)
    {
        $string = "TR";

        $lastNumber = DB::raw(" coalesce( MAX( CAST( RIGHT( transaction_code, 5 ) AS INT)), 0) as code ");
        
        $getLastdata = $query->select($lastNumber)->where("transaction_code","LIKE","%$string%")->first();
        
        $number = sprintf("%'05d", $getLastdata->code + 1);

        return $string.$number;
    }


    public function userRelation()
    {
        return $this->hasOne('App\Models\User','id','user_id');
    }

    public function detailRelation()
    {
        return $this->hasMany('App\Models\DetailTransaction','transaction_id','id');
    }
}
