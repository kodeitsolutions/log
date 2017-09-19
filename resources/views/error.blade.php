<html>
    <head>
        <title>Error</title>
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/bootstrap.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/custom.css') }}"> 
        <style>
            html, body {
                height: 100%;
            }           
        </style>
    </head>
    <body class="error">
        <div class="container error">
            <div class="content">
                <div class="title">Lo sentimos. Ha ocurrido un error.</div>
                <a href="{{ URL::previous() }}" class="btn btn-default" role="button"><span class="glyphicon glyphicon-arrow-left"></span>  Regresar</a>
            </div>
        </div>
    </body>
</html>