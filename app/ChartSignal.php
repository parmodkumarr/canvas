<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class ChartSignal extends Model
{
    protected $table = 'chart_signals';
    public $timestamps = true;
    protected $fillable = ['chart_id', 'level', 'value', 'status', 'created_by', 'updated_by'];

    /**
     * chart has one signal.
     */
    public function chart()
    {
        return $this->belongsTo('App\Chart');
    }
}
