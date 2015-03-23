@extends('backend/template')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Changer votre mot de passe</div>
				<div class="panel-body">
					@if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{URL::to('password/reset')}}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="token" value="{{ $token }}">
						
						<div class="form-group">
							<label class="col-md-4 control-label">Email :</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="email">
							</div>
						</div>


						<div class="form-group">
							<label class="col-md-4 control-label">Nouveau mot de passe :</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirmer le mot de passe :</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
								    Valider
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
