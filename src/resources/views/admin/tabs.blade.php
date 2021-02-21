@extends('core::admin.master')

@if ($model->id)
    @section('title', $model->title)
@else
    @section('title', __('New event'))
@endif

@section('content')

    <div class="header">
        @include('core::admin._button-back', ['module' => 'events'])
        <h1 class="header-title @if (!$model->title)text-muted @endif">
            @if ($model->id)
                {{ $model->title ?: __('Untitled') }}
            @else
                @lang('New event')
            @endif
        </h1>
    </div>

    <div class="btn-toolbar mb-4">
        <button class="btn btn-sm btn-primary me-2" value="true" id="exit" name="exit" type="submit" form="form">{{ __('Save and exit') }}</button>
        <button class="btn btn-sm btn-light me-2" type="submit" form="form">{{ __('Save') }}</button>
        {{-- @if ($model->getTable() == 'pages' || Route::has($locale.'::'.Str::singular($model->getTable())))
            <a class="btn btn-sm btn-light btn-preview me-2" href="{{ $model->previewUri() }}?preview=true">{{ __('Preview') }}</a>
        @endif
        @include('core::admin._lang-switcher-for-form') --}}
    </div>

    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="#tab-event" data-bs-toggle="tab">{{ __('Event') }}</a>
        </li>
        <li class="nav-item tickets" style="display: none">
            <a class="nav-link" href="#tab-tickets" data-bs-toggle="tab">{{ __('Tickets') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#tab-contacts" data-bs-toggle="tab">{{ __('Contacts') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#tab-resources" data-bs-toggle="tab">{{ __('Resources') }}</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#tab-attendees" data-bs-toggle="tab">{{ __('Attendees') }}</a>
        </li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade show active" id="tab-event">
            @yield('event')
        </div>
        <div class="tab-pane fade tickets" id="tab-tickets" style="display: none">
            @yield('tickets')
        </div>
        <div class="tab-pane fade" id="tab-contacts">
            @yield('contacts')
        </div>
        <div class="tab-pane fade" id="tab-resources">
            @yield('resources')
        </div>
        <div class="tab-pane fade" id="tab-attendees">
            @yield('attendees')
        </div>
    </div>

@endsection


@push('js')
    <script src="{{ asset('components/ckeditor4/ckeditor.js') }}"></script>
    <script src="{{ asset('components/ckeditor4/config-full.js') }}"></script>

    <script>
        $(function(){

            if($("#paid").prop('checked')) {
                $(".tickets").show("fast")
            }

            if($("#public").prop('checked')) {
                $("#registration").show("fast")
            }

            $(".paid").on( "click", function() {
                $( ".tickets" ).toggle()
            });

            $("#public").on( "click", function() {
                $( "#registration" ).toggle()
            });

        });
    </script>
@endpush
