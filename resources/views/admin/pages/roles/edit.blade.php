@extends('admin.layouts.admin')


@section('main-admin')

@if(session('danger'))
<div class="alert alert-danger">
    {{session('danger')}}
</div>
@endif
<div class="card">
    <div class="card-header">
        Create Role
    </div>
    <div class="card-body card-block">
        <form action="{{route('admin.role.update', $dataForm['id'])}}" method="post">
            @csrf   
            {{ method_field('PUT') }}  
            @include('admin.pages.roles._form', ['data_permission' => $data_permission])
        </form>
    </div>
</div>
@endsection