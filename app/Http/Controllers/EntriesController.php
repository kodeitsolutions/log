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
        $entries = Entrie::whereDate('date', '=', date('Y-m-d'))->orderBy('date','time')->get();
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
        $date = date('Y-m-d');
        $operations = Operation::all();
        $categories = Categorie::all();
        $companies = Companie::all();
        $units = Unit::orderBy('code')->get();
        return view('entries.add', compact('operations','categories','companies','units','date'));
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
    public function edit(Entrie $entry)
    {
        //dd($entry);
        $users = User::all();
        $operations = Operation::all();
        $categories = Categorie::all();
        $companies = Companie::all();
        $units = Unit::all();
        return view('entries.edit', compact('entry','operations','categories','companies','units','users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entrie $entry)
    {
        //dd($request);

        $saved = $entry->update($request->all());

        if ($saved) {
            $request->session()->flash('flash_message', 'Registro modificado.');
        }
        else {
            $request->session()->flash('flash_message_not', 'No se pudo modificar el Registro.');
        }

        return redirect('/entry');
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

    public function search()
    {
        return view('entries.search');
    }

    public function searching(Request $request)
    {
        //dd($request);
        $this->validate($request, [
            'search' => 'required',
        ]);

        $parameter = $request->search;
        $query = ($request->value_text == '') ? $request->value_date : $request->value_text ;

        $users = collect([]);

        if ($parameter == 'date') {
            $entries = Entrie::whereRaw('date(date) = ?', $query)->get();            
        }
        if ($parameter == 'user') {
            $users = User::where('name', 'LIKE', '%' . $query . '%')->get();
            foreach ($users as $user) {
                $entries = Entrie::where('user_id', '=', $user->id)->get();
            }
        }
        if($parameter <> 'date' and $parameter <> 'user'){
            $entries = Entrie::where($parameter, 'LIKE', '%' . $query . '%')->get();
        }
        
        if($entries->isEmpty()) {
            $request->session()->flash('flash_message_info', 'No hay resultados para la búsqueda realizada.');
            return back();
        }
        else {
           //$date = ($parameter == 'date') ? $query : '' ;
            $search = 'Parámetro = '.$query;
            $date = '';
            return view('entries.index', compact('entries','date'));
        }
    }
}
