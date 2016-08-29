@extends('main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h2>Twitter Dashboard</h2>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Tweet to Your Twitter Account</div>
                    <div class="panel-body">
                        {{ Form::open(['route'=>'twitter.tweet']) }}
                        {{ Form::label('status', 'status') }}
                        {{ Form::text('status', null, ['class'=>'form-control']) }}
                        <br>
                        {{ Form::submit('TWEET', ['class'=>'btn btn-info']) }}
                        {{ Form::close() }}
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Send A Message with Your Twitter Account</div>
                    <div class="panel-body">
                        {{ Form::open(['route'=>'twitter.message']) }}
                        {{ Form::label('screen_name', 'screen name :') }}
                        {{ Form::text('screen_name', null, ['class'=>'form-control']) }}
                        {{ Form::label('text', 'Text :') }}
                        {{ Form::text('text', null, ['class'=>'form-control']) }}
                        <br>
                        {{ Form::submit('Send', ['class'=>'btn btn-info']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
