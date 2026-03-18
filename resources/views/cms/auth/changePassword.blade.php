@extends('cms.starter')

@section('title', 'Change Password')

@section('title-first', 'Change Password')
@section('title-secound', 'Change Password')
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
                        <div class="card-title">Change Password</div>
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
                                    <label for="Old Password" class="form-label">Old Password</label>
                                    <input type="text" class="form-control" id="old_password" required />
                                </div>
                                <div class="col-md-12">
                                    <label for="New Password" class="form-label">New Password</label>
                                    <input type="text" class="form-control" id="new_password" required />
                                </div>
                                <div class="col-md-12">
                                    <label for="confairmePassword" class="form-label">NewPassword Confirmation</label>
                                    <input type="text" class="form-control" id="new_password_confirmation" required />
                                </div>

                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Body-->
                        <!--begin::Footer-->
                        <div class="card-footer">
                            <button class="btn btn-info" onclick="updatePassword()" type="button">Save</button>
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
        function updatePassword() {
            let data = {
                old_password: document.getElementById('old_password').value,
                new_password: document.getElementById('new_password').value,
                new_password_confirmation: document.getElementById('new_password_confirmation').value,
            };

            axios.put('/cms/admin/update-password', data)
                .then(function(response) {
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
