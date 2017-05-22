<?php

namespace App\Http\Controllers;

use Auth;
use Response;
use App\User;
use App\Material;
use App\Entrie;
use Illuminate\Http\Request;

class MaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $materials = Material::all();
        return view('materials.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        //
        return view('materials.add');
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
            'code' => 'required|max:8|alpha_num|unique:materials',
            'name' => 'required|max:255',
        ]);
        
        $material = new Material($request->all());
        $material->user_id = Auth::id();
        $saved = $material->save();

        if ($saved) {
            $request->session()->flash('flash_message', 'Tipo de Material '.$material->name.' creado.');
        }
        else {
            $request->session()->flash('flash_message_not', 'No se pudo crear el Tipo de Material.');
        }
        
        return redirect('/material');
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
        $material = Material::find($id);
        if (is_null($material))
        {
            return redirect('/material');
        }
        return Response::json($material);
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
    public function update(Request $request, Material $material)
    {
        //
        $saved = $material->update($request->all());

        if ($saved) {
            $request->session()->flash('flash_message', 'Tipo de material '.$material->name.' modificado.');
        }
        else {
            $request->session()->flash('flash_message_not', 'No se pudo modificar el tipo de material.');
        }

        return redirect('/material');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Material $material)
    {
        //
        $entries = Entrie::where('material_id', $material->id)->get();

        if ($entries->isEmpty()) {
            $deleted = $material->delete();
            if ($deleted) {
                $request->session()->flash('flash_message', 'Tipo de material '.$material->name.' eliminado.');
            }
            else{
                $request->session()->flash('flash_message_not', 'No se pudo eliminar el tipo de material.');   
            }
        }
        else {
            $request->session()->flash('flash_message_not', 'No se pudo eliminar el Tipo de Material ya que existen registros asociados a este.');  
        }

        return redirect('/material');
    }

    public function search()
    {
        return view('materials.search');
    }

    public function searching(Request $request)
    {
        $this->validate($request, [
            'search' => 'required',
            'value' => 'required'
        ]);

        $parameter = $request->search;
        $query = $request->value;

        $materials = Material::where($parameter, 'LIKE', '%' . $query . '%')->get();
        
        if($materials->isEmpty()) {
            $request->session()->flash('flash_message_info', 'No hay resultados para la búsqueda realizada.');
            return back();
        }
        else {
            return view('materials.index', compact('materials'));
        }
        
    }
}
