@extends('admin.layouts.admin')


@section('main-admin')

<div class="row">
    <div class="col-md-12">
        <!-- DATA TABLE -->
        <h3 class="title-5 m-b-35">List Posts</h3>
        @if(session('success'))
        <div class="alert alert-success m-t-10">
            {{session('success')}}
        </div>
        @endif
        <div class="table-responsive table-responsive-data2">
            <table class="table table-data2">
                <thead>
                    <tr>
                        <th></th>
                        <th>title</th>
                        <th>image</th>
                        <th>created_at</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $item)
                        <tr class="tr-shadow">
                            <td>{{++$key}}</td>
                            <td>
                                <span class="block-email">{{$item['title']}}</span>
                            </td>
                            <td>
                                <img src="{{$item['img']}}" style="width: 150px; object-fit: cover;" class="img-thumbnail">
                            </td>
                            <td>
                                {{date('d-m-Y', strtotime($item['created_at']))}}
                            </td>
                            <td>
                                @can('update', App\Models\Post::find($item['id']))
                                    <div class="table-data-feature">
                                        <form action="{{ route('admin.post.destroy', $item['id']) }}" method="POST" class="delete-form-{{ $item['id'] }} d-flex">
                                            {{ method_field('DELETE') }}
                                            {!! csrf_field() !!}
                                            <a href="{{route('admin.post.edit', $item['id'])}}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                                <i class="zmdi zmdi-edit"></i>
                                            </a>
                                            <a href="{{route('admin.post.show', $item['id'])}}" class="item" data-toggle="tooltip" data-placement="top" title="Show">
                                                <i class="zmdi zmdi-eye"></i>
                                            </a>
                                            <button  type="submit" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                                <i class="zmdi zmdi-delete"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endcan
                            </td>
                        </tr>
                        <tr class="spacer"></tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END DATA TABLE -->
    </div>
</div>

@endsection
