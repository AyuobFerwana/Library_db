@extends('cms.starter')

@section('title', 'Edit Department')

@section('title-first', 'Edit')
@section('title-secound', 'Edit Department')
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
                        <div class="card-title">Edit Department</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Form-->
                    <form id="form">
                        @method('put')
                        <!--begin::Body-->
                        <div class="card-body">
                            @csrf
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    A simple danger alert with
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (session()->has('message'))
                                <div class="alert {{ session('alert-type') }}" role="alert">
                                    Alert!
                                    <ul>
                                        <li>{{ session('message') }}</li>
                                    </ul>
                                </div>
                            @endif

                            <!--begin::Row-->
                            <div class="row g-3">
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label">Title</label>
                                    <input type="text" class="form-control"
                                        @if (old('title')) value="{{ old('title') }}" @else value="{{ $department->title }}" @endif
                                        name="title" id="title" required />
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <label for="validationCustom02" class="form-label">Page Number</label>
                                    <input type="number" value="{{ $department->page_number }}" class="form-control"
                                        name="page_number" id="page_number" required />
                                </div>
                                <div class="col-md-6">
                                    <label for="validationCustom02" class="form-label">Price</label>
                                    <input type="number" value="{{ $department->price }}" class="form-control"
                                        name="price" id="price" required />
                                </div>


                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Body-->
                        <!--begin::Footer-->
                        <div class="card-footer">
                            <button class="btn btn-info" type="button">Submit form</button>
                        </div>
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

@endsection
