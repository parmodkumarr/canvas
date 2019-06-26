<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Timeseries extends Model
{
    protected $table = 'timeseries';
    public $timestamps = true;
    protected $fillable = ['chart_id', 'color', 'indicator', 'series_type', 'chart_type', 'status', 'created_by', 'updated_by'];

    /**
     * chart has one signal.
    */
    
    public function chart()
    {
        return $this->belongsTo('App\Chart');
    }
}
