<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Workchart extends Model
{
    protected $table = 'workcharts';
    protected $fillable = [
      'title', 'picture'
    ];

    /**
     * Get the user that owns the workcharts.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //
    /**
     * Get the workcharts record associated with the user.
     */
    public function workareas()
    {
        return $this->hasMany('App\Workarea');
    }

    /**
     * Get the workcharts record associated with the user.
     */
    public function charts()
    {
        return $this->hasMany('App\Chart');
    }

}
