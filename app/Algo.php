<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Algo extends Model
{
    protected $table = 'algos';
    protected $fillable = [
      'title', 'formula', 'operator_type'
    ];

    /**
     * Get the user that owns the workcharts.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

   

}
