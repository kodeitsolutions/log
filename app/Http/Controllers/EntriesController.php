<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use PDF;
use Response;
use Mail;
use App\User;
use App\Entrie;
use App\Operation;
use App\Categorie;
use App\Companie;
use App\Unit;
use App\Material;
use App\Notification;
use App\Shift;
use App\Worker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Jobs\SendEmail;
use App\Mail\EntryCreatedMD;
use App\Mail\DailyEntries;

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
        $entries = Entrie::with('operation','category','company','unit','material')->whereDate('date', '=', date('Y-m-d'))->orderBy('time')->paginate(20);
        Session::put('entries', $entries);
        return view('entries.index', compact('entries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        //
        $user = Auth::user();

        if (!$user->validateShift()){        
            $request->session()->flash('flash_message_not', 'No se puede editar el registro, está fuera de su turno. Debe salir del sistema y volver a entrar para escoger el nuevo turno');   
            return back();
        }    
        
        $operations = Operation::all();
        $categories = Categorie::all();
        $companies = Companie::all();
        $units = Unit::orderBy('code')->get();
        $materials = Material::all();

        $entry = new Entrie();
        return view('entries.add', compact('entry','operations','categories','companies','units','materials'))->with("route","add");
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
            'date' => 'required',  
            'time' => 'required',
            'person_name' => 'required_if:categorie_id,1,3', 
            'person_id' => 'required_if:categorie_id,1,3',
            'person_occupation' => 'required_if:categorie_id,1,3', 
            'person_company' => 'required_if:categorie_id,1,3', 
            'material_type' => 'required_if:categorie_id,2,3',
            'material_id' => 'required_if:categorie_id,2,3',
            'material_quantity' => 'required_if:categorie_id,2,3',
            'unit_id' => 'required_if:categorie_id,2,3',

        ]);      

        $user = Auth::user();

        if (!$user->validateShift()){        
            $request->session()->flash('flash_message_not', 'No se puede editar el registro, está fuera de su turno. Debe salir del sistema y volver a entrar para escoger el nuevo turno');   
            return back();
        }       

        $data = $request->all();
        $data['date'] = date('Y-m-d', strtotime(str_replace('/', '-', $request->date)));
        $data['time'] = date("H:i", strtotime($request->time));

        $entrie = new Entrie($data);   

        $entrie->material_id = (empty($request->material_id)) ? 0 : $request->material_id;
        $entrie->material_quantity = (empty($request->material_quantity)) ? 0 : $request->material_quantity ;  

        $entrie->user_id = $user->id;       
        //dd($entrie);
        $saved = $entrie->save();
        if ($saved) {
            $request->session()->flash('flash_message', 'Registro creado.');
            $this->notifications($entrie);
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
            return redirect('/entry');;
        }
        return Response::json($entry);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Entrie $entry)
    {
        //dd($entry);
        $user = Auth::user();

        if (!$user->validateShift()){        
            $request->session()->flash('flash_message_not', 'No se puede editar el registro, está fuera de su turno. Debe salir del sistema y volver a entrar para escoger el nuevo turno');   
            return back();
        }  

        $users = User::all();
        $operations = Operation::all();
        $categories = Categorie::all();
        $companies = Companie::all();
        $units = Unit::all();
        $materials = Material::all();
        return view('entries.add', compact('entry','operations','categories','companies','units','users','materials'))->with("route","edit");
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
        $this->validate($request, [
            'destination' => 'required|max:255', 
            'date' => 'required',  
            'time' => 'required',
            'person_name' => 'required_if:categorie_id,1,3', 
            'person_id' => 'required_if:categorie_id,1,3',
            'person_occupation' => 'required_if:categorie_id,1,3', 
            'person_company' => 'required_if:categorie_id,1,3', 
            'material_type' => 'required_if:categorie_id,2,3',
            'material_id' => 'required_if:categorie_id,2,3',
            'material_quantity' => 'required_if:categorie_id,2,3',
            'unit_id' => 'required_if:categorie_id,2,3',

        ]);

        $data = $request->all();
        $data['date'] = $entry->getFormatDate($request->date);
        $data['time'] = date("H:i", strtotime($request->time));

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
        $user = Auth::user();

        if (!$user->validateShift()){        
            $request->session()->flash('flash_message_not', 'No se puede eliminar el registro, está fuera de su turno. Debe salir del sistema y volver a entrar para escoger el nuevo turno');   
            return back();
        }  

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
        $materials = Material::all();
        return view('entries.search',compact('operations','categories','companies','units','users','materials'));
    }

    public function searching(Request $request)
    {
        //dd($request);
        $input = $request->all();

        $conditions = [['date', '>=',date('Y-m-d', strtotime(str_replace('/', '-', $request->date_from)))],
                       ['date', '<=',date('Y-m-d', strtotime(str_replace('/', '-', $request->date_to)))]];

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
        if($request->has('material_id')){
            array_push($conditions, ['material_id','=',$request->material_id]);
        }
        
        $entries = Entrie::with('operation','category','company','unit','material')->where($conditions)->orderBy('date')->orderBy('time')->paginate(20);

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
    
    public function printPDF($date)
    {
        # code...        
        $entries = Session::get('entries');        
        //return view('entries.print', compact('entries'));
        
        if ($entries->isEmpty()) {            
            Session::flash('flash_message_info', 'No hay datos para imprimir.');
            return back();
        } else {
            $pdf = PDF::loadView('entries.print', compact('entries'));
            return $pdf->inline('ListadoRegistros-'.$date.'.pdf');

            Session::forget('entries');
        }     
        
    }

    public function sendMail(Request $request)
    {
        $entries = Session::get('entries');
        $today = date('d/m/Y');

        if ($entries->isEmpty()) {            
            Session::flash('flash_message_info', 'No hay datos para enviar.');
            return back();
        } else {
            $data = array(
                'email' => $request->email,
                'subject' => 'ListadoRegistros-'.$today.'.pdf',
                'entries' => $entries                
            );
            
            Mail::send('entries.print', $data, function ($message) use ($data){       

                $message->to($data['email'])->subject($data['subject']);

            });

            Session::flash('flash_message', 'Email enviado.');
            return back();
            Session::forget('entries');
        }       
    }

    public function notifications(Entrie $entry)
    {
        $notifications = Notification::where('status','A')
                        ->where('conditions','LIKE','%"moment":[%"%store%"%]%')
                        ->where('conditions','LIKE','%"operation":[%"%'.$entry->operation_id.'%"%]%')
                        ->where('conditions','LIKE','%"category":[%"%'.$entry->categorie_id.'%"%]%')
                        ->where('conditions','LIKE','%"company":[%"%'.$entry->companie_id.'%"%]%')
                        ->when(($entry->category->material or $entry->category->combined), function($query) use ($entry){
                            return $query->where('conditions','LIKE','%"material":[%"%'.$entry->material_id.'%"%]%');
                        })                
                        ->get();

        if(!$notifications->isEmpty())
        {
            foreach ($notifications as $notification) {   
                $entryConditions = [];         
                $conditions = json_decode($notification->conditions, true);
                $recipients = explode(',', $conditions['recipient']); 

                //Mail::to($recipients)->queue(new EntryCreatedMD($entry));  
                Mail::to($recipients)->send(new EntryCreatedMD($entry));                     
            }    
        }            
    }

    public function duplicate(Entrie $entry)
    {       
        $users = User::all();
        $operations = Operation::all();
        $categories = Categorie::all();
        $companies = Companie::all();
        $units = Unit::all();
        $materials = Material::all();
        return view('entries.add', compact('entry','operations','categories','companies','units','users','materials'))->with("route","duplicate");
    }

    public function worker()
    {
        # code...
        $workers = Worker::where('status','A')->get();
        return view('entries.workers', compact('workers'));
    }

    public function entryWorker(Request $request,$operation,$id)
    {
        # code...
        $worker = Worker::find($id);
        $entry = new Entrie();

        $data['operation_id'] = $operation;
        $data['categorie_id'] = 1;
        $data['companie_id'] = $worker->companie_id;
        $data['destination'] = $worker->department;
        $data['time'] = $request->time;
        $data['date'] = date('d/m/Y');
        $data['person_name'] = $worker->name;
        $data['person_id'] = $worker->worker_id;
        $data['person_occupation'] = $worker->position;
        $data['person_company'] = $worker->company->name;
        $data['person_observations'] = ($operation == 1) ? 'Comienzo jornada laboral' : 'Fin jornada laboral';

        $request->merge($data);
        //dd($request);
        $this->store($request);

        return back();
    }
}
