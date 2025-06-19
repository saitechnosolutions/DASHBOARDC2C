@extends('layout.app')
@section('main_content')
    <div class="col-lg-12">
        <div class="card card-h-100">
            <div class="card-body">
                <div class="container">
                    <h2 class="mb-4">Edit Product</h2>
                    <form class="needs-validation" id="addProductForm" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="add_category_select">Choose Category*</label>
                                    <select class="form-select" name="category_id" id="add_category_select">
                                        <option value="" disabled
                                            {{ empty($productDetails->category_id) ? 'selected' : '' }}>Select Category
                                        </option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $productDetails->category_id == $category->id ? 'selected' : '' }}>
                                                {{ $category->category_name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="add_category_select">Choose Sub Category*</label>
                                    <select class="form-select" name="subcategory_id" id="add_subcategory_select">
                                        <option value="" disabled
                                            {{ empty($productDetails->subcategory_id) ? 'selected' : '' }}>Select
                                            SubCategory
                                        </option>
                                        @foreach ($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}"
                                                {{ $productDetails->subcategory_id == $subcategory->id ? 'selected' : '' }}>
                                                {{ $subcategory->subcategory_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="add_product_name">Product Name*</label>
                                    <input type="text" class="form-control" id="add_product_name" name="product_name"
                                        placeholder="Product name" maxlength="50" required
                                        value="{{ $productDetails->product_name }}">
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="subcate_size_append mt-3 mb-3">

                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="add_product_description">Product Feature Title*</label>
                                    <input type="text" class="form-control" id="add_product_description"
                                        name="product_description" placeholder="Product Feature Title"
                                        maxlength="100"required>


                                </div>
                            </div>



                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label" for="add_product_image">Product Image*(750 *
                                        600)</label>

                                    <input type="file" class="form-control needsclick" id="add_product_image"
                                        placeholder="Product Image" accept="image/*" name="product_image" required>
                                </div>
                            </div>

                            <label for="add_product_image" class="preview-container" id="preview-container">
                                <div class="flex justify-content-center">
                                    <div class="text-center">
                                        <i class="display-4 col-12 text-muted mdi mdi-cloud-upload"></i>
                                    </div>
                                    <div>
                                        <span class="col-12">Upload Image</span>
                                    </div>
                                </div>
                            </label>


                            <!--end::Input group-->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="add_brand_name">Brand
                                        Name*</label>
                                    <input type="text" class="form-control" id="add_brand_name" name="brand_name"
                                        placeholder="Brand Name" maxlength="200" required
                                        value="{{ $productDetails->brand_name }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="add_material_name">Material*</label>
                                    <input type="text" class="form-control" id="add_material_name" name="brand_material"
                                        placeholder="Brand Material" maxlength="200" required
                                        value="{{ $productDetails->brand_material }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="add_material_color">Type*</label>
                                    <input type="text" class="form-control" id="add_product_type" name="brand_type"
                                        placeholder="Product Type" maxlength="200" required
                                        value="{{ $productDetails->brand_type }}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="add_material_color">Return Approval Date*</label>
                                    <input type="text" class="form-control" id="add_product_type"
                                        name="approval_days" placeholder="Approval days" maxlength="2" required
                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value > 30) this.value = 30;">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="add_product_specification">Product
                                        Description*</label>
                                    <textarea type="text" class="form-control" id="add_product_specification" name="product_specification"
                                        placeholder="Product Description" maxlength="600" rows="7" required>{{ $productDetails->product_description }}</textarea>
                                </div>
                            </div>


                        </div>

                        <div class="text-center">
                            <button class="btn btn-primary edit_submit_btn mt-3" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
