@component('mail::message')
# Nuevo registro

Se ha creado un nuevo registro en ReMo.

Fecha: {{ $entry->date->format('d/m/Y')}}  
Hora: {{ date("g:i a", strtotime($entry->time)) }}  
Tipo de movimiento: {{ $entry->operation->name }}.  
Categoría: {{ $entry->category->name }}.  
Empresa: {{ $entry->company->name }}.  
Destino / Origen: {{ $entry->destination }}.  

@if( $entry->category->person == 1 or $entry->category->combined == 1)
**Datos de la persona**  	
Nombre: {{ $entry->person_name }}.  
C.I: {{ $entry->person_id}}.  
Empresa: {{ $entry->person_company }}.  
Ocupación: {{ $entry->person_occupation}}.  
@if(!empty($entry->person_observations))
Observaciones: {{ $entry->person_observations }}.  
@endif
@endif

@if( $entry->category->material == 1 or $entry->category->combined == 1)
**Datos del material**  
Descripción: {{ $entry->material_type }}.  
Tipo de material: {{ $entry->material->name }}.  
Cantidad: {{ $entry->material_quantity }} {{ $entry->unit->code }}.  
@if(!empty($entry->material_observations))
Observaciones: {{ $entry->material_observations }}.  
@endif
@endif	

@if( $entry->category->vehicle == 1 and !empty($entry->vehicle))
**Datos del vehículo**   
Descripción: {{ $entry->vehicle }}.  
Placa: {{ $entry->vehicle_plate }}.  
Chofer: {{ $entry->driver_name }}.  
C.I: {{$entry->driver_id }}.  
@if(!empty($entry->vehicle_observations))
Observaciones: {{ $entry->vehicle_observations }}.  
@endif 
@endif 

@component('mail::button', ['url' => ''])
Ir a ReMo
@endcomponent

Gracias,  
{{ config('app.name') }}
@endcomponent
