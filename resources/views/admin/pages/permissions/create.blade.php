@extends('admin.layouts.admin')


@section('main-admin')

@if(session('danger'))
<div class="alert alert-danger">
    {{session('danger')}}
</div>
@endif

<div class="card">
    <div class="card-header">
        Create Permission
    </div>
    <div class="card-body card-block">
        <form action="{{route('admin.permission.store')}}" method="post">
            @csrf   
            @include('admin.pages.permissions._form')
        </form>
    </div>
</div>
@endsection