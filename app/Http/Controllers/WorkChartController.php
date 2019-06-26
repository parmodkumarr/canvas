<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Workchart;
use App\Workarea;
use App\Timeseries;
use App\ChartSignal;
use App\ChartLine;
use App\Chart;
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

class WorkChartController extends Controller
{ 
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    { 
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // get all the worcharts for user_id
        $workcharts = Auth::user()->workcharts()->orderBy('created_at', 'desc')->get();

        // load the view and pass the worcharts
        return View::make('workcharts.index')->with('workcharts', $workcharts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // load the create form
        return View::make('workcharts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'title'       => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        //process the login
        if ($validator->fails()) {
            return Redirect::to('workcharts/create')
                ->withErrors($validator);
        } else {
            // store
            $workchart = new Workchart;
            $workchart->title = $request->title;
            $workchart->picture = '';
            $workchart->user_id = Auth::user()->id;
            $workchart->save();

            // redirect
            Session::flash('message', 'Successfully created workchart!');
            return Redirect::to('workcharts');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        // get the nerd
        $workchart = Workchart::find($id);
        $workareas = Chart::where('workchart_id',$workchart->id)->get();
        foreach ($workareas as $key => $item) {
            $workareas[$key]['charts'] =$item->charts;
        }
        // show the view and pass the nerd to it
        return View::make('workcharts.show')->with('workchart', $workchart)->with('workareas', $workareas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
      // get the workchart
      $workchart = Workchart::find($id);
      // show the edit form and pass the nerd
      return View::make('workcharts.edit')
          ->with('workchart', $workchart);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
      $rules = array(
          'title'       => 'required',
      );
      $validator = Validator::make(Input::all(), $rules);
      // process the login
      if ($validator->fails()) {
          return Redirect::to('workcharts/' . $id . '/edit')
              ->withErrors($validator);
      } else {
          // store
          $workchart = Workchart::find($id);
          $workchart->title = Input::get('title');
          $workchart->save();

          // redirect
          Session::flash('message', 'Successfully updated workchart!');
          return Redirect::to('workcharts/');
      }
    }

	// delete workchart
    public function workchartdelete($workchart_id)
    {
        // get the workchart
        $workchart = Workchart::find($workchart_id);
        //delete all charts from work chart
	    
        $charts = Chart::where('workchart_id', $workchart_id)->get();
        if(count($charts) > 0){
            foreach($charts as $chart){
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
        }

	    if($workchart->delete()){
		   return response()->json(['status' => 'success']); 
	    }else{
		   return response()->json(['status' => 'error']); 
	    }
    }	
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}
