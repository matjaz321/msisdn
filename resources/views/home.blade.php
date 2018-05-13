@extends('layouts.app')

@section('content')
    <div class="py-5 text-center">
        <h2>Check your number</h2>
        <p class="lead">
            MSISDN is a number uniquely identifying a subscription in a GSM or a UMTS mobile network. Simply put, it is the mapping of the telephone number to the SIM card in a mobile/cellular phone. This abbreviation has a several interpretations, the most common one being "Mobile Station International Subscriber Directory Number".
        </p>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-md-12 col-md-center">
            <form action="{{ Route('number.validate') }}" class="needs-validation" novalidate="" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <h4 class="mb-3">Check your number</h4>
                <div class="row">
                    <div class="col-md-6 mb-3 @if ($errors->has('number')) has-error has-feedback @endif">
                        <label for="number">Telephone number</label>
                        <input type="text" name="number" id="number" class="form-control" placeholder="+38631521234" required="required">
                        <small class="text-muted">Please insert your telephone number</small>
                        @if ($errors->has('number'))
                            <small class="error">{{ $errors->first('number') }}</small>
                        @endif

                    </div>
                </div>
                <hr class="mb-4">
                <button class="btn btn-primary btn-lg btn-block" type="submit">Check my number</button>
            </form>
        </div>
    </div>
@stop
