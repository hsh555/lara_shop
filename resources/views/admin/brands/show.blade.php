@extends('admin.layouts.admin')

@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class=" bg-white shadow-sm rounded p-5">
                <h5 class="font-weight-bold border-bottom mb-4 pb-3">{{ $brand->name }}</h5>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>نام برند</label>
                        <input type="text" value="{{ $brand->name }}" disabled class="form-control" id="brand">
                    </div>
                    <div class="form-group col-md-4">
                        <label>نام برند</label>
                        <input type="text" value="{{ $brand->is_active }}" disabled class="form-control" id="brand">
                    </div>
                    <div class="form-group col-md-4">
                        <label>تاریخ ایجاد</label>
                        <input type="text" value="{{ verta($brand->created_at)->format('Y-n-j H:i') }}" disabled class="form-control" id="brand">
                    </div>
                </div>
                <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-secondary">بازگشت</a>
            </div>

        </div>
    </div>

@endsection
