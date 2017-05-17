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
use Carbon\Carbon;
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
        $entries = Entrie::whereDate('date', '=', date('Y-m-d'))->orderBy('date','time')->paginate(20);
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
            'companie_id' => 'required',
            'destination' => 'required|max:255',           
            'hour' => 'required',
            'minute' =>  'required',
            'ampm' => 'required',
            'person_name' => 'required_if:categorie_id,1,3', 
            'person_id' => 'required_if:categorie_id,1,3',
            'person_occupation' => 'required_if:categorie_id,1,3', 
            'person_company' => 'required_if:categorie_id,1,3', 
            'material_type' => 'required_if:categorie_id,2,3',
            'material_quantity' => 'required_if:categorie_id,2,3',
            'unit_id' => 'required_if:categorie_id,2,3',

        ]);

        $data = $request->all();
        $date = $request->date;
        $date = date('Y-m-d', strtotime(str_replace('/', '-', $date)));
        $data['date'] = $date;

        $entrie = new Entrie($data);   

        $hour = ($request->hour < 10) ? '0'.$request->hour : $request->hour ;
        $minute = ($request->minute < 10) ? '0'.$request->minute : $request->minute ;        
        $entrie->time = $hour.':'.$minute.' '.$request->ampm;

        $entrie->material_quantity = (empty($request->material_quantity)) ? 0 : $request->material_quantity ;  

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
        $data = $request->all();
        $date = $request->date;
        $date = date('Y-m-d', strtotime(str_replace('/', '-', $date)));
        $data['date'] = $date;

        $saved = $entry->update($data);

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
    public function destroy(Request $request, Entrie $entry)
    {
        //
        $deleted = $entry->delete();
        if ($deleted) {
            $request->session()->flash('flash_message', 'Registro eliminado.');
        }
        else{
            $request->session()->flash('flash_message_not', 'No se pudo eliminar el Registro.');   
        }
        return redirect()->back();
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
        $date_from = $request->date_from;
        $date_from = date('Y-m-d', strtotime(str_replace('/', '-', $date_from)));
        $date_to = $request->date_to;
        $date_to = date('Y-m-d', strtotime(str_replace('/', '-', $date_to)));

        $conditions = [['date', '>=',$date_from],
                       ['date', '<=',$date_to]];

       if($request->has('user_id')){
            array_push($conditions, ['user_id','=',$request->user_id]);
        }
        if($request->has('operation_id')){
            array_push($conditions, ['operation_id','=',$request->operation_id]);
        }
        if($request->has('categorie_id')){
            array_push($conditions, ['categorie_id','=',$request->categorie_id]);
        }
        if($request->has('companie_id')){
            array_push($conditions, ['companie_id','=',$request->companie_id]);
        }
        
        $entries = Entrie::where($conditions)->paginate(20);

        if($entries->isEmpty()) {
            $request->session()->flash('flash_message_info', 'No hay resultados para la búsqueda realizada.');
            return redirect()->back()->withInput($input);
        }
        else {
            $date_from = $request->date_from;
            $date_to = $request->date_to;
            Session::put('entries', $entries);
            return view('entries.index', compact('entries','date_from','date_to'));
        }
    }
    
    public function test()
    {
        # code...
        $entries = Session::get('entries');
        //dd($entries);
        //return view('entries.print', compact('entries'));
        
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
