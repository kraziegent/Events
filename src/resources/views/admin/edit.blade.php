@extends('events::admin.tabs')

@section('event')

    {!! BootForm::open()->put()->action(route('admin::update-event', $model->id))->multipart()->role('form')->attribute('id', 'form') !!}
    {!! BootForm::bind($model) !!}
        @include('events::admin._event')
    {!! BootForm::close() !!}

@endsection
