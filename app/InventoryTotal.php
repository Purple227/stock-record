<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryTotal extends Model
{
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventories';

    //Column that are fillable
    protected $fillable = ['total_data'];
}
