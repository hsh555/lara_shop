@extends('admin.layouts.admin')

@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class=" bg-white shadow-sm rounded p-5">
                <h5 class="font-weight-bold border-bottom mb-4 pb-3">ویرایش برند</h5>
                @include('admin.partials.errors')
                <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST">
                    @csrf
                    @method("put")
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="brand">نام برند</label>
                            <input type="text" name="name" class="form-control" value="{{ $brand->name }}" id="brand">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="isActive">وضعیت</label>
                            <select id="isActive" name="is_active" class="form-control">
                                <option value="1" {{ $brand->is_active == "فعال" ?  'selected' : Null }}>فعال</option>
                                <option value="0" {{ !$brand->is_active == "غیرفعال" ? 'selected' : Null }}>غیر فعال</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">ویرایش</button>
                    <a href="{{ route('admin.brands.index') }}" class="btn btn-outline-secondary">بازگشت</a>
            </div>
            </form>
        </div>
    </div>

@endsection
