<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Interval;
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

class IntervalController extends Controller
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
        $intervals = Auth::user()->intervals()->orderBy('created_at', 'desc')->get();

        // load the view and pass the worcharts
        return View::make('intervals.index')->with('intervals', $intervals);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // load the create form
        return View::make('intervals.create');
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
            'formula'       => 'required'
        );
        $validator = Validator::make($request->all(), $rules);
        //process the login
        if ($validator->fails()) {
            return Redirect::to('intervals/create')
                ->withErrors($validator);
        } else {
            // store
            $interval = new Interval;
            $interval->title = $request->title;
            $interval->formula = $request->formula;
            $interval->user_id = Auth::user()->id;
            $interval->save();

            // redirect
            Session::flash('message', 'Successfully created interval!');
            return Redirect::to('intervals');
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
        $interval = Interval::find($id);
        
        // show the view and pass the nerd to it
        return View::make('intervals.show')->with('interval', $interval);
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
      $interval = Interval::find($id);
      // show the edit form and pass the nerd
      return View::make('intervals.edit')
          ->with('interval', $interval);
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
          'formula'       => 'required'
      );
      $validator = Validator::make(Input::all(), $rules);
      // process the login
      if ($validator->fails()) {
          return Redirect::to('intervals/' . $id . '/edit')
              ->withErrors($validator);
      } else {
          // store
          $interval = Interval::find($id);
          $interval->title = Input::get('title');
          $interval->formula = Input::get('formula');
          $interval->save();

          // redirect
          Session::flash('message', 'Successfully updated interval!');
          return Redirect::to('intervals/');
      }
    }

	// delete interval
    public function intervaldelete($workchart_id)
    {
        // get the interval
        $interval = Interval::find($workchart_id);
       
	    if($interval->delete()){
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
        $interval = Interval::find($id);
       
        if($interval->delete()){
            Session::flash('message', 'Successfully deleted interval!');
            return Redirect::to('intervals/');
        }else{
            Session::flash('message', 'Unable to delete interval!');
            return Redirect::to('intervals/');
        }
    }

}
