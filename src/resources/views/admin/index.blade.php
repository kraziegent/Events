@extends('core::admin.master')

@section('title', __('Events'))

@section('content')

<item-list
    url-base="/api/events"
    locale="{{ config('typicms.content_locale') }}"
    fields="id,image_id,start_date,end_date,status,title,paid,public"
    table="events"
    title="events"
    include="image"
    appends="thumb"
    :exportable="true"
    :searchable="['title']"
    :sorting="['-end_date']">

    <template slot="add-button" v-if="$can('create events')">
        @include('core::admin._button-create', ['module' => 'events'])
    </template>

    <template slot="columns" slot-scope="{ sortArray }">
        <item-list-column-header name="checkbox" v-if="$can('update events')||$can('delete events')"></item-list-column-header>
        <item-list-column-header name="edit" v-if="$can('update events')"></item-list-column-header>
        <item-list-column-header name="status_translated" sortable :sort-array="sortArray" :label="$t('Status')"></item-list-column-header>
        <item-list-column-header name="image" :label="$t('Image')"></item-list-column-header>
        <item-list-column-header name="title_translated" sortable :sort-array="sortArray" :label="$t('Title')"></item-list-column-header>
        <item-list-column-header name="paid_translated" sortable :sort-array="sortArray" :label="$t('Paid Event?')"></item-list-column-header>
        <item-list-column-header name="public_translated" sortable :sort-array="sortArray" :label="$t('Public Event?')"></item-list-column-header>
        <item-list-column-header name="start_date" sortable :sort-array="sortArray" :label="$t('Start date')"></item-list-column-header>
        <item-list-column-header name="end_date" sortable :sort-array="sortArray" :label="$t('End date')"></item-list-column-header>
    </template>

    <template slot="table-row" slot-scope="{ model, checkedModels, loading }">
        <td class="checkbox" v-if="$can('update events')||$can('delete events')"><item-list-checkbox :model="model" :checked-models-prop="checkedModels" :loading="loading"></item-list-checkbox></td>
        <td v-if="$can('update events')">@include('core::admin._button-edit', ['module' => 'events'])</td>
        <td><item-list-status-button :model="model"></item-list-status-button></td>
        <td><img :src="model.thumb" alt="" height="27"></td>
        <td>@{{ model.title_translated }}</td>
        <td>@{{ model.paid_translated == 1 ? "Yes" : "No" }}</td>
        <td>@{{ model.public_translated == 1 ? "Yes" : "No" }}</td>
        <td>@{{ model.start_date | date }}</td>
        <td>@{{ model.end_date | date }}</td>
    </template>

</item-list>

@endsection
