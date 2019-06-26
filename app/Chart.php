<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Chart extends Model
{
    protected $table = 'charts';
    protected $fillable = ['title', 'picture','type','workchart_id','chart_type'];

    public $appends = ['uniquename'];

    public function getUniqueNameAttribute(){
        return 'mychart_'.$this->id;
    }

    /**
     * Get the user that owns the workcharts.
     */
    public function workchart()
    {
        return $this->belongsTo('App\Workchart');
    }

    public function chart_signal()
    {
       return $this->hasMany('App\ChartSignal');
    }

    public function timeseries()
    {
       return $this->hasMany('App\Timeseries');
    }

    public function chartgroup(){
        return $this->belongsTo('App\ChartGroup');
    }
}
