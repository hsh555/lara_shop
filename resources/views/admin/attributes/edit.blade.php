@extends('admin.layouts.admin')

@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class=" bg-white shadow-sm rounded p-5">
                <h5 class="font-weight-bold border-bottom mb-4 pb-3">ویرایش ویژگی</h5>
                @include('admin.partials.errors')
                <form action="{{ route('admin.attributes.update', $attribute->id) }}" method="POST">
                    @csrf
                    @method("put")
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="brand">نام ویژگی</label>
                            <input type="text" name="name" class="form-control" value="{{ $attribute->name }}"
                                id="brand">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">ویرایش</button>
                    <a href="{{ route('admin.attributes.index') }}" class="btn btn-outline-secondary">بازگشت</a>
            </div>
            </form>
        </div>
    </div>

@endsection
