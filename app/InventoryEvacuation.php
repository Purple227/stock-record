<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryEvacuation extends Model
{
    
     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventories';

    //Column that are fillable
    protected $fillable = ['name', 'tonne', 'weight', 'bags'];

}
