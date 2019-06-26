<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class ChartLine extends Model
{
    protected $table    = 'chart_lines';
    public $timestamps  = true;
    protected $fillable = ['start_x' ,'start_y', 'end_x', 'end_y', 'extra_info'];

}
