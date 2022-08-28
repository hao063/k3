@extends('admin.layouts.admin')


@section('main-admin')

@if(session('danger'))
<div class="alert alert-danger">
    {{session('danger')}}
</div>
@endif
<div class="card m-t-250 ">
    <h3 class="m-2">Thông tin chi tiết</h3>
    <img class="card-img-top p-4" src="{{$dataForm->img}}" style="width: 400px; object-fit: cover;" alt="Card image cap">
    <div class="card-body">
        <h4 class="card-title mb-3">{{$dataForm->title}}</h4>
        <h4 class="mb-3">Tác giả: {{$dataForm->user->name}}</h4>
        <p class="card-text">{{$dataForm->content}}
        </p>
    </div>
</div>
@endsection