@extends('layout')

@section('login')
	<div class="container">
		<div class="row">				
	        <div class="col-md-6 col-md-offset-2">
	        	<div class="panel panel-default">
	                <div class="panel-heading">Escoger turno</div>
		                <div class="panel-body">
		                	<form class="form-horizontal" role="form" method="POST" action="/shift/choose">
		                		{{ method_field('PATCH') }}
		                        {{ csrf_field() }}
								@foreach($shifts as $shift)
									<div class="radio">
										<label><input type="radio" value="{{$shift->id}}" name="shift">{{$shift->description}}</label>
									</div>
								@endforeach

								<div class="form-group">
		                            <div class="col-md-12" align="right">
		                                <button type="submit" class="btn btn-primary">
		                                    Ingresar
		                                </button>
		                            </div>
		                        </div>
							</form>
						</div>
					</div>
				</div>	
			</div>
		</div>
	</div>
@endsection