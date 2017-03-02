@extends('layout')

@section('login')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
            
                <form class="form-horizontal" role="form" method="POST" action="/user/reset">
                    {{ csrf_field() }}
                    

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Contraseña:</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required autofocus>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password-confirm" class="col-md-4 control-label">Confirmar Contraseña:</label>
                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4" align="right">
                            <button type="submit" class="btn btn-primary">Restablecer</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection