@extends('layout.app')
@section('main_content')
    <div class="col-lg-12">
        <div class="card card-h-100">
            <div class="card-body">
                <div class="container">
                    <h2 class="mb-4">Add Product</h2>
                    <form class="needs-validation" id="addProductForm" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="add_category_select">Choose Category*</label>
                                    <select class="form-select" name="category_id" id="add_category_select">
                                        <option value="" disabled selected>Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->category_name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="add_category_select">Choose Sub Category*</label>
                                    <select class="form-select" name="subcategory_id" id="add_subcategory_select">
                                        <option value="" disabled selected>Select Sub Category</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="add_product_name">Product Name*</label>
                                    <input type="text" class="form-control" id="add_product_name" name="product_name"
                                        placeholder="Product name" maxlength="50" required>
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
                                        placeholder="Brand Name" maxlength="200" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="add_material_name">Material*</label>
                                    <input type="text" class="form-control" id="add_material_name" name="brand_material"
                                        placeholder="Brand Material" maxlength="200" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="add_material_color">Type*</label>
                                    <input type="text" class="form-control" id="add_product_type" name="brand_type"
                                        placeholder="Product Type" maxlength="200" required>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label" for="add_material_color">Return Approval Date*</label>
                                    <input type="text" class="form-control" id="add_product_type" name="approval_days"
                                        placeholder="Approval days" maxlength="2" required
                                        oninput="this.value = this.value.replace(/[^0-9]/g, ''); if (this.value > 30) this.value = 30;">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="add_product_specification">Product
                                        Description*</label>
                                    <textarea type="text" class="form-control" id="add_product_specification" name="product_specification"
                                        placeholder="Product Description" maxlength="600" rows="7" required></textarea>
                                </div>
                            </div>


                        </div>

                        <div class="col-lg-12">
                            <div class="row">
                                <div class="card" style="padding: 20px;border: 1px solid;">
                                    <h5>Product Varient</h5>
                                    <div class="col-lg-12">
                                        <div id="dynamic-inputs">


                                            <div class="d-flex product_fields">
                                                <div class="row">

                                                    <label for="add_varient_image" class="preview-container"
                                                        id="preview-container1">
                                                        <div class="flex justify-content-center">
                                                            <div class="text-center">
                                                                <i
                                                                    class="display-4 col-12 text-muted mdi mdi-cloud-upload"></i>
                                                            </div>
                                                            <div>
                                                                <span class="col-12">Upload Image</span>
                                                            </div>
                                                        </div>
                                                    </label>

                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="add_varient_image">Variant
                                                                Image*(750 *
                                                                600)</label>
                                                            <input type="file"
                                                                class="form-control image_el dropzone needsclick"
                                                                id="add_varient_image" placeholder="Varient Image"
                                                                accept="image/*" name="Varient_image[]" required>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="add_varient_name">Variant
                                                                Name*</label>
                                                            <input type="text" class="form-control"
                                                                id="add_varient_name" name="varient_name[]"
                                                                placeholder="Varient Name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="add_product_quantity">Available
                                                                Stock*</label>
                                                            <input type="text" class="form-control"
                                                                id="add_product_quantity" name="product_quantity[]"
                                                                placeholder="Enter Stock" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="add_unit_select">Product
                                                                Unit*</label>
                                                            <select class="form-select" name="unit_value[]"
                                                                id="add_unit_select">
                                                                <option value="" selected>Select Units</option>

                                                                <option value="1">l</option>
                                                                <option value="2">ml</option>
                                                                <option value="3">g</option>
                                                                <option value="4">kg</option>
                                                                <option value="5">No's</option>


                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="add_product_quantity">Variant
                                                                Value*</label>
                                                            <input type="text" class="form-control"
                                                                id="add_product_value" name="product_value[]"
                                                                placeholder="Product Value" required>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="product_mrp_price">Product MRP
                                                                Price(ORIGINAL
                                                                PRICE)*</label>
                                                            <input type="text" class="form-control"
                                                                id="product_mrp_price" name="product_mrp_price[]"
                                                                placeholder="Product MRP price" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="product_offer_price">Product
                                                                Selling Price(OFFER
                                                                PRICE)*</label>
                                                            <input type="text" class="form-control"
                                                                id="product_offer_price" name="product_offer_price[]"
                                                                placeholder="Product Selling price" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="product_low_stock">Low Stock
                                                                *</label>
                                                            <input type="text" class="form-control"
                                                                id="product_low_stock" name="low_stock[]"
                                                                placeholder="Product low stock" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="">Product
                                                                GST</label>
                                                            <select class="form-select" name="product_gst[]"
                                                                id="">
                                                                <option value="" selected>Select GST</option>
                                                                <option value="0">0</option>
                                                                <option value="5">5</option>
                                                                <option value="12">12</option>
                                                                <option value="18">18</option>
                                                                <option value="28">28</option>


                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3  d-flex justify-content-start align-items-center">
                                                        <div class="mb-3 mt-4">

                                                            <input type="checkbox" name="hot_deals[]" class="hot_value"
                                                                value="0"> <label class="form-label">Hot
                                                                Products</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3  d-flex justify-content-start align-items-center">
                                                        <div class="mb-3 mt-4">

                                                            <input type="checkbox" name="popular_prod[]" class="pop_prod"
                                                                value="0"> <label class="form-label">Popular
                                                                Products</label>
                                                        </div>
                                                    </div>

                                                    <div class="mb-3" style="">
                                                        <h5>Product Thump Images</h5>
                                                        <input type="hidden" name="product_image_count[]"
                                                            class="product_image_count" value="1">
                                                        <div class="col-lg-12">
                                                            <div id="dynamic-inputs1" class="dynamic-inputs1">


                                                                <div class="d-flex product_fields1">
                                                                    <div class="row">
                                                                        <div class="col-lg-8">
                                                                            <div class="mb-3">
                                                                                <label class="form-label"
                                                                                    for="add_product_image">Product
                                                                                    Image*(750 *
                                                                                    600)</label>
                                                                                <input type="file"
                                                                                    class="form-control image_el dropzone needsclick"
                                                                                    id="add_product_image"
                                                                                    placeholder="Product Image"
                                                                                    name="product_image1[]" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-4 col-sm-12 mt-4">
                                                                            <div class="input-group-append">
                                                                                <button
                                                                                    class="btn btn-danger delete-input1"
                                                                                    type="button">Delete</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 mt-3">
                                                            <button id="add-input1" class="btn btn-success add-input1"
                                                                type="button">Add
                                                                Another Images</button>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <hr>
                                                    {{-- <div class="col-lg-3 col-sm-12 mt-4">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-danger delete-input"
                                                                type="button">Delete Varient</button>
                                                        </div>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    {{-- <div class="col-lg-3 mt-3">
                                        <button id="add-input" class="btn btn-success" type="button">Add
                                            Another Varient</button>
                                    </div> --}}
                                </div>


                                {{-- <div class="card" style="padding: 20px;">
                                    <h5>Product Thump Images</h5>
                                    <div class="col-lg-12">
                                        <div id="dynamic-inputs1">


                                            <div class="d-flex product_fields1">
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="add_product_image">Product
                                                                Image*(750 *
                                                                600)</label>
                                                            <input type="file"
                                                                class="form-control image_el dropzone needsclick"
                                                                id="add_product_image" placeholder="Product Image"
                                                                name="product_image1[]" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-sm-12 mt-4">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-danger delete-input1"
                                                                type="button">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 mt-3">
                                        <button id="add-input1" class="btn btn-success" type="button">Add
                                            Another Images</button>
                                    </div>
                                </div> --}}


                            </div>



                        </div>



                        <div class="text-center">
                            <button class="btn btn-primary add_submit_btn mt-3" type="submit">Add product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
