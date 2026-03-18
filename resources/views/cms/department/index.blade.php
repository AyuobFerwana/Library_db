@extends('cms.starter')

@section('title', 'Index Department')

@section('title-first', 'index')
@section('title-secound', 'Department')
@section('title-thired', 'home')

@section('css')

@endsection

@section('content')
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Department Index</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th>Created_At </th>
                                    <th>Updated_At</th>
                                    <th>Settings</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departments as $department)
                                    <tr>
                                        <td><img class="direct-chat-img" src="{{ Storage::url($department->image_type) }}"
                                                alt="message user image"></td>
                                        <td>{{ $department->id }}</td>
                                        <td>{{ $department->name }}</td>
                                        <td>{{ $department->created_at }}</td>
                                        <td>{{ $department->updated_at }}</td>
                                        <td>
                                            <div class="btn-group mb-2" role="group"
                                                aria-label="Basic mixed styles example">
                                                <a href="{{ route('departments.edit', $department->id) }}"
                                                    class="btn btn-success">Edit</a>
                                                <a href="#" onclick="performDestroy('{{ $department->id }}', this)"
                                                    class="btn btn-danger">Delete</a>


                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <ul class="pagination pagination-sm m-0 float-end">
                            <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Row-->
    </div>

@endsection


@section('js')
    <script>
        function performDestroy(id, reference) {
            confirmDestroy('/cms/admin/departments', id, reference);
        }
    </script>
@endsection
