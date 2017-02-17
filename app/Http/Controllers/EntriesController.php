<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Entrie;
use App\Operation;
use App\Categorie;
use App\Companie;
use App\Unit;
use Illuminate\Http\Request;

class EntriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        /*if (Auth::user()->isAdmin) {
            $entries = Entrie::all();
            return view('entries.index', compact('entries'));
        } else {
            return redirect('entry/add');
        }*/
        $date = date('d/m/Y');
        $entries = Entrie::whereDate('created_at', '=', date('Y-m-d'))->get();
        return view('entries.index', compact('entries', 'date'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        //
        $operations = Operation::all();
        $categories = Categorie::all();
        $companies = Companie::all();
        $units = Unit::orderBy('code')->get();
        return view('entries.add', compact('operations','categories','companies','units'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        $this->validate($request, [
            'operation' => 'required',
            'type' => 'required',
            'destination' => 'required|max:255',
            'hour' => 'required',
            'minute' =>  'required',
            'ampm' => 'required',
            'vehicle_plate' => 'alpha_num'
        ]);

        $entrie = new Entrie($request->all());
        
        $entrie->material_quantity = (empty($request->material_quantity)) ? 0 : $request->material_quantity ;
        $hour = ($request->hour < 10) ? '0'.$request->hour : $request->hour ;
        $minute = ($request->minute < 10) ? '0'.$request->minute : $request->minute ;
        
        $entrie->time = $hour.':'.$minute.' '.$request->ampm;
        $entrie->user_id = Auth::id();

        $saved = $entrie->save();
        if ($saved) {
            $request->session()->flash('flash_message', 'Registro creado.');
        }
        else {
            $request->session()->flash('flash_message_not', 'No se pudo crear el registro.');   
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $entry = Entrie::find($id);
        if (is_null($entry))
        {
            return Redirect::route('entries.index');
        }
        return \Response::json($entry);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
