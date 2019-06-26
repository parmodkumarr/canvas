<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Workchart;
use App\Workarea;
use App\Chart;
use App\Timeseries;
use App\ChartSignal;
use App\ChartComment;
use App\ChartLine;
use App\ChartGroup;
use App\User;
use Auth;
use View;
use Html;
use Form;
use Validator;
use Input;
use Redirect;
use Session;
use URL;
use DateTime;

class ChartController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){ 
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index($group_id){
        return View::make('charts.chart_view', compact('group_id','chart'));
    }

     /**
     * Return the workchart all charts.
     *
     * @return Response
     */

    public function getCreateChart($group_id){
        // get all the chart with main chart
        $charts = Chart::where('workchart_id','=',$group_id)->orderBy('type', 'asc')->get();
        $output = view('charts.create_chart', ['charts' => $charts, 'group_id' => $group_id])->render();
        return response()->json(['status' => 'success', 'view' => $output]);
    }

    /**
     * Return the workchart all charts.
     *
     * @return Response
     */

    public function workchart_charts_list($id){
 
       /* $charts = Chart::where('workchart_id', '=' ,$id)->where('type', '=' , 'M')->orderBy('type', 'asc')->get();*/
        $charts = Chart::where('workchart_id', '=' ,$id)->groupBy('group_id')->orderBy('created_at', 'asc')->get();
        return View::make('charts.workchart_chart_list', compact('charts'));
    }  

    public function getTimeseriesForm($id){
		$output = View::make('charts.timeseries_form')->with('id', $id)->render();
        return response()->json(['status' => 'success', 'view' => $output]);
    }	
	

    /**
     * Return the workchart all charts.
     *
     * @return Response
     */

    public function addComment($id, Request $request){
        $chart_id = $id;
        $data     = $request->all();
        $valueX   = $data['valueX'];
        $valueY   = $data['valueY'];
        $comment_text = $data['text'];
        // $font_style   = $data['font_style'];
        // $font_color   = $data['font_color'];

       // $chart_comment = new ChartComment();
        $chart_comment = ChartComment::firstOrNew(['xaxis' => $valueX ,'yaxis' => $valueY, 'chart_id' => $chart_id]);
        if($chart_comment){
            $chart_comment->chart_id    = $chart_id;
            $chart_comment->comment     = $comment_text;
            $chart_comment->xaxis       = $valueX;
            $chart_comment->yaxis       = $valueY;
            $chart_comment->font_style  = "";
            $chart_comment->font_color  = "";
            $chart_comment->created_at  = date('Y-m-d H:i:s');
            $chart_comment->updated_at  = date('Y-m-d H:i:s');
            if($chart_comment->save()){
                return response()->json(['status' => 'success', 'comment' => $chart_comment]); 
            }else{
                return response()->json(['status' => 'error']); 
            }
        }
    }    

    /**
     * Return the commnets according to the partcular chart.
     *
     * @return Response
     */

    public function getComments($id, Request $request){
        $chart_id = $id;
        $get_comments = ChartComment::select('*')->where('chart_id', $id)->get()->toArray();
        return response()->json(['status' => 'success', 'comments' => $get_comments]); 
    } 

    /**
     * Delete the comment as per the chart id according to the respective points.
     *
     * @return Response
     */

    public function deleteComment(Request $request){
        $comment = ChartComment::find($request->comment_id);
        if($comment){
            if($comment->delete()){
                $get_comments = ChartComment::select('*')->where('chart_id', $request->chart_id)->get()->toArray();
                return response()->json(['status' => 'success', 'comments' => $get_comments]); 
            }else{
                return response()->json(['status' => 'error']); 
            }
        }else{
            return response()->json(['status' => 'error']); 
        }
    }
     

    /**
     * Delete the signal as per the the value and level(Above/below).
     *
     * @return Response
     */

    public function deleteSignalLevel(Request $request){
        $data = $request->all();
        if($data['chart_id'] != "" && $data['chart_id'] !=0){
            //$signaldelete = ChartSignal::find($data['id']);
            $delete_signal = ChartSignal::where([['chart_id','=',$data['chart_id']], ['value','=',$data['value']]])->delete();
            if($delete_signal){
                return response()->json(['status' => 'success','level'=>$data['value']]); 
            }else{
                return response()->json(['status' => 'error','level' =>0]); 
            }
        }
    } 


    /**
     * Delete the comment as per the id.
     *
     * @return Response
     */

    public function deleteLine(Request $request){
        /*$data = $request->all();
        $chart_id = $data['chart_id'];
        $start_x  = $data['start_x'];
        $start_y  = $data['start_y'];
        $end_x    = $data['end_x']; 
        $end_y    = $data['end_y'];

        $delete_line = ChartLine::where([['chart_id','=',$chart_id], ['start_x','like',$start_x], ['start_y','like',$start_y], ['end_x','like',$end_x], ['end_y','like',$end_y]])->delete();*/

        $delete_line = ChartLine::find($request->line_id);
        if($delete_line->delete()){
            return response()->json(['status' => 'success']); 
        }else{
            return response()->json(['status' => 'error']); 
        }
    }   

    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($workchart_id){
        Session::put('workchart_id', $workchart_id);
		$select      = [];
		
		$select['M'] = 'Main';
		$select['S'] = 'Sub';
		
       return View::make('charts.create', compact('workchart_id','select','check'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request){
        $rules = array('title'       => 'required');
		if($request->timeseries_count > 0){
            for($i=1; $i <=$request->timeseries_count; $i++){
                $rules['timeseries_chart_color'.$i]='required';
                $rules['chart_type'.$i]='required';     
            }
        }
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('workcharts/'.$request->workchart_id.'/create')->withErrors($validator);
        } else {
			$chart = new Chart();
			$chart->workchart_id      = $request->workchart_id;
            $chart->title             = $request->title;
            if($request->type == 'M'){

                $chart_group = new ChartGroup();
                $chart_group->status      = 1;
                $chart_group->created_by  = auth()->user()->id;
                $chart_group->updated_by  = auth()->user()->id;
                $chart_group->save();

                $chart->group_id          = $chart_group->id;
            }
            $chart->type              = $request->type;
            $chart->chart_mode        = 1;//$request->chart_mode;
            /*if($request->chart_mode == 2){
                $chart->start_date    = $request->start_date;
                $chart->end_date      = $request->end_date;
            }*/
			if($chart->save()){
                if($request->timeseries_count > 0){
                    for($i=1; $i <=$request->timeseries_count; $i++){
                        if($request->has('data_option'.$i) && $request->has('series_type'.$i) && $request->has('chart_type'.$i)){
                            $time_series = new Timeseries();
                            $time_series->chart_id    = $chart->id;
                            $time_series->color       = $request->input('timeseries_chart_color'.$i);
                            $time_series->chart_type  = $request->input('chart_type'.$i);
                            if($request->input('series_type'.$i) == 1){
                                $time_series->param_id   = $request->input('data_option'.$i);
                            }else{
                                $time_series->param_id   = 10783;
                            }
                            //$time_series->indicator   = $request->input('indicator'.$i);
                            $time_series->series_type = $request->input('series_type'.$i);
                            $time_series->status      = 1;
                            $time_series->created_by  = auth()->user()->id;
                            $time_series->updated_by  = auth()->user()->id;
                            $time_series->save();
                        }
                    }
                }
			    return Redirect::to('charts/'.$request->workchart_id);
			}
		}
    }

	/**
     * Edit the specified chart.
     *
     * @param  int  $id
     * @return Response
    */

    public function edit($id){
        $chart = Chart::find($id);
        $timeseries = $chart->timeseries;
        
        $select = [];
        if($chart->type == 'M'){
            
            $select['M'] = 'Main';
            
        }else{
            
            $select['S'] = 'Sub';
        }
       return View::make('charts.edit', compact('chart', 'select', 'timeseries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
    */

    public function update(Request $request, $id){ 
        
        //print_r($request->all());die();
        
		if($request->timeseries_count > 0){
            for($i=1; $i <=$request->timeseries_count; $i++){
                $rules['timeseries_chart_color'.$i]='required';
                $rules['chart_type'.$i]='required';     
            }
        }
        $redirect_chart_id = '';	
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('charts/'.$id.'/edit')->withErrors($validator);
        } else {
            $chart = Chart::where('id', $id)->first();
            $chart->workchart_id      = $request->workchart_id;
            //$chart->title             = $request->title;
            //$chart->type              = $request->type;
            /*$chart->chart_mode        = $request->chart_mode;
            if($request->chart_mode == 2){
                $chart->start_date    = $request->start_date;
                $chart->end_date      = $request->end_date;
            }*/
            if($chart->save()){
                if($request->timeseries_count > 0){
                    for($i=1; $i <=$request->timeseries_count; $i++){
                        if($request->has('data_option'.$i) && $request->has('series_type'.$i) && $request->has('chart_type'.$i)){
                            if($request->has('saved_timeseries_id'.$i)){
                                $time_series = Timeseries::where('id', $request->input('saved_timeseries_id'.$i))->first();
                                $time_series->color       = $request->input('timeseries_chart_color'.$i);
                                //if($request->input('series_type'.$i) == 1){
                                $time_series->param_id   = $request->input('data_option'.$i);
                                //}else{
                                    //$time_series->param_id   = 10783;
                                //}
                                
                                //$time_series->indicator   = $request->input('indicator'.$i);
                                $time_series->series_type = $request->input('series_type'.$i);
                                $time_series->chart_type  = $request->input('chart_type'.$i);
                                $time_series->updated_by  = auth()->user()->id;
                                $time_series->save();
                            }else{
                                $time_series = new Timeseries();
                                $time_series->chart_id    = $chart->id;
                                $time_series->color       = $request->input('timeseries_chart_color'.$i);
                                //if($request->input('series_type'.$i) == 1){
                                $time_series->param_id   = $request->input('data_option'.$i);
                                //}else{
                                    //$time_series->param_id   = 10783;
                                //}
                                //$time_series->indicator   = $request->input('indicator'.$i);
                                $time_series->series_type = $request->input('series_type'.$i);
                                $time_series->chart_type  = $request->input('chart_type'.$i);
                                $time_series->status      = 1;
                                $time_series->created_by  = auth()->user()->id;
                                $time_series->updated_by  = auth()->user()->id;
                                $time_series->save();
                            }
                        }
                    }
                }
                
                return Redirect::to('charts/'.$chart->workchart_id);
            }
        }
    }

    public function saveGroupChart(Request $request){
        $parent_chart = Chart::where('workchart_id', $request->group_id)->first();
        $chart = new Chart();
        $chart->workchart_id      = $parent_chart->workchart_id;
        $chart->chart_id          = 0;
        $chart->group_id          = $parent_chart->group_id;
        $chart->title             = $request->title;
        $chart->type              = $request->type;
        $chart->chart_mode        = $request->chart_mode;
        if($request->chart_mode == 2){
            $chart->start_date    = $request->start_date;
            $chart->end_date      = $request->end_date;
        }
        if($chart->save()){
           return response()->json(['status' => 'success']); 
        }else{
           return response()->json(['status' => 'error']); 
        }
    }

    //get add update signal form
    public function getSignalForm($chart_id, $level, $value){
        /* $chart_signal = ChartSignal::where('chart_id', $chart_id)->where('level' , $level)->first();
      
        if($chart_signal){
            $output = view('charts.add_signal_form_element', ['signal_type' => json_decode($chart_signal->signal_type), 'value' => $chart_signal->value, 'chart_id' => $chart_id, 'level' => $level])->render();
            return response()->json(['status' => 'success', 'view' => $output]);
        }else{
            $output = view('charts.add_signal_form_element', ['signal_type' => [], 'value' => $value, 'chart_id' => $chart_id, 'level' => $level])->render();
            return response()->json(['status' => 'success', 'view' => $output]);
        }*/
        $output = view('charts.add_signal_form_element', ['signal_type' => [], 'value' => $value, 'chart_id' => $chart_id, 'level' => $level])->render();
        return response()->json(['status' => 'success', 'view' => $output]);
    }

    //add signal to chart
    public function addsignal(Request $request){
        /*$chart_signal = ChartSignal::firstOrNew(['chart_id' => $request->id, 'level' => $request->signaling]);*/
        $chart_signal = new ChartSignal();
        //$chart_signal = new ChartSignal();
        $chart_signal->chart_id    = $request->id;
        $chart_signal->level       = $request->signaling;
        $title_name = '';
        if(count($request->signal_type) > 0){
            for($i = 0; $i <= count($request->signal_type) -1; $i++){
                if($request->signal_type[$i] == 1){
                    $title_name .= 'SMS,';
                }

                if($request->signal_type[$i] == 3){
                    $title_name .= ' IVR,';
                }

                if($request->signal_type[$i] == 2){
                    $title_name .= ' E-mail';
                }
            }
        }

        if($request->signaling == 1){
            $chart_signal->title = 'Signal – Above – '.$title_name;
        }else{
            $chart_signal->title = 'Signal – Below – '.$title_name;
        }

        $chart_signal->value       = $request->value;
        $chart_signal->signal_type = json_encode($request->signal_type);
        $chart_signal->status      = 1;
        $chart_signal->created_by  = auth()->user()->id;
        $chart_signal->updated_by  = auth()->user()->id;
        if($chart_signal->save()){
           return response()->json(['status' => 'success']); 
        }else{
           return response()->json(['status' => 'error']); 
        }
    }

    public function getChartSignal($id){
        $above_signal = ChartSignal::where('chart_id', $id)->where('level', 1)->get();
        $below_signal = ChartSignal::where('chart_id', $id)->where('level', 2)->get();
        
        if($above_signal && $below_signal){
           return response()->json(['status' => 'success', 'above_count' => count($above_signal), 'above_data' => $above_signal, 'below_count' => count($below_signal), 'below_data' => $below_signal]); 
        }else{
           return response()->json(['status' => 'error']); 
        }
    }

    //add line to chart
    public function saveChartLine(Request $request){
        $chart_name = $request->chart_id;
        $name_array = explode('_', $chart_name);
        $new_data   = $request->line_data;
        $chart      = Chart::where('id',$name_array[1])->first();
        $new_data_array = [];
        if($chart){
            $chart_line = new ChartLine();
            /*$start_x    = $new_data['data'][0]['x'];
            $start_y    = $new_data['data'][0]['y'];
            $end_x      = $new_data['data'][1]['x'];
            $end_y      = $new_data['data'][1]['y'];*/
            $start_x    = $new_data['dataPoints'][0]['x'];
            $start_y    = $new_data['dataPoints'][0]['y'];
            $end_x      = $new_data['dataPoints'][1]['x'];
            $end_y      = $new_data['dataPoints'][1]['y'];
        
            $chart_line->start_x    = $start_x;
            $chart_line->start_y    = $start_y;
            $chart_line->end_x      = $end_x;
            $chart_line->end_y      = $end_y;
            $chart_line->chart_id   = $name_array[1];
            $chart_line->extra_info = json_encode($new_data);
            $chart_line->created_at = date('Y-m-d H:i:s');
            $chart_line->updated_at = date('Y-m-d H:i:s');
            //dd($chart_line);
            if($chart_line->save()){
                $savedline_data = json_decode($chart_line->extra_info);
                $savedline_data->line_id = $chart_line->id;
                $line_data[] = $savedline_data;
               return response()->json(['status' => 'success', 'data' => $line_data]); 
            }else{
               return response()->json(['status' => 'error']); 
            }
        }else{
            return response()->json(['status' => 'error']);
        }
    }

    //show line on chart
    public function getChartLine($chart_id){
        $chart_lines = ChartLine::select('*')->where('chart_id',$chart_id)->get();
        $return_data = [];
        $line_data   = [];
        if($chart_lines->count() > 0){
            $get_all_lines =  $chart_lines->toArray();
            foreach($get_all_lines as $line){
                $savedline_data = json_decode($line['extra_info']);
                $savedline_data->line_id = $line['id'];
                $line_data[] = $savedline_data;
            }
        }
      
        $return_data = $line_data;
        if(!empty($return_data)){
            return response()->json(['status' => 'success', 'data' => $return_data]); 
        }else if(empty($return_data)){
            return response()->json(['status' => 'success', 'data' => $return_data]);
        }else{
            return response()->json(['status' => 'error', 'data' => $return_data]);
        }        
    }

    /**
     * Show Chart.
     *
     * @param  int  $id
     * @return Response
    */
	 
    public function showchart($id){
        //get the workarea
        $chart = Chart::find($id);
        $workchart_id = $chart->workchart_id;
        return View::make('charts.chart_view', compact('workchart_id','chart'));
    }

    /**
     * Delete Chart.
     *
     * @param  int  $id
     * @return Response
    */

    public function chartdelete($id){
        
        $chartdelete = Chart::find($id);

        //delete chart signal
        $signals = ChartSignal::where('chart_id', $id)->get();
        if(count($signals) > 0){
            foreach($signals as $signal){
                $signal->delete();
            }
        }
        //delete chart time series
        $time_series = Timeseries::where('chart_id', $id)->get();
        if(count($time_series) > 0){
            foreach($time_series as $series){
                $series->delete();
            }
        }

        // delete chart line
        $chart_lines = ChartLine::where('chart_id',$id)->get();
        if(count($chart_lines) > 0){
            foreach($chart_lines as $lines){
                $lines->delete();
            }
        }

	    if($chartdelete->delete()){
		    return response()->json(['status' => 'success']); 
	    }else{
		    return response()->json(['status' => 'error']); 
	    }	  
    }

    /**
     * Delete Chart.
     *
     * @param  int  $id
     * @return Response
    */

    public function deleteParent($id){
        $charts = Chart::where('group_id', $id)->get();
        $workchart_id = '';
        if(count($charts) > 0){
            foreach($charts as $chart){
                $workchart_id = $chart->workchart_id;
                //delete chart signal
                $signals = ChartSignal::where('chart_id', $chart->id)->get();
                if(count($signals) > 0){
                    foreach($signals as $signal){
                        $signal->delete();
                    }
                }
                //delete chart time series
                $time_series = Timeseries::where('chart_id', $chart->id)->get();
                if(count($time_series) > 0){
                    foreach($time_series as $series){
                        $series->delete();
                    }
                }
                // delete chart line
                $chart_lines = ChartLine::where('chart_id',$chart->id)->get();
                if(count($chart_lines) > 0){
                    foreach($chart_lines as $lines){
                        $lines->delete();
                    }
                }
                //delete chart 
                $chart->delete();
            }
            // delete group
            $chart_group = ChartGroup::where('id', $id)->first();
            $chart_group->delete();
            //return Redirect::to('charts/workchart_charts_list/'.$workchart_id);
            return response()->json(['status' => 'success']); 
        }else{
            return response()->json(['status' => 'error']); 
        }   
    }

    /**
     * Delete chart signal.
     *
     * @param  int  $id
     * @return Response
    */

    public function deletesignal($chartid,$level){
       // get the chart for deletion
       $signal = ChartSignal::where('chart_id', $chartid)->where('level' , $level)->first();
       if($signal->delete()){
           return response()->json(['status' => 'success']); 
       }else{
           return response()->json(['status' => 'error']); 
       }      
    }	
	
     public function deleteTimeseries($id){
       // get the chart for deletion
       $timeseries = Timeseries::find($id);
       if($timeseries->delete()){
           return response()->json(['status' => 'success']); 
       }else{
           return response()->json(['status' => 'error']); 
       }      
    } 

    public function getMicroTimeDate(Request $request){
        $start_d       = new DateTime($request->start_dt);
        $startTimeInt  = $start_d->getTimestamp();//convert start date time to timestamp
        $uStartTimeInt = $start_d->format('u');//get microsecond from start date time

        $end_d         = new DateTime($request->end_dt);
        $endTimeInt    = $end_d->getTimestamp();//convert end date time to timestamp
        $uEndTimeInt   = $end_d->format('u');//get microsecond fron end datetime
        
        $data['start_micro'] = $uStartTimeInt;
        $data['end_micro'] = $uEndTimeInt;
        
        return response()->json(['status' => 'success', 'data' => $data]); 
       
    }

}
