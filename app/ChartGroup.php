<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class ChartGroup extends Model
{
    protected $table = 'chart_groups';
    
    public function chart()
    {
       return $this->hasMany('App\Chart');
    }

}
