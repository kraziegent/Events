@extends('events::admin.tabs')

@section('event')

    {!! BootForm::open()->action(route('admin::index-events'))->multipart()->role('form')->attribute('id', 'form') !!}
        @include('events::admin._event')
    {!! BootForm::close() !!}

@endsection
