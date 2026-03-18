@extends('cms.starter')

@section('title', 'Create Role')

@section('title-first', 'Create Role')
@section('title-secound', 'Create Role')
@section('title-thired', 'Home')

@section('css')

@endsection

@section('content')

    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row g-4">

            <div class="col-md-12">
                <div class="card card-info card-outline mb-4">
                    <!--begin::Header-->
                    <div class="card-header">
                        <div class="card-title">Create Role</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Form-->
                    <form id="create-form">
                        <!--begin::Body-->
                        <div class="card-body">
                            @csrf

                            <!--begin::Row-->
                            <div class="row g-3">
                                <!--begin::Col-->
                                <div class="col-md-12">
                                    <label for="validationCustom01" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name"id="name" required />
                                </div>
                                {{-- <div class="col-md-12">
                                    <label for="validationCustom01" class="form-label">Guard Name</label>
                                    <input type="text" class="form-control" name="guard_name"id="guard_name" required />
                                </div> --}}

                                <div class="col-md-12">
                                    <label for="guard_name" class="form-label">Guard Name</label>
                                    <select class="form-select" id="guard_name" required>
                                        <option value="admin">Admin</option>
                                        <option value="publisher">Publisher</option>
                                    </select>
                                </div>

                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Body-->
                        <!--begin::Footer-->
                        <div class="card-footer">
                            <button class="btn btn-info" onclick="performStore()" type="button">Save</button>
                        </div>
                        {{-- onclick="performStore()" --}}
                        <!--end::Footer-->
                    </form>
                </div>
                <!--end::Form Validation-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
@endsection


@section('js')
    <script>
        function performStore() {
            axios.post('/cms/admin/roles', {
                    name: document.getElementById('name').value,
                    guard_name: document.getElementById('guard_name').value,
                })
                .then(function(response) {
                    console.log(response);
                    toastr.success(response.data.message);
                    document.getElementById('create-form').reset();
                })
                .catch(function(error) {
                    console.log(error);
                    toastr.error(error.response.data.message);
                });
        }
    </script>

@endsection
