@extends('admin.layouts.admin')

@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class=" bg-white shadow-sm rounded p-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="font-weight-bold">لیست ویژگی ها({{ $attributes->total() }})</h5>
                    <a href="{{ route('admin.attributes.create') }}" class="btn btn-primary">ایجاد ویژگی</a>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">نام</th>
                            <th scope="col">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attributes as $key => $attribute)
                            <tr>
                                <td>{{ $attributes->firstItem() + $key }}</td>
                                <td>{{ $attribute->name }}</td>
                                <td>
                                    <a href="{{ route('admin.attributes.edit', $attribute->id) }}" class="text-dark mx-2"
                                        title="ویرایش برند"><i class="far fa-edit"></i></a>
                                    <a href="{{ route('admin.attributes.show', $attribute->id) }}"
                                        class="text-info"><i class="far fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-5">
                    {{ $attributes->links() }}
                </div>
            </div>
        </div>

    @endsection
