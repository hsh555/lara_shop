@extends('admin.layouts.admin')



@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class=" bg-white shadow-sm rounded p-5">
                <h5 class="font-weight-bold border-bottom mb-4 pb-3">ایجاد دسته بندی</h5>

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="categoryName">نام</label>
                        <input type="text" name="name" disabled value="{{ $category->name }}" class="form-control"
                            id="categoryName">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="categorySlug">نام انگلیسی</label>
                        <input type="text" name="slug" disabled value="{{ $category->slug }}" class="form-control"
                            id="categorySlug">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="categoryParent">والد</label>
                        <select id="categoryParent" disabled name="parent_id" class="form-control">
                            @if ($category->parent_id)
                                <option value="{{ $category->parent->id }}">{{ $category->parent->name }}</option>
                            @else
                                <option value="{{ $category->parent_id }}">بدون والد</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="categoryStatus">وضعیت</label>
                        <select id="categoryStatus" name="is_active" disabled class="form-control">
                            <option value="1" {{ $category->getRawOriginal('is_active') ? 'selected' : '' }}>فعال
                            </option>
                            <option value="0" {{ $category->getRawOriginal('is_active') ? '' : 'selected' }}>غیر فعال
                            </option>
                        </select>
                    </div>

                    <div class="form-group col-md-3">
                        <label>آیکون</label>
                        <input type="text" name="icon" disabled value="{{ $category->icon }}" class="form-control">
                    </div>
                    <div class="form-group col-md-3">
                        <label>تاریخ ایجاد</label>
                        <input type="text" name="icon" disabled value="{{ verta($category->created_at) }}"
                            class="form-control">
                    </div>
                    <div class="form-group col-12">
                        <label>توضیحات</label>
                        <textarea class="form-control" disabled name="description"
                            rows="3">{{ $category->description }}</textarea>
                    </div>
                    <div class="form-group col-md-4">
                        <label>ویژگی ها</label>
                        <select disabled class="form-control">
                            <option>
                                @foreach ($category->attributes as $attribute)
                                    {{ $attribute->name }} {{ $loop->last ? '' : ',' }}
                                @endforeach
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>ویژگی های قابل فیلتر</label>
                        <select disabled class="form-control">
                            <option>
                                @foreach ($category->attributes()->wherePivot('is_filter', 1)->get()
        as $attribute)
                                    {{ $attribute->name }} {{ $loop->last ? '' : ',' }}
                                @endforeach
                            </option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="attributeVariation">ویژگی متغیر</label>
                        <select disabled class="form-control">
                            <option>
                                {{ $category->attributes()->wherePivot('is_variation', 1)->first() ? $category->attributes()->wherePivot('is_variation', 1)->first()->name : "" }}
                            </option>
                        </select>
                    </div>
                </div>

                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">بازگشت</a>
            </div>

        </div>
    </div>

@endsection
