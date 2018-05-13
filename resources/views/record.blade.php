@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12 pt-5">
            <div class="text-center">
                <h1>Phone number: {{ $phone_number }}</h1>
            </div>
            <div class="card text-center">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs phone-actions">
                        <li class="nav-item">
                            <a class="nav-link active" href="#mno">MNO</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#country_dialing_code">Country dialing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#subscriber_number">Subscriber number</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#country_code">Country code</a>
                        </li>
                    </ul>
                </div>
                @foreach($data as $name => $value)
                    <div class="card-body @if ($value != reset($data))hidden @endif" id="{{ $name }}">
                        <h5 class="card-title">{{ $value }}</h5>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@stop
