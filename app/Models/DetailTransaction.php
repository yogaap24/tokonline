<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    protected $table = 'detail_transactions';

    protected $guarded = ['id'];

    public function productRelation()
    {
        return $this->hasOne('App\Models\Product','id','product_id');
    }
}
