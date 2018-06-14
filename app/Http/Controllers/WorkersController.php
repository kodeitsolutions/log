<?php

namespace App\Http\Controllers;

use URL;
use Auth;
use Response;
use Storage;
use App\User;
use App\Worker;
use App\Companie;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
            'worker_id' => 'required|unique:workers',
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
     * @param  App\Worker  $worker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Worker $worker)
    {
        //dd($request);        
        $this->validate($request, [
            'name' => 'required',
            'worker_id' => ['required',Rule::unique('workers')->ignore($worker->id)],
            'companie_id' => 'required',
            'department' => 'required',
            'position' => 'required',
            'status' => 'required'
        ]);     

        
        $saved = $worker->update($request->all());

        if ($saved) {
            return back()->with('flash_message', 'Trabajador '.$worker->name.' modificado.');
        }
        else {
            return back()->with('flash_message_not', 'No se pudo modificar el trabajador.');
        }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Worker  $worker
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

    /**
     * Show the form for searching.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        return view('workers.search');
    }

    /**
     * Search the specified resource(s).
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searching(Request $request)
    {   
        //dd($request);
        $this->validate($request, [
            'search' => 'required',
            'value' => 'required'
        ]);
        
        $parameter = $request->search;
        $query = $request->value;

        $workers = Worker::where($parameter, 'LIKE', '%' . $query . '%')->orderBy('name')->get();
        
        if($workers->isEmpty()) {
            return back()->with('flash_message_info', 'No hay resultados para la búsqueda realizada.');;
        }
        else {
            $companies = Companie::all();
            if (URL::previous() === URL::route('workers.index')) { 
               return view('workers.index', compact('workers','companies'));
            } else {
               return view('entries.workers', compact('workers','companies'));
            }
        }
        
    }

    /**
     * Show the form for uploading the file of workers.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload()
    {
        # code...
        $companies = Companie::all();
        return view('workers.upload',compact('companies'));
    }

    /**
     * Store the workers from uploaded file.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        # code...
        //dd($request);
        $this->validate($request,[
            'companie_id' => 'required',
            'file' => 'mimes:text/xml|file'
        ]);
       
        if ($request->hasFile('trabajadores')) {
            $file = $request->file('trabajadores');
            
            $ext = $request->file('trabajadores')->getClientOriginalExtension();
            
            if ($ext != 'xml') {
               return back()->with('flash_message_not','El archivo debe ser .xml.')->with($request);
            } else {
                $path = $file->storeAs('workers/'.$request->companie_id, 'workers.xml');

                $xml = simplexml_load_file($file, null, LIBXML_NOCDATA);
                
                foreach ($xml->registro as $registros) {
                    $worker = new Worker(); 
                    
                    $worker->name = (string)$registros->nom_tra;
                    $worker->worker_id = (string)$registros->cedula;
                    $worker->companie_id = $request->companie_id;
                    $worker->department = $worker->getDepartment((string)$registros->cod_dep);
                    $worker->position = $worker->getPosition((string)$registros->cod_car);
                    $worker->status = 'A';
                    $worker->user_id = Auth::id();

                    $worker->save();
                }
                return redirect('/worker')->with('flash_message','Trabajadores cargados');
            }
        } else {            
            return back()->with('flash_message_not','No seleccionó ningún archivo.');             
        }        
    }  
        
}
