<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use PDF;
use Response;
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
        $date = date('d/m/Y');
        $entries = Entrie::whereDate('date', '=', date('Y-m-d'))->orderBy('date','time')->get();
        Session::put('entries', $entries);
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
            'operation_id' => 'required',
            'categorie_id' => 'required',
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

        return redirect('/entry');
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
        return Response::json($entry);
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
        $operations = Operation::all();
        $categories = Categorie::all();
        $companies = Companie::all();
        $units = Unit::orderBy('code')->get();
        $users = User::all();
        return view('entries.search',compact('operations','categories','companies','units','users'));
    }

    public function searching(Request $request)
    {
        //dd($request);

        $input = $request->all();

        $conditions = [['date', '>=',$request->date_from],
                       ['date', '<=',$request->date_to]];

       if($request->has('user')){
            array_push($conditions, ['user_id','=',$request->user]);
        }
        if($request->has('operation')){
            array_push($conditions, ['operation_id','=',$request->operation]);
        }
        if($request->has('category')){
            array_push($conditions, ['categorie_id','=',$request->type]);
        }
        if($request->has('company')){
            array_push($conditions, ['companie_id','=',$request->company]);
        }

        $entries = Entrie::where($conditions)->get();        

        if($entries->isEmpty()) {
            $request->session()->flash('flash_message_info', 'No hay resultados para la búsqueda realizada.');
            return redirect()->back()->withInput();
        }
        else {
            $date = '';
            Session::put('entries', $entries);
            return view('entries.index', compact('entries','date'));
        }
    }

    public function test()
    {
        # code...
        $entries = Session::get('entries');
        //dd($entries);

        if ($entries->isEmpty()) {            
            Session::flash('flash_message_info', 'No hay datos para imprimir.');
            return back();
        } else {
            $pdf = PDF::loadView('entries.print', compact('entries'));
            return $pdf->download('Registros.pdf');

            Session::forget('entries');
        }
        
        
    }
}
