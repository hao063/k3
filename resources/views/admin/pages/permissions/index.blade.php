@extends('admin.layouts.admin')


@section('main-admin')

<div class="row">
    <div class="col-md-12">
        <!-- DATA TABLE -->
        <h3 class="title-5 m-b-35">List Permissions</h3>
        <div class="table-responsive table-responsive-data2">
            <table class="table table-data2">
                <thead>
                    <tr>
                        <th></th>
                        <th>name</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $key => $item)
                        <tr class="tr-shadow">
                            <td>{{++$key}}</td>
                            <td>
                                <span class="block-email">{{$item['name']}}</span>
                            </td>
                            
                            <td>
                                <div class="table-data-feature">
                                    {{-- <form action="{{ route('admin.permission.destroy', $item['id']) }}" method="POST" class="delete-form-{{ $item['id'] }} d-flex">
                                        {{ method_field('DELETE') }}
                                        {!! csrf_field() !!}
                                        <a href="{{route('admin.permission.edit', $item['id'])}}" class="item" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="zmdi zmdi-edit"></i>
                                        </a>
                                        <button  type="submit" class="item" data-toggle="tooltip" data-placement="top" title="Delete">
                                            <i class="zmdi zmdi-delete"></i>
                                        </button>
                                    </form> --}}
                                </div>
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
