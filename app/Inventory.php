<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventories';

    //Column that are fillable
    protected $fillable = ['total_weight', 'total_discount', 'total_bags'];


}
