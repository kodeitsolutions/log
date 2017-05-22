<?php

namespace App\Http\Controllers;

use Auth;
use Response;
use App\User;
use App\Operation;
use App\Entrie;
use Illuminate\Http\Request;

class OperationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $operations = Operation::all();

        return view('operations.index', compact('operations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        //
        return view('operations.add');
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
            'name' => 'required|max:255|unique:operations,deleted_at,NULL'
        ]);
        
        $operation = new Operation($request->all());
        $operation->user_id = Auth::id();
        $saved = $operation->save();

        if ($saved) {
            $request->session()->flash('flash_message', 'Tipo de Movimiento '.$operation->name.' creado.');
        }
        else {
            $request->session()->flash('flash_message_not', 'No se pudo crear el Tipo de Movimiento.');
        }
        
        return redirect('/operation');
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

        $operation = Operation::find($id);
        if (is_null($operation))
        {
            return redirect('/operation');;
        }
        return Response::json($operation);
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
    public function update(Request $request, Operation $operation)
    {
        //
        $saved = $operation->update($request->all());

        if ($saved) {
            $request->session()->flash('flash_message', 'Tipo de Movimiento '.$operation->name.' modificado.');
        }
        else {
            $request->session()->flash('flash_message_not', 'No se pudo modificar el Tipo de Movimiento.');
        }

        return redirect('/operation');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Operation $operation)
    {
        //
        //dd($operation->id);
        $entries = Entrie::where('operation_id', $operation->id)->get();

        if ($entries->isEmpty()) {
            $deleted = $operation->delete();
            if ($deleted) {
                $request->session()->flash('flash_message', 'Tipo de Movimiento '.$operation->name.' eliminado.');
            }
            else{
                $request->session()->flash('flash_message_not', 'No se pudo eliminar el Tipo de Movimiento.');   
            }
        }
        else {
            $request->session()->flash('flash_message_not', 'No se pudo eliminar el Tipo de Movimiento ya que existen registros asociados a este.');  
        }             

        return redirect('/operation');
    }

    public function search()
    {
        return view('operations.search');
    }

    public function searching(Request $request)
    {
        $this->validate($request, [
            'search' => 'required',
            'value' => 'required'
        ]);

        $parameter = $request->search;
        $query = $request->value;

        $operations = Operation::where($parameter, 'LIKE', '%' . $query . '%')->get();
        
        if($operations->isEmpty()) {
            $request->session()->flash('flash_message_info', 'No hay resultados para la búsqueda realizada.');
            return back();
        }
        else {
            return view('operations.index', compact('operations'));
        }
        
    }
}
