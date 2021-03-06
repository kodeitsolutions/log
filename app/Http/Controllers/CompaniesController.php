<?php

namespace App\Http\Controllers;

use Auth;
use Response;
use App\User;
use App\Companie;
use App\Entrie;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $companies = Companie::all();
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        //
        return view('companies.add');
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
            'name' => 'required|max:255|unique:companies'
        ]);
        
        $company = new Companie($request->all());
        $company->user_id = Auth::id();
        $saved = $company->save();

        if ($saved) {
            $request->session()->flash('flash_message', 'Empresa '.$company->name.' creada.');
        }
        else {
            $request->session()->flash('flash_message_not', 'No se pudo crear la empresa.');
        }
        
        return redirect('/company');
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
        $company = Companie::find($id);
        if (is_null($company))
        {
            return redirect('/company');
        }
        return Response::json($company);
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
     * @param  App\Companie  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Companie $company)
    {
        //dd($request, $companie);
        $this->validate($request, [
            'name' => ['required','max:255',Rule::unique('companies')->ignore($company->id)]
        ]);

        $saved = $company->update($request->all());

        if ($saved) {
            $request->session()->flash('flash_message', 'Empresa '.$company->name.' modificada.');
        }
        else {
            $request->session()->flash('flash_message_not', 'No se pudo modificar la Empresa.');
        }

        return redirect('/company');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Companie  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Companie $company)
    {
        //
        $entries = Entrie::where('companie_id','=',$company->id)->get();
        
        if ($entries->isEmpty()) {
            $deleted = $company->delete();
            if ($deleted) {
                $request->session()->flash('flash_message', 'Empresa '.$company->name.' eliminada.');
            }
            else{
                $request->session()->flash('flash_message_not', 'No se pudo eliminar la Empresa.');   
            }
        } else {
            $request->session()->flash('flash_message_not', 'No se pudo eliminar la Empresa ya que existen registros asociados a esta.');
        }        

        return redirect('/company');
    }

    /**
     * Show the form for searching.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        return view('companies.search');
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

        $companies = Companie::where($parameter, 'LIKE', '%' . $query . '%')->get();
        
        if($companies->isEmpty()) {
            return back()->with('flash_message_info', 'No hay resultados para la búsqueda realizada.');
        }
        else {
            return view('companies.index', compact('companies'));
        }
        
    }
}
