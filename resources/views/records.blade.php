@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 pt-5">
            <div class="text-center">
                <h1>List of all records!</h1>
            </div>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Phone number</th>
                    <th scope="col">Record created</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($records as $record)
                    <tr>
                        <th scope="row">{{ $record->id }}</th>
                        <td>{{ $record->phone_number }}</td>
                        <td> {{ $record->created_at }}</td>
                        <td><a class="btn btn-primary" role="button" href="{{ Route('record.item', ['record' => $record->id]) }}">Show details</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop
