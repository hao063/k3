@extends('admin.layouts.admin')


@section('main-admin')

@if(session('danger'))
<div class="alert alert-danger">
    {{session('danger')}}
</div>
@endif
<div class="card">
    <div class="card-header">
        Edit User
    </div>
    <div class="card-body card-block">
        <form action="{{route('admin.user.update', $dataForm['id'])}}" method="post">
            @csrf
            {{ method_field('PUT') }}  
            @include('admin.pages.users._form', ['data_role' => $data_role, 'dataForm' => $dataForm])
        </form>
    </div>
</div>
@endsection