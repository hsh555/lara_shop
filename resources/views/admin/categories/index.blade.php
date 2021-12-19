@extends('admin.layouts.admin')

@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class=" bg-white shadow-sm rounded p-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="font-weight-bold">لیست دسته بندی ها({{ $categories->total() }})</h5>
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">ایجاد دسته بندی</a>
                </div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">نام</th>
                            <th scope="col">نام انگلیسی</th>
                            <th scope="col">والد</th>
                            <th scope="col">وضعیت</th>
                            <th scope="col">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $key => $category)

                            <tr>
                                <td>{{ $categories->firstItem() + $key }}</td>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->parent ? $category->parent->name : "بدون والد" }}</td>
                                <td class="{{ $category->getRawOriginal('is_active') ? 'text-success' : 'text-danger' }}">
                                    {{ $category->is_active }}</td>
                                <td>
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-dark mx-2"
                                        title="ویرایش دسته بندی"><i class="far fa-edit"></i></a>
                                    <a href="{{ route('admin.categories.show', $category->id) }}" title="نمایش دسته بندی"
                                        class="text-info"><i class="far fa-eye"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center mt-5">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>

    @endsection
