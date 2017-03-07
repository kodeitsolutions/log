<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Response;
use App\User;
use App\Entrie;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('name', 'asc')->get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function add()
    {
        return view('users.add');
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
            'name' => 'required|max:255',
            'password' => 'required|min:5|max:20',
            'email' => 'required|email|unique:users',
            'telephone' => 'required|numeric'
        ]);
        
        $user = new User($request->all());

        if($request->has('isAdmin')){
            $user->isAdmin = 1;
        }
        $user->password = bcrypt($request->password);

        $saved = $user->save();

        if ($saved) {
            $request->session()->flash('flash_message', 'Usuario creado.');
        }
        else {
            $request->session()->flash('flash_message_not', 'No se pudo crear el Usuario.');
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
        $user = User::find($id);
        if (is_null($user))
        {
            return Redirect::route('users.index');
        }
        return Response::json($user);
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
    public function update(Request $request, User $user)
    {
        //dd($request);
        $user->isAdmin = ($request->has('isAdmin')) ? 1 : 0 ;
        $saved = $user->update($request->all());

        if ($saved) {
            $request->session()->flash('flash_message', 'Usuario editado.');
        }
        else {
            $request->session()->flash('flash_message_not', 'No se pudo editar el Usuario.');
        }

        return redirect('user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        //dd($user);
        $entries = Entrie::where('user_id', $user->id)->get();

        $authenticated = Auth::id();
        if ($authenticated != $user->id and $entries->isEmpty()) {
            $deleted = $user->delete();

            if ($deleted) {
                $request->session()->flash('flash_message', 'Usuario eliminado.');
            }
            else {
                $request->session()->flash('flash_message_not', 'No se pudo eliminar el usuario.');
            }
        } 
        else {
            $request->session()->flash('flash_message_not', 'No se puede eliminar a sí mismo o a un usuario que tenga registros asociados.');
        }
        
        return redirect('user');

    }

    public function search()
    {
        return view('users.search');
    }

    public function searching(Request $request)
    {
        $this->validate($request, [
            'search' => 'required',
            'value' => 'required'
        ]);

        $parameter = $request->search;
        $query = $request->value;

        $users = User::where($parameter, 'LIKE', '%' . $query . '%')->get();
        
        if($users->isEmpty()) {
            $request->session()->flash('flash_message_info', 'No hay resultados para la búsqueda realizada.');
            return back();
        }
        else {
            return view('users.index', compact('users'));
        }
        
    }

    public function resetForm(User $user)
    {
        return view('users.reset', compact('user'));
    }

    public function updatePassword(Request $request, User $user)
    {
        //dd($request);
        $this->validate($request,[
            'password' => 'required|min:5|max:20|confirmed',
            'password_confirmation' => 'required'
        ]);

        $password = bcrypt($request->password);
        $user->password = $password;

        $saved = $user->save();

        if ($saved) {
            $request->session()->flash('flash_message', 'Contraseña modificada.');
        }
        else {
            $request->session()->flash('flash_message_not', 'No se pudo modificar la contraseña.');
        }

        return redirect('entry');
    }
}
