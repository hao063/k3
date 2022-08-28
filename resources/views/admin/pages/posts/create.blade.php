@extends('admin.layouts.admin')


@section('main-admin')

@if(session('danger'))
<div class="alert alert-danger">
    {{session('danger')}}
</div>
@endif
<div class="card">
    <div class="card-header">
        Create Post
    </div>
    <div class="card-body card-block">
        <form action="{{route('admin.post.store')}}" method="post" enctype="multipart/form-data">
            @csrf   
            @include('admin.pages.posts._form', ['data_user' => $data_user])
        </form>
    </div>
</div>
@endsection