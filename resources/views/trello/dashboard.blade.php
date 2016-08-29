@extends('main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h2>Trello Dashboard</h2>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Create a Trello List</div>
                    <div class="panel-body">
                        {{ Form::open(['route'=>'trello.list']) }}
                        {{ Form::label('name', 'name') }}
                        {{ Form::text('name', null, ['class'=>'form-control']) }}
                        {{ Form::label('idBoard ', 'id of the board that the list should be added to :') }}
                        {{ Form::text('idBoard', null, ['class'=>'form-control']) }}
                        <br>
                        {{ Form::submit('Create List', ['class'=>'btn btn-info']) }}
                        {{ Form::close() }}
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Add Card To A list </div>
                    <div class="panel-body">
                        {{ Form::open(['route'=>'trello.card']) }}
                        {{ Form::label('name', 'Card name :') }}
                        {{ Form::text('name', null, ['class'=>'form-control']) }}

                        {{ Form::label('due', 'Date :') }}
                        {{ Form::text('due', null, ['class'=>'form-control']) }}

                        {{ Form::label('idList', 'id of the list that the card should be added to :') }}
                        {{ Form::text('idList', null, ['class'=>'form-control']) }}
                        <br>
                        {{ Form::submit('Create Card', ['class'=>'btn btn-info']) }}
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
