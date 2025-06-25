@extends('layout.app')
@section('main_content')
    <div class="col-lg-12">
        @php
            $districts = App\Models\AllIndiaPincode::where('statename', 'TAMIL NADU')
                ->select('Districtname')
                ->distinct()
                ->orderBy('Districtname')
                ->get();

            $products = App\Models\Product::all();
        @endphp
        <div class="card card-h-100">
            <div class="card-body">
                <div class="container">
                    <h2 class="mb-4">Add Vendor</h2>
                    <form class="needs-validation" id="addVendorForm" enctype="multipart/form-data">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="add_product_name">Vendor Name*</label>
                                    <input type="text" class="form-control" id="add_Vendor_name" name="product_name"
                                        placeholder="Vendor name" maxlength="50" required>
                                </div>
                            </div>



                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="add_product_description">Vendor email*</label>
                                    <input type="email" class="form-control" id="add_vendor_email"
                                        name="product_description" placeholder="Vendor Email" maxlength="100" required>
                                </div>
                            </div>

                            <!--end::Input group-->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="add_brand_name">Contact
                                        Name*</label>
                                    <input type="text" class="form-control" id="vendor_contact_name" name="brand_name"
                                        placeholder="Contact Name" maxlength="200" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="add_material_name">Contact Number*</label>
                                    <input type="text" class="form-control" id="vendor_contact_number"
                                        name="brand_material" placeholder="Contact Number" maxlength="200" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="add_material_color">Business Type*</label>
                                    <input type="text" class="form-control" id="vendor_business_type" name="brand_type"
                                        placeholder="Business Type" maxlength="200" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="add_material_color">GST Number*</label>
                                    <input type="text" class="form-control" id="vendor_gst_number" name="approval_days"
                                        placeholder="GST Number" maxlength="15" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="add_product_specification">Address*</label>
                                    <textarea type="text" class="form-control" id="add_vendor_address" name="product_specification" placeholder="Address"
                                        maxlength="600" rows="7" required></textarea>
                                </div>
                            </div>


                        </div>

                        <div class="col-lg-12">
                            <div class="row">
                                <div class="card" style="padding: 20px;border: 1px solid;">
                                    <h5>Vendor Address Details</h5>
                                    <div class="col-lg-12">
                                        <div id="dynamic-inputs">


                                            <div class="d-flex product_fields">
                                                <div class="row">


                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="add_varient_name">Vendor
                                                                State*</label>
                                                            <input type="text" class="form-control"
                                                                id="vendor_state_name" name="varient_name"
                                                                placeholder="State Name" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="add_product_quantity">Vendor
                                                                District*</label>
                                                            <input type="text" class="form-control"
                                                                id="vendor_district_name" name="product_quantity"
                                                                placeholder="District Name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="add_unit_select">Pincode*</label>
                                                            <input type="text" class="form-control"
                                                                id="vendor_pincode_value" name="product_value"
                                                                placeholder="Pincode" required>
                                                        </div>
                                                    </div>

                                                    <h5 class="mt-4">Vendor Bank Details</h5>

                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="add_product_quantity">Bank
                                                                Name*</label>
                                                            <input type="text" class="form-control"
                                                                id="vendor_bank_name" name="product_value"
                                                                placeholder="Bank Name" required>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="product_mrp_price">Account
                                                                Holder Name</label>
                                                            <input type="text" class="form-control"
                                                                id="bank_account_name" name="product_mrp_price"
                                                                placeholder="Account Holder Name" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="product_offer_price">Account
                                                                Number*</label>
                                                            <input type="text" class="form-control"
                                                                id="vendor_account_number" name="product_offer_price"
                                                                placeholder="Account Number" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="product_low_stock">IFSC Code
                                                                *</label>
                                                            <input type="text" class="form-control"
                                                                id="bank_ifsc_code" name="low_stock[]"
                                                                placeholder="IFSC Code" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="product_low_stock">Districts
                                                                Dealing With
                                                                *</label>
                                                            <select class="form-control"
                                                                name="vendor_areas_dealing_with[]" multiple="multiple"
                                                                id="vendor_areas_dealing_with" required>
                                                                @foreach ($districts as $district)
                                                                    <option value="{{ $district->Districtname }}">
                                                                        {{ $district->Districtname }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="product_low_stock">Products
                                                                *</label>
                                                            <select class="form-control select2"
                                                                name="add_vendor_products[]" multiple="multiple"
                                                                id="add_vendor_products" required>
                                                                @foreach ($products as $product)
                                                                    <option value="{{ $product->id }}">
                                                                        {{ $product->product_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="col-md-3">
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
                                                    </div> --}}
                                                    {{-- <div class="col-md-3  d-flex justify-content-start align-items-center">
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
                                                    </div> --}}
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
                            <button class="btn btn-primary add_submit_btn mt-3" type="submit">Add Vendor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#vendor_areas_dealing_with').select2({
                placeholder: "Select Areas",
                allowClear: true
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#add_vendor_products').select2({
                placeholder: "Select Products",
                allowClear: true
            });
        });
    </script>
@endpush
