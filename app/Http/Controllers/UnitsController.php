<?php

namespace App\Http\Controllers;

use Auth;
use Response;
use App\User;
use App\Unit;
use App\Entrie;
use Illuminate\Http\Request;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $units = Unit::orderBy('code')->get();
        return view('units.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        //
        return view('units.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'code' => 'required|max:5|alpha_num|unique:units',
            'name' => 'required|max:255',
        ]);
        
        $unit = new Unit($request->all());
        $unit->user_id = Auth::id();
        $saved = $unit->save();

        if ($saved) {
            $request->session()->flash('flash_message', 'Unidad '.$unit->name.' creada.');
        }
        else {
            $request->session()->flash('flash_message_not', 'No se pudo crear la Unidad.');
        }
        
        return redirect('/unit');
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
        $unit = Unit::find($id);
        if (is_null($unit))
        {
            return redirect('/unit');
        }
        return Response::json($unit);
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
    public function update(Request $request, Unit $unit)
    {
        //
        $saved = $unit->update($request->all());

        if ($saved) {
            $request->session()->flash('flash_message', 'Unidad '.$unit->name.' modificada.');
        }
        else {
            $request->session()->flash('flash_message_not', 'No se pudo modificar la Unidad.');
        }

        return redirect('/unit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Unit $unit)
    {
        //
        //dd($unit->id);
        $entries = Entrie::where('unit_id', $unit->id)->get();

        if ($entries->isEmpty()) {
            $deleted = $unit->delete();
            if ($deleted) {
                $request->session()->flash('flash_message', 'Unidad '.$unit->name.' eliminada.');
            }
            else{
                $request->session()->flash('flash_message_not', 'No se pudo eliminar la Unidad.');   
            }
        }
        else {
            $request->session()->flash('flash_message_not', 'No se pudo eliminar la Unidad ya que existen registros asociados a esta.');  
        }

        return redirect('/unit');
    }

    public function search()
    {
        return view('units.search');
    }

    public function searching(Request $request)
    {
        $this->validate($request, [
            'search' => 'required',
            'value' => 'required'
        ]);

        $parameter = $request->search;
        $query = $request->value;

        $units = Unit::where($parameter, 'LIKE', '%' . $query . '%')->get();
        
        if($units->isEmpty()) {
            $request->session()->flash('flash_message_info', 'No hay resultados para la búsqueda realizada.');
            return back();
        }
        else {
            return view('units.index', compact('units'));
        }
        
    }
}
