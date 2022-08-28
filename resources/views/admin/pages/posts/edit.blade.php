@extends('admin.layouts.admin')


@section('main-admin')

@if(session('danger'))
<div class="alert alert-danger">
    {{session('danger')}}
</div>
@endif
<div class="card">
    <div class="card-header">
        Edit Post
    </div>
    <div class="card-body card-block">
        <form action="{{route('admin.post.update', $dataForm['id'])}}" method="post" enctype="multipart/form-data">
            @csrf  
            {{ method_field('PUT') }}  
            @include('admin.pages.posts._form', ['data_user' => $data_user, 'dataForm' => $dataForm])
        </form>
    </div>
</div>
@endsection