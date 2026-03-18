@extends('cms.starter')

@section('title', 'Edit Profile')

@section('title-first', 'Edit Profile')
@section('title-secound', 'Edit Profile')
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
                        <div class="card-title">Edit Profile</div>
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
                                    <label for="Name" class="form-label">Name</label>
                                    <input type="text" value="{{ $user->name }}" class="form-control" id="name"
                                        required />
                                </div>
                                <div class="col-md-12">
                                    <label for="Email" class="form-label">Email</label>
                                    <input type="email" value="{{ $user->email }}" class="form-control" id="email"
                                        required />
                                </div>


                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Body-->
                        <!--begin::Footer-->
                        <div class="card-footer">
                            <button class="btn btn-info" onclick="updateProfile()" type="button">Save</button>
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
        function updateProfile() {
            let data = {
                email: document.getElementById('email').value,
                name: document.getElementById('name').value,
            };

            axios.put('/cms/admin/update-profile', data)
                .then(function(response) {
                    toastr.success(response.data.message);
                    // document.getElementById('create-form').reset();
                })
                .catch(function(error) {
                    console.log(error);
                    toastr.error(error.response.data.message);
                });

        }
    </script>

@endsection
