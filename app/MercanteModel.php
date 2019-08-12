<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MercanteModel extends Model
{
    protected $table='shop_mercante';
    public $timestamps=false;
    protected $primaryKey='shop_id';
}
