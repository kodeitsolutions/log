<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        @if(PHP_OS == 'WINNT')
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        @else
            <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/bootstrap.css') }}">
        @endif
        
        <h3 class="text-info" align="center">LISTADO DE REGISTROS</h3>
    </head>

    <style type="text/css">
        thead { display: table-header-group }
        tr { page-break-inside: avoid }
    </style>

    <body>        
        <table class="table" border="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Mov.</th>
                    <th>Categoría</th>
                    <th>Empresa</th>
                    <th>Destino / Origen</th>
                    <th>Persona</th>
                    <th>Material</th>
                    <th>Vehículo</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($entries as $index => $entry)
                    <tr>
                        <td valign="top">{{ $index + 1 }}</td>
                        <td valign="top">{{ $entry->date->format('d/m/Y')}}</td>
                        <td valign="top">{{ date("g:i a", strtotime($entry->time)) }}</td>
                        <td valign="top">{{ $entry->operation->name }}</td>
                        <td valign="top">{{ $entry->category->name }}</td>
                        <td valign="top">{{ $entry->company->name }}</td>
                        <td valign="top">{{ $entry->destination }}</td>                     
                        @if( $entry->category->person == 1 or $entry->category->combined == 1)
                            <td valign="top">
                                Nombre: {{ $entry->person_name }}.<br>
                                C.I: {{ $entry->person_id}}.<br>
                                Empresa: {{ $entry->person_company }}.<br>
                                Ocupación: {{ $entry->person_occupation}}.
                            </td>
                        @else
                            <td valign="top">-</td>
                        @endif
                        @if( $entry->category->material == 1 or $entry->category->combined == 1)
                            <td valign="top">
                                Descripción: {{ $entry->material_type }}.<br>
                                Tipo de material: {{ $entry->material->name }}.<br>
                                Cantidad: {{ $entry->material_quantity }} {{ $entry->unit->code }}.<br>
                            </td> 
                        @else
                            <td valign="top">-</td>                          
                        @endif
                        <td valign="top">
                            Descripción: {{ $entry->vehicle }}.<br>
                            Placa: {{ $entry->vehicle_plate }}.<br>
                            Chofer: {{ $entry->driver_name }}.<br>
                            C.I: {{$entry->driver_id }}.
                        </td>                   
                        <td valign="top">
                            @if(!empty($entry->person_observations))
                                Persona: {{ $entry->person_observations }}.<br>
                            @endif
                            @if(!empty($entry->material_observations))
                                Material: {{ $entry->material_observations }}.<br>
                            @endif
                            @if(!empty($entry->vehicle_observations))
                                Vehículo: {{ $entry->vehicle_observations }}.<br>
                            @endif
                        </td>                        
                    </tr>
                @endforeach             
            </tbody>       
        </table>               
    </body>
</html>