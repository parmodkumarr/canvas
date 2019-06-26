<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workarea extends Model
{
  protected $table = 'workareas';
  protected $fillable = [
    'title', 'picture','type'
  ];

    /**
     * Get the user that owns the workcharts.
     */
    public function workchart()
    {
        return $this->belongsTo('App\Workchart');
    }

    //
    /**
     * Get the workcharts record associated with the user.
     */
    public  function charts()
    {
        return $this->hasMany('App\Chart');
    }
}
