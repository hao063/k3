@extends('admin.layouts.admin')


@section('main-admin')

@if(session('danger'))
<div class="alert alert-danger">
    {{session('danger')}}
</div>
@endif
<div class="card">
    <div class="card-header">
        Create User
    </div>
    <div class="card-body card-block">
        <form action="{{route('admin.user.store')}}" method="post">
            @csrf   
            @include('admin.pages.users._form', ['data_role' => $data_role])
        </form>
    </div>
</div>
@endsection