@extends('admin.layouts.admin')

@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class=" bg-white shadow-sm rounded p-5">
                <h5 class="font-weight-bold border-bottom mb-4 pb-3">{{ $attribute->name }}</h5>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>نام ویژگی</label>
                        <input type="text" value="{{ $attribute->name }}" disabled class="form-control">
                    </div>
                    <div class="form-group col-md-6">
                        <label>تاریخ ایجاد</label>
                        <input type="text" value="{{ verta($attribute->created_at)->format('Y-n-j H:i') }}" disabled class="form-control" >
                    </div>
                </div>
                <a href="{{ route('admin.attributes.index') }}" class="btn btn-outline-secondary">بازگشت</a>
            </div>

        </div>
    </div>

@endsection
