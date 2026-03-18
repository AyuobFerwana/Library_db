    @extends('cms.starter')

    @section('title', 'Role - Permissions')

    @section('title-first', 'Role - Permissions')
    @section('title-secound', 'Role - Permissions')
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
                            <h3 class="card-title">({{ $role->name }}) - Permissions</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Name</th>
                                        <th>Guard Name</th>
                                        <th>Assigned</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $permission)
                                        <tr>
                                            <td>{{ $permission->id }}</td>
                                            <td>{{ $permission->name }}</td>
                                            <td>{{ $permission->guard_name }}</td>
                                            <td>
                                                <div class="row mb-3">
                                                    <div class="col-sm-10 offset-sm-2">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                @if ($permission->assigned) checked @endif
                                                                id="permission_{{ $permission->id }}"
                                                                onclick="performStore('{{ $role->id }}','{{ $permission->id }}')">
                                                            <label class="form-check-label"
                                                                for="permission_{{ $permission->id }}">
                                                        </div>
                                                    </div>
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
            // function confirmDestroy(id, reference) {
            //     Swal.fire({
            //         title: "Are you sure?",
            //         text: "You won't be able to revert this!",
            //         icon: "warning",
            //         showCancelButton: true,
            //         confirmButtonColor: "#3085d6",
            //         cancelButtonColor: "#d33",
            //         confirmButtonText: "Yes, delete it!"
            //     }).then((result) => {
            //         if (result.isConfirmed) {

            //         }
            //         performDestroy(id, reference);
            //     });
            // }

            function performStore(roleId, permissionId) {
                let data = {
                    permission_id: permissionId
                };
                store('/cms/admin/role/' + roleId + '/permissions', data);
            }

            // function showMessage(data) {
            //     Swal.fire({
            //         icon: data.icon,
            //         title: data.title,
            //         showConfirmButton: false,
            //         timer: 1500
            //     });
            // }
        </script>
    @endsection
