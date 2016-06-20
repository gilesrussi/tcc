@extends('home.layout')

@section('inner-content')
    <div class="panel panel-default">
        <div class="panel-heading">Atualize seu perfil</div>
        <div class="panel-body">
            {{ Form::model(Auth::user(), array('action' => array('ProfileController@update'), 'files' => true, 'class' => "form-horizontal", 'method' => 'PUT')) }}

                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">Nome</label>

                    <div class="col-md-6">
                        {{ Form::text('name', null, array("class" => "form-control")) }}

                        @if ($errors->has('name'))
                            <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label class="col-md-4 control-label">E-Mail</label>

                    <div class="col-md-6">
                        {{ Form::text('email', null, array("class" => "form-control")) }}

                        @if ($errors->has('email'))
                            <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Avatar</label>
                    <div class="col-md-6">
                        {{ Form::file('avatar') }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Atualizar
                        </button>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>

@endsection
