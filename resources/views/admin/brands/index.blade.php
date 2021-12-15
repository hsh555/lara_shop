@extends('admin.layouts.admin')

@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class=" bg-white shadow-sm rounded p-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="font-weight-bold">لیست برندها({{ $brands->total() }})</h5>
                    <a href="{{ route('admin.brands.create') }}" class="btn btn-primary">ایجاد برند</a>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">نام</th>
                            <th scope="col">وضعیت</th>
                            <th scope="col">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $key => $brand)
                            <tr>
                                <td>{{ $brands->firstItem() + $key }}</td>
                                <td>{{ $brand->name }}</td>
                                <td class="{{ $brand->getRawOriginal('is_active') ? 'text-success' : 'text-danger' }}">
                                    {{ $brand->is_active }}</td>
                                <td>
                                    <a href="{{ route('admin.brands.edit', $brand->id) }}" class="text-dark mx-2"
                                        title="ویرایش برند"><i class="far fa-edit"></i></a>
                                    <a href="{{ route('admin.brands.show', $brand->id) }}" class="btn btn-outline-info btn-sm">نمایش</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-5">
                    {{ $brands->links() }}
                </div>
            </div>
        </div>

    @endsection
