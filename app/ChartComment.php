<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class ChartComment extends Model
{
    protected $table = 'chart_comments';
    public $timestamps = true;
    protected $fillable = ['chart_id' ,'comment', 'xaxis', 'yaxis', 'font_style', 'font_color'];

}
