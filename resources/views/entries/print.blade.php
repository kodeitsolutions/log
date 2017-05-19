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
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Movimiento</th>
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
                @foreach($entries as $index => $entrie)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $entrie->date->format('d/m/Y')}}</td>
                        <td>{{ $entrie->time }}</td>
                        <td>{{ $entrie->operation->name }}</td>
                        <td>{{ $entrie->category->name }}</td>
                        <td>{{ $entrie->company->name }}</td>
                        <td>{{ $entrie->destination }}</td>                     
                        @if( $entrie->category->person == 1 )
                            <td>Nombre: {{ $entrie->person_name }}.<br>
                            C.I: {{ $entrie->person_id}}.<br>
                            Empresa: {{ $entrie->person_company }}.<br>
                            Ocupación: {{ $entrie->person_occupation}}.
                            </td>
                        @else
                            <td>-</td>
                        @endif
                        @if( $entrie->category->material == 1)
                            <td>Descripción: {{ $entrie->material_type }}.<br>
                            Cantidad: {{ $entrie->material_quantity }} {{ $entrie->unit->code }}.<br>
                            </td> 
                        @else
                            <td>-</td>                          
                        @endif
                        <td>Descripción: {{ $entrie->vehicle }}.<br>
                        Placa: {{ $entrie->vehicle_plate }}.<br>
                        Chofer: {{ $entrie->driver_name }}.<br>
                        C.I: {{$entrie->driver_id }}.
                        </td>
                        @if( $entrie->category->combined == 1)
                            <td>Persona: {{ $entrie->person_name }}. <br>
                            Material: {{ $entrie->material_type }}</td>
                        @endif                      
                        <td>
                            @if( $entrie->person_observations != '')
                                Persona: {{ $entrie->person_observations }}.<br>
                            @endif
                            @if($entrie->material_observations != '')
                                Material: {{ $entrie->material_observations }}.<br>
                            @endif
                            @if($entrie->vehicle_observations != '')
                                Vehículo: {{ $entrie->vehicle_observations }}.<br>
                            @endif
                        </td>
                    </tr>
                @endforeach             
            </tbody>            
        </table>
               
    </body>
</html>