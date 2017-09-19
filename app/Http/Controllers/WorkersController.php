<?php

namespace App\Http\Controllers;

use Auth;
use Response;
use App\User;
use App\Worker;
use App\Companie;
use Illuminate\Http\Request;

class WorkersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $workers = Worker::all();
        $companies = Companie::all();
        return view('workers.index',compact('workers','companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        //
        $companies = Companie::all();
        return view('workers.add',compact('companies'));
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
            'name' => 'required',
            'worker_id' => 'required',
            'companie_id' => 'required',
            'department' => 'required',
            'position' => 'required'
        ]);

        $worker = new Worker($request->all());
        $worker->user_id = Auth::id();
        $saved = $worker->save();

        if ($saved) {
            $request->session()->flash('flash_message', 'Trabajador '.$worker->name.' creado.');
        }
        else {
            $request->session()->flash('flash_message_not', 'No se pudo crear el Trabajdor.');
        }
        
        return redirect('/worker');
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
        $worker = Worker::find($id);
        if (is_null($worker))
        {
            return redirect('/worker');
        }
        return Response::json($worker);
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
    public function update(Request $request, Worker $worker)
    {
        //dd($request);        
        $this->validate($request, [
            'name' => 'required',
            'worker_id' => 'required',
            'companie_id' => 'required',
            'department' => 'required',
            'position' => 'required',
            'status' => 'required'
        ]);      

        /*if ($validator->fails()) {
            $request->session()->flash('flash_message_not', 'No se pudo modificar el trabajador.');  
            return redirect('/worker')->withErrors();  
        }
        else {*/
            $saved = $worker->update($request->all());

            if ($saved) {
                $request->session()->flash('flash_message', 'Trabajador '.$worker->name.' modificado.');
            }
            else {
                $request->session()->flash('flash_message_not', 'No se pudo modificar el trabajador.');
            }
            return redirect('/worker');   
        //}        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Worker $worker)
    {
        $deleted = $worker->delete();
        if ($deleted) {
            $request->session()->flash('flash_message', 'Trabajador '.$worker->name.' eliminado.');
        }
        else{
            $request->session()->flash('flash_message_not', 'No se pudo eliminar el trabajador.');   
        }

        return redirect('/worker');
    }

    public function search()
    {
        return view('workers.search');
    }

    public function searching(Request $request)
    {   
        //dd($request);
        $this->validate($request, [
            'search' => 'required',
            'value' => 'required'
        ]);
        
        $parameter = $request->search;
        $query = $request->value;

        $workers = Worker::where($parameter, 'LIKE', '%' . $query . '%')->get();
        
        if($workers->isEmpty()) {
            $request->session()->flash('flash_message_info', 'No hay resultados para la búsqueda realizada.');
            return back();
        }
        else {
            $companies = Companie::all();
            return view('workers.index', compact('workers','companies'));
        }
        
    }
}
