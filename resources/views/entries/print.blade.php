<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--meta name="csrf-token" content="{{ csrf_token() }}"-->

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
        <!--link rel="stylesheet" type="text/css" href="/css/print.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script-->
        
        <style type="text/css">
            h4 {
                color: #5F9EA0;
                font-family: Tahoma, Geneva, sans-serif;
            }

            h5,h2 {
                font-family: Tahoma, Geneva, sans-serif;
            }

            div.border {
                width: 700px;
                border:1px solid gray;
                border-radius: 2px;
            }

            p {
                margin-left: 20px;
                font-family: Tahoma, Geneva, sans-serif;
                font-size: 11px;
            }

            li {
                font-family: Tahoma, Geneva, sans-serif;
                font-size: 11px;
            }            
        </style>
        
        <h2 align="center"> Listado de registros</h2>
    </head>
    <body>
        <div class="container col-md-10">
            @foreach($entries as $entry)
                <div class="border">
                    <h4>Registro N° {{ $entry->id }}</h4>
                    <p>
                        <strong>Fecha:</strong> {{ $entry->date->format('d/m/Y') }}
                        <br><strong>Hora:</strong> {{ $entry->time }}
                        <br><strong>Usuario:</strong> {{ $entry->user->name }}</p>
                    </p>
                </div>

                <h5><u>Datos del movimiento</u></h5>
                <ul>
                    <li><strong>Movimiento: </strong>{{ $entry->operation->name }}</li>
                    <li><strong>Categoría: </strong>{{ $entry->category->name }}</li>
                    <li><strong>Empresa: </strong>{{ $entry->company->name }}</li>
                    <li><strong>Destino / Origen: </strong>{{ $entry->destination }}</li>
                </ul>

                @if( $entry->category->name == 'Persona' or $entry->category->name == 'Persona-Material')
                    <h5><u>Datos de la persona</u></h5>
                    <ul>
                        <li><strong>Nombre: </strong>{{ $entry->person_name }}</li>
                        <li><strong>Cédula: </strong>{{ $entry->person_id }}</li>
                        <li><strong>Ocupación: </strong>{{ $entry->person_occupation }}</li>
                        <li><strong>Empresa: </strong>{{ $entry->person_company }}</li>
                    </ul>           
                @endif 

                @if( $entry->category->name == 'Material' or $entry->category->name == 'Persona-Material')
                    <h5><u>Datos del material</u></h5>
                    <ul>
                        <li><strong>Material: </strong>{{ $entry->material_type }}</li>
                        <li><strong>Cantidad: </strong>{{ $entry->material_quantity }}</li>
                        <li><strong>Unidad: </strong>{{ $entry->unit->code }}</li>
                        <li><strong>Observaciones: </strong>{{ $entry->observation }}</li>
                    </ul>
                @endif  

                <h5><u>Datos del vehículo</u></h5>
                <ul>
                    <li><strong>Vehículo: </strong>{{ $entry->vehicle }}</li>
                    <li><strong>Placa: </strong>{{ $entry->vehicle_plate }}</li>
                    <li><strong>Nombre del Chofer: </strong>{{ $entry->driver_name }}</li>
                    <li><strong>Cédula del Chofer: </strong>{{ $entry->driver_id }}</li>
                </ul>       
                
                <br><br>
            @endforeach
        </div>
               
    </body>
</html>