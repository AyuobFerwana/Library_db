@extends('cms.starter')

@section('title', 'Create Admin')

@section('title-first', 'Create Admin')
@section('title-secound', 'Create Admin')
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
                        <div class="card-title">Create Admin</div>
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
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name"id="name" required />
                                </div>
                                <div class="col-md-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" name="email" id="email" required />
                                </div>

                                <div class="col-md-12">
                                    <label for="role" class="form-label">Guard Name</label>
                                    <select class="form-select" id="role" required>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"> {{ $role->name }} </option>
                                        @endforeach
                                    </select>
                                </div>
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
            // console.log(document.getElementById('image_type').files[0]);

            var formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('email', document.getElementById('email').value);
            formData.append('role', document.getElementById('role').value);


            axios.post('/cms/admin/admins', formData)
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
