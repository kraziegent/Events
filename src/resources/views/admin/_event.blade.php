{!! BootForm::hidden('id') !!}

<file-manager related-table="{{ $model->getTable() }}" :related-id="{{ $model->id ?? 0 }}"></file-manager>
<file-field type="image" field="image_id" :init-file="{{ $model->image ?? 'null' }}"></file-field>

{!! BootForm::text(__('Series'), 'series_id') !!}
@include('core::form._title-and-slug')
<div class="mb-3">
    {!! TranslatableBootForm::hidden('status')->value(0) !!}
    {!! TranslatableBootForm::hidden('paid')->value(0) !!}
    {!! TranslatableBootForm::hidden('public')->value(0) !!}
    {!! TranslatableBootForm::checkbox(__('Published'), 'status') !!}
    {!! BootForm::checkbox(__('Paid Event'), 'paid')->addClass('paid')->attribute('id', 'paid') !!}
    {!! TranslatableBootForm::checkbox(__('Is event available to the public?'), 'public') !!}
</div>

<div class="row gx-3">
    <div class="col-sm-6">
        {!! BootForm::date(__('Start date'), 'start_date')->value(old('start_date') ? : $model->present()->dateOrNow('start_date'))->required() !!}
        {{-- <input type="number" id="start_time_h" name="start_time" min="1" max="24">
        <input type="number" id="start_time_m" name="start_time_m" min="1" max="60"> --}}
    </div>
    <div class="col-sm-6">
        {!! BootForm::date(__('End date'), 'end_date')->value(old('end_date') ? : $model->present()->dateOrNow('end_date'))->required() !!}
        {{-- <input type="number" id="end_time_h" name="end_time_h" min="1" max="24">
        <input type="number" id="end_time_m" name="end_time_m" min="1" max="60"> --}}
    </div>
</div>

{!! TranslatableBootForm::hidden('occurence')->value('once') !!}
{!! TranslatableBootForm::text(__('Restriction'), 'restriction') !!}
{!! TranslatableBootForm::select(__('Venue'), 'venue')->options($venues)->select(2) !!}
{!! TranslatableBootForm::textarea(__('Address'), 'address')->rows(3) !!}
{{-- {!! TranslatableBootForm::text(__('Website'), 'website')->type('url')->placeholder('https://') !!} --}}
{!! TranslatableBootForm::textarea(__('Summary'), 'summary')->rows(4) !!}
{!! TranslatableBootForm::textarea(__('Body'), 'body')->addClass('ckeditor-full') !!}
