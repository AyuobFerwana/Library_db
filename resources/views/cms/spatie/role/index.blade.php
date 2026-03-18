@extends('cms.starter')

@section('title', 'Index Role')

@section('title-first', 'index')
@section('title-secound', 'Role')
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
                        <h3 class="card-title">Role Index</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th>Guard Name</th>
                                    <th>Permissions</th>
                                    <th>Created_at</th>
                                    <th>Update_at</th>
                                    <th>Settings</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($role as $roles)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $roles->name }}</td>
                                        <td>{{ $roles->guard_name }}</td>
                                        <td><a href="{{ route('roles.show', $roles->id) }}" class="btn btn-warning">
                                                ({{ $roles->permissions_count }})
                                                Permission/s</a></td>
                                        <td>{{ $roles->created_at }}</td>

                                        <td>{{ $roles->updated_at }}</td>
                                        <td>
                                            <div class="btn-group mb-2" role="group"
                                                aria-label="Basic mixed styles example">
                                                <a href="{{ route('roles.edit', $roles->id) }}"
                                                    class="btn btn-success">Edit</a>
                                                <a href="#" onclick="confirmDestroy({{ $roles->id }},this)"
                                                    class="btn btn-danger">Delete</a>

                                                {{-- <form method="Post" action="{{ route('book.destroy', $book->id) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>

                                                </form> --}}

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
        function confirmDestroy(id, reference) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {

                }
                performDestroy(id, reference);
            });
        }

        function performDestroy(id, reference) {
            axios.delete('/cms/admin/roles/' + id)
                .then(function(response) {
                    console.log(response);
                    showMessage(response.data);
                    reference.closest('tr').remove();
                })
                .catch(function(error) {
                    console.log(error);
                    showMessage(error.response.data);

                })
        }

        function showMessage(data) {
            Swal.fire({
                icon: data.icon,
                title: data.title,
                showConfirmButton: false,
                timer: 1500
            });
        }
    </script>
@endsection
