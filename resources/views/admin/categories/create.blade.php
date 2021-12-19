@extends('admin.layouts.admin')

@section('script')
    <script>
        $('#attributeSelect').selectpicker({
            "title": "انتخاب ویژگی ها"
        });

        $('#attributeSelect').on('changed.bs.select', function() {
            let attributesSelected = $(this).val();

            let attributes = @json($attributes);

            let attributesForFilter = [];

            attributes.map((attribute) => {
                $.each(attributesSelected, function(i, element) {
                    if (attribute.id == element) {
                        attributesForFilter.push(attribute);
                    }
                });
            });

            $("#attributeFilter").find("option").remove();
            $("#attributeVariation").find("option").remove();

            attributesForFilter.forEach(attribute => {
                let attributeFilterOption = $("<option />", {
                    value: attribute.id,
                    text: attribute.name,
                })

                let attributeVarationOption = $("<option />", {
                    value: attribute.id,
                    text: attribute.name,
                })


                $("#attributeFilter").append(attributeFilterOption);
                $("#attributeFilter").selectpicker("refresh");

                $("#attributeVariation").append(attributeVarationOption);
                $("#attributeVariation").selectpicker("refresh");
            });
        });

        $('#attributeFilter').selectpicker({
            "title": "انتخاب فیلتر ها"
        });
        $('#attributeVariation').selectpicker({
            "title": "انتخاب متغیر"
        });
    </script>
@endsection

@section('content')
    <!-- Content Row -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class=" bg-white shadow-sm rounded p-5">
                <h5 class="font-weight-bold border-bottom mb-4 pb-3">ایجاد دسته بندی</h5>
                @include('admin.partials.errors')
                <form action="{{ route('admin.categories.store' ) }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="categoryName">نام</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control"
                                id="categoryName">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="categorySlug">نام انگلیسی</label>
                            <input type="text" name="slug" value="{{ old('slug') }}" class="form-control"
                                id="categorySlug">
                        </div>
                        <div class="form-group col-md-3">
                            <label for="categoryParent">والد</label>
                            <select id="categoryParent" name="parent_id" class="form-control">
                                <option value="0" selected>بدون والد</option>
                                @foreach ($parentCategories as $parent)
                                    <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="categoryStatus">وضعیت</label>
                            <select id="categoryStatus" name="is_active" class="form-control">
                                <option value="1" selected>فعال</option>
                                <option value="0">غیر فعال</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="attributeSelect">ویژگی ها</label>
                            <select id="attributeSelect" name="attribute_ids[]"
                                class="form-control form-control__select selectpicker" multiple data-live-search="true">
                                @foreach ($attributes as $attribute)
                                    <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="attributeFilter">ویژگی های قابل فیلتر</label>
                            <select id="attributeFilter" name="attribute_filter_ids[]"
                                class="form-control form-control__select selectpicker" multiple data-live-search="true">
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="attributeVariation">ویژگی متغیر</label>
                            <select id="attributeVariation" name="attribute_variation_id"
                                class="form-control form-control__select selectpicker" data-live-search="true">
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="categoryIcon">آیکون</label>
                            <input type="text" name="icon" value="{{ old('icon') }}" class="form-control"
                                id="categoryIcon">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="categoryDescription">توضیحات</label>
                        <textarea class="form-control" name="description" id="categoryDescription"
                            rows="3">{{ old('description') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">ثبت</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">بازگشت</a>
            </div>
            </form>
        </div>
    </div>

@endsection
