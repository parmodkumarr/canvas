<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Algo;
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

class AlgoController extends Controller
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
        $algos = Auth::user()->algos()->orderBy('created_at', 'desc')->get();

        // load the view and pass the worcharts
        return View::make('algos.index')->with('algos', $algos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        // load the create form
        return View::make('algos.create');
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
            return Redirect::to('algos/create')
                ->withErrors($validator);
        } else {
            // store
            $algo = new Algo;
            $algo->title = $request->title;
            $algo->formula = $request->formula;
            $algo->operator_type = $request->operator_type;
            $algo->user_id = Auth::user()->id;
            $algo->save();

            // redirect
            Session::flash('message', 'Successfully created algo!');
            return Redirect::to('algos');
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
        $algo = Algo::find($id);
        
        // show the view and pass the nerd to it
        return View::make('algos.show')->with('algo', $algo);
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
      $algo = Algo::find($id);
      // show the edit form and pass the nerd
      return View::make('algos.edit')
          ->with('algo', $algo);
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
          return Redirect::to('algos/' . $id . '/edit')
              ->withErrors($validator);
      } else {
          // store
          $algo = Algo::find($id);
          $algo->title = Input::get('title');
          $algo->formula = Input::get('formula');
          $algo->operator_type = Input::get('operator_type');
          $algo->save();

          // redirect
          Session::flash('message', 'Successfully updated algo!');
          return Redirect::to('algos/');
      }
    }

    // delete algo
    public function algodelete($workchart_id)
    {
        // get the algo
        $algo = Algo::find($workchart_id);
       
        if($algo->delete()){
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
        $interval = Algo::find($id);
       
        if($interval->delete()){
            Session::flash('message', 'Successfully deleted algo!');
            return Redirect::to('intervals/');
        }else{
            Session::flash('message', 'Unable to delete algo!');
            return Redirect::to('intervals/');
        }
    }

}
