@extends('cms.starter')

@section('title', 'Create Department')

@section('title-first', 'Create Department')
@section('title-secound', 'Create Department')
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
                        <div class="card-title">Create Department</div>
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

                                <label for="validationCustom01" class="form-label">Image</label>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" name="image_type" id="image_type">
                                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
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
            // console.log(document.getElementById('image_type').files[0]);

            var formData = new FormData();
            formData.append('name', document.getElementById('name').value);
            formData.append('image_type', document.getElementById('image_type').files[0]);
            console.log(formData);

            axios.post('/cms/admin/depart', formData)
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
