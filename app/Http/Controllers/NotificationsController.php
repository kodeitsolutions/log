<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Response;
use App\Notification;
use App\User;
use App\Operation;
use App\Categorie;
use App\Companie;
use App\Unit;
use App\Material;
use App\Entrie;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Notification::all(); 
        $operations = Operation::all();
        $categories = Categorie::all();
        $companies = Companie::all();
        $materials = Material::all();
        return view('notifications.index', compact('notifications','operations','categories','companies','materials'));
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
        $materials = Material::all();
        return view('notifications.add',compact('operations','categories','companies','materials'));
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
        $this->validate($request,[
            'recipient' => 'required',
            'moment' => 'required',
            'operation' => 'required',
            'category' => 'required',
            'company' => 'required'
        ]);

        if (substr_count($request->recipient, '@') > 1) {
            $flag = str_is('*,*',preg_replace('/\s+/','',$request->recipient));
        } else {
            $flag = true;
        }
        //dd($flag);
        if ($flag) {
            $conditions = $request->all();
            unset($conditions['_method'], $conditions['_token']);
            $conditions = json_encode($conditions);

            $data['user_id'] = Auth::id();
            $data['conditions'] = $conditions;

            $notification = new Notification($data);
            $saved = $notification->save();

            if ($saved) {
                $request->session()->flash('flash_message', 'Notificación guardada. En la brevedad posible se creará esta notificación.');
            }
            else {
                $request->session()->flash('flash_message_not', 'No se pudo guardar la Notificación.');
            }
            
            return redirect('/notification');
        } else {
            return back()->withInput($request->all)->with('flash_message_not', 'Los destinatarios deben estar separados por coma.');
        }     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notification = Notification::find($id);
        if (is_null($notification))
        {
            return redirect('/notification');
        }
        return Response::json($notification);
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
    public function update(Request $request, Notification $notification)
    {
        //
        //dd($request);
        $this->validate($request,[
            'recipient' => 'required',
            'moment' => 'required',
            'operation' => 'required',
            'category' => 'required',
            'company' => 'required'
        ]);

        $data = $request->all();
        $notification->status = $data['status'];
        unset($data['_method'], $data['_token'],$data['status']);
        $data = json_encode($data);

        $notification->conditions = $data;

        $saved = $notification->update();

        if ($saved) {
            $request->session()->flash('flash_message', 'Notificación modificada.');
        }
        else {
            $request->session()->flash('flash_message_not', 'No se pudo modificar la Notificación.');
        }

        return redirect('/notification');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Notification $notification)
    {
        $deleted = $notification->delete();
        if ($deleted) {
            $request->session()->flash('flash_message', 'Notificación eliminada.');
        }
        else{
            $request->session()->flash('flash_message_not', 'No se pudo eliminar la Notificación.');   
        }
        return back();
    }

    public function search()
    {
        $operations = Operation::all();
        $categories = Categorie::all();
        $companies = Companie::all();
        $units = Unit::orderBy('code')->get();
        $users = User::all();
        $materials = Material::all();
        return view('notifications.search',compact('operations','categories','companies','units','users','materials'));
    }

    public function searching(Request $request)
    {
        //dd($request);
        
        $notifications = Notification::when(($request->has('user_id')), function($query) use ($request){
                            return $query->where('user_id','=',$request->user_id);
                        })   
                        ->when(($request->has('moment')), function($query) use ($request){
                            return $query->where('conditions','LIKE','%"moment":[%"%'.$request->moment.'%"%]%');
                        })   
                        ->when(($request->has('operation')), function($query) use ($request){
                            return $query->where('conditions','LIKE','%"operation":[%"%'.$request->operation.'%"%]%');
                        })
                         ->when(($request->has('category')), function($query) use ($request){
                            return $query->where('conditions','LIKE','%"category":[%"%'.$request->category.'%"%]%');
                        })
                         ->when(($request->has('company')), function($query) use ($request){
                            return $query->where('conditions','LIKE','%"company":[%"%'.$request->company.'%"%]%');
                        })
                         ->when(($request->has('material')), function($query) use ($request){
                            return $query->where('conditions','LIKE','%"material":[%"%'.$request->material.'%"%]%');
                        })          
                        ->get();
                
        if($notifications->isEmpty()) {
            return back()->with('flash_message_info', 'No hay resultados para la búsqueda realizada.');
        }
        else {
            $operations = Operation::all();
            $categories = Categorie::all();
            $companies = Companie::all();
            $materials = Material::all();
            return view('notifications.index', compact('notifications','operations','categories','companies','materials'));
        }
        
    }
}
