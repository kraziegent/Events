{!! BootForm::hidden('id') !!}

<file-manager related-table="{{ $model->getTable() }}" :related-id="{{ $model->id ?? 0 }}"></file-manager>
<file-field type="image" field="image_id" :init-file="{{ $model->image ?? 'null' }}"></file-field>

{!! BootForm::text(__('Series'), 'series_id') !!}
<div class="row gx-3">

    <div class="col-md-6">

        {!! BootForm::text(__('Title'), 'title') !!}

    </div>

    <div class="col-md-6">

        <div class="mb-3 form-group-translation @if ($errors->has('slug'))has-error @endif">

            {!! Form::label('<span>'.__('Slug').'</span>')->addClass('form-label')->forId('slug') !!}
        
            <span></span>
        
            <div class="input-group">
        
                {!! Form::text('slug')->addClass('form-control')->addClass($errors->has('slug') ? 'is-invalid' : '')->id('slug')->data('slug', 'title')->data('language', 'en') !!}
        
                <button class="btn btn-outline-secondary btn-slug" type="button">{{ __('Generate') }}</button>
        
                {!! $errors->first('slug', '<div class="invalid-feedback">:message</div>') !!}
        
            </div>
        
        </div>

    </div>

</div>
<div class="mb-3">
    {!! BootForm::hidden('status')->value(0) !!}
    {!! BootForm::hidden('paid')->value(0) !!}
    {!! BootForm::hidden('public')->value(0) !!}
    {!! BootForm::hidden('registration')->value(0) !!}
    {!! BootForm::checkbox(__('Publish'), 'status') !!}
    {!! BootForm::checkbox(__('Paid Event'), 'paid')->addClass('paid')->attribute('id', 'paid') !!}
    {!! BootForm::checkbox(__('Is event available to the public?'), 'public')->attribute('id', 'public') !!}
    {!! BootForm::checkbox(__('Does Event require user registration'), 'registration')->attribute('id', 'registration') !!}
</div>

<div class="row gx-3">
    <div class="col-sm-6">
        {!! BootForm::date(__("Event Date"), 'start_date')->value(old('start_date') ? : $model->present()->dateOrNow('start_date'))->required() !!}
    </div>
    <div class="col-sm-3">
        <label for="start_time" class="form-label">Start's at</label>
        <input type="time" name="start_time" id="start_time" class="form-control" value="{{ old('start_time') ? : $model->present()->timeOrNow('start_date') }}">
    </div>
    <div class="col-sm-3">
        <label for="end_time" class="form-label">End's at</label>
        <input type="time" name="end_time" id="end_time" class="form-control" value="{{ old('end_time') ? : $model->present()->timeOrNow('end_date') }}">
    </div>
</div>

{!! BootForm::hidden('occurence')->value('once') !!}
{!! BootForm::select(__('Venue'), 'venue_id')->options($venues)->select(1) !!}
{!! BootForm::textarea(__('Address'), 'address')->rows(3) !!}
{!! BootForm::textarea(__('Summary'), 'summary')->rows(4) !!}
{!! BootForm::textarea(__('Body'), 'body')->addClass('ckeditor-full') !!}
