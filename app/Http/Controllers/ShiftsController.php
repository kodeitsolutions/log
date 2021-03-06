<?php

namespace App\Http\Controllers;

use Auth;
use Response;
use App\User;
use App\Shift;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ShiftsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $shifts = Shift::all();
        return view('shifts.index', compact('shifts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        //
        return view('shifts.add');
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
            'description' => 'required|unique:shifts',
            'start' => 'required|unique:shifts|different:end',
            'end' => 'required|unique:shifts|',
        ]);

        $data = $request->all();
        $data['start'] = date("H:i", strtotime($request->start));
        $data['end'] = date("H:i", strtotime($request->end));

        $shift = new Shift($data);
        $shift->user_id = Auth::id();
        $saved = $shift->save();

        if ($saved) {
            $request->session()->flash('flash_message', 'Turno '.$shift->description.' creado.');
        }
        else {
            $request->session()->flash('flash_message_not', 'No se pudo crear el Turno.');
        }
        
        return redirect('/shift');
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
        $shift = Shift::find($id);
        if (is_null($shift))
        {
            return redirect('/shift');
        }
        return Response::json($shift);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function choose()
    {
        //
        $shifts = Shift::all();
        return view('shifts.choose',compact('shifts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shift $shift)
    {
        //
        $this->validate($request, [
            'description' => 'required',
            'start' => ['required','different:end',Rule::unique('shifts')->ignore($shift->id)],
            'end' => ['required',Rule::unique('shifts')->ignore($shift->id)]
        ]);

        $data = $request->all();
        $data['start'] = date("H:i", strtotime($request->start));
        $data['end'] = date("H:i", strtotime($request->end));            

        
        $saved = $shift->update($data);

        if ($saved) {
            return back()->with('flash_message', 'Turno '.$shift->description.' modificado.');
        }
        else {
            return back()->with('flash_message_not', 'No se pudo modificar el turno.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Shift  $shift
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Shift $shift)
    {
        //
        $deleted = $shift->delete();
        if ($deleted) {
            $request->session()->flash('flash_message', 'Turno '.$shift->description.' eliminado.');
        }
        else{
            $request->session()->flash('flash_message_not', 'No se pudo eliminar el turno.');   
        }

        return redirect('/shift');
    }

    /**
     * Show the form for searching.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        return view('shifts.search');
    }

    /**
     * Search the specified resource(s).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searching(Request $request)
    {
        $this->validate($request, [
            'search' => 'required',
            'value' => 'required'
        ]);

        $parameter = $request->search;
        $query = $request->value;

        $shifts = Shift::where($parameter, 'LIKE', '%' . $query . '%')->get();
        
        if($shifts->isEmpty()) {
            return back()->with('flash_message_info', 'No hay resultados para la búsqueda realizada.');
            ;
        }
        else {
            return view('shifts.index', compact('shifts'));
        }
        
    }

    /**
     * Store the specified shift for user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function chosen(Request $request)
    {
        # code...
        //dd($request);
        $this->validate($request, [
            'shift' => 'required'
        ]);

        Auth::user()->shift = $request->shift;

        Auth::user()->update();

        return redirect('/entry');
    }
}
