<?php

namespace App\Http\Controllers;

use Auth;
use Response;
use App\User;
use App\Categorie;
use App\Entrie;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Categorie::all();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        //
        return view('categories.add');
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
            'name' => 'required|max:255|unique:categories,deleted_at,NULL',
            'description' => 'required|max:255'
        ]);

        $category = new Categorie($request->all());
        
        $category->person = ($request->has('person')) ? 1 : 0 ;
        $category->material = ($request->has('material')) ? 1 : 0 ;
        $category->vehicle = ($request->has('vehicle')) ? 1 : 0 ;
        $category->combined = ($request->has('combined')) ? 1 : 0 ;

        $category->user_id = Auth::id();
        $saved = $category->save();

        if ($saved) {
            $request->session()->flash('flash_message', 'Categoría '.$category->name.' creada.');
        }
        else {
            $request->session()->flash('flash_message_not', 'No se pudo crear la Categoría.');
        }
        
        return redirect('/category');
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
        $category = Categorie::find($id);
        if (is_null($category))
        {
            return redirect('/category');
        }
        return Response::json($category);
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
    public function update(Request $request, Categorie $category)
    {
        //dd($request);
        $category->name = $request->name;
        $category->description = $request->description;
        
        $category->person = ($request->has('person')) ? 1 : 0 ;
        $category->material = ($request->has('material')) ? 1 : 0 ;
        $category->vehicle = ($request->has('vehicle')) ? 1 : 0 ;
        $category->combined = ($request->has('combined')) ? 1 : 0 ;
        
        $saved = $category->update();

        if ($saved) {
            $request->session()->flash('flash_message', 'Categoría '.$category->name.' modificada.');
        }
        else {
            $request->session()->flash('flash_message_not', 'No se pudo modificar la Categoría.');
        }

        return redirect('/category');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Categorie $category)
    {
        //
        $entries = Entrie::where('categorie_id',$category->id)->get();

        if ($entries->isEmpty()) {
            $deleted = $category->delete();
            if ($deleted) {
                $request->session()->flash('flash_message', 'Categoría '.$category->name.' eliminada.');
            }
            else{
                $request->session()->flash('flash_message_not', 'No se pudo eliminar la Categoría.');   
            }
        }
        else {
            $request->session()->flash('flash_message_not', 'No se pudo eliminar la Categoría ya que existen registros asociados a este.');
        }

        return redirect('/category');
    }

    public function search()
    {
        return view('categories.search');
    }

    public function searching(Request $request)
    {
        $this->validate($request, [
            'search' => 'required',
            'value' => 'required'
        ]);

        $parameter = $request->search;
        $query = $request->value;

        $categories = Categorie::where($parameter, 'LIKE', '%' . $query . '%')->get();
        
        if($categories->isEmpty()) {
            $request->session()->flash('flash_message_info', 'No hay resultados para la búsqueda realizada.');
            return back();
        }
        else {
            return view('categories.index', compact('categories'));
        }
        
    }
}
