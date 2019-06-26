<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interval extends Model
{
    protected $table = 'intervals';
    protected $fillable = [
      'title', 'formula'
    ];

    /**
     * Get the user that owns the workcharts.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

  

}
