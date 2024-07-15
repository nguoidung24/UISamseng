@extends('templates.tpl_default')
@section('content')
    <div class="ps-2 lg:ps-10"><a href="{{route('categorys')}}">⬅️ Quay lại</a></div>
    @if ($isCreate)
        @include('Components.edit_category.create')
    @else
        @include('Components.edit_category.edit')
    @endif
@endsection
