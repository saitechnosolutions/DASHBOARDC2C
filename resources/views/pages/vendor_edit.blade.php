@extends('layout.app')
@section('main_content')
    <div class="col-lg-12">
        <div class="card card-h-100">
            <div class="card-body">
                <div class="container">
                    <h2 class="mb-4">Edit Vendor</h2>
                    <form class="needs-validation" id="editVendorForm" enctype="multipart/form-data">
                        <div class="row">

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="add_product_name">Vendor Name*</label>
                                    <input type="text" class="form-control" id="edit_Vendor_name" name="product_name"
                                        placeholder="Vendor name" maxlength="50" required
                                        value="{{ $vendorDetails->vendor_name }}">
                                </div>
                            </div>



                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="add_product_description">Vendor email*</label>
                                    <input type="email" class="form-control" id="edit_vendor_email"
                                        name="product_description" placeholder="Vendor Email" maxlength="100" required
                                        value="{{ $vendorDetails->vendor_email }}">
                                </div>
                            </div>

                            <!--end::Input group-->
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="add_brand_name">Contact
                                        Name*</label>
                                    <input type="text" class="form-control" id="edit_vendor_contact_name"
                                        name="brand_name" placeholder="Contact Name" maxlength="200" required
                                        value="{{ $vendorDetails->contact_name }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="add_material_name">Contact Number*</label>
                                    <input type="text" class="form-control" id="edit_vendor_contact_number"
                                        name="brand_material" placeholder="Contact Number" maxlength="200" required
                                        value="{{ $vendorDetails->contact_phone }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="add_material_color">Business Type*</label>
                                    <input type="text" class="form-control" id="edit_vendor_business_type"
                                        name="brand_type" placeholder="Business Type" maxlength="200" required
                                        value="{{ $vendorDetails->business_type }}">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label" for="add_material_color">GST Number*</label>
                                    <input type="text" class="form-control" id="edit_vendor_gst_number"
                                        name="approval_days" placeholder="GST Number" maxlength="15" required
                                        value="{{ $vendorDetails->gst_number }}">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label class="form-label" for="add_product_specification">Address*</label>
                                    <textarea type="text" class="form-control" id="edit_vendor_address" name="product_specification"
                                        placeholder="Address" maxlength="600" rows="7" required>{{ $vendorDetails->vendor_address }}</textarea>
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
                                                                id="edit_vendor_state_name" name="varient_name"
                                                                placeholder="State Name" required
                                                                value="{{ $vendorDetails->vendor_state }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="add_product_quantity">Vendor
                                                                District*</label>
                                                            <input type="text" class="form-control"
                                                                id="edit_vendor_district_name" name="product_quantity"
                                                                placeholder="District Name" required
                                                                value="{{ $vendorDetails->vendor_district }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label"
                                                                for="add_unit_select">Pincode*</label>
                                                            <input type="text" class="form-control"
                                                                id="edit_vendor_pincode_value" name="product_value"
                                                                placeholder="Pincode" required
                                                                value="{{ $vendorDetails->vendor_pincode }}">
                                                        </div>
                                                    </div>

                                                    <h5 class="mt-4">Vendor Bank Details</h5>

                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="add_product_quantity">Bank
                                                                Name*</label>
                                                            <input type="text" class="form-control"
                                                                id="edit_vendor_bank_name" name="product_value"
                                                                placeholder="Bank Name" required
                                                                value="{{ $vendorDetails->vendor_bank_name }}">
                                                        </div>
                                                    </div>


                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="product_mrp_price">Account
                                                                Holder Name</label>
                                                            <input type="text" class="form-control"
                                                                id="edit_bank_account_name" name="product_mrp_price"
                                                                placeholder="Account Holder Name" required
                                                                value="{{ $vendorDetails->vendor_account_name }}">
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="product_offer_price">Account
                                                                Number*</label>
                                                            <input type="text" class="form-control"
                                                                id="edit_vendor_account_number" name="product_offer_price"
                                                                placeholder="Account Number" required
                                                                value="{{ $vendorDetails->vendor_account_number }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="product_low_stock">IFSC Code
                                                                *</label>
                                                            <input type="text" class="form-control"
                                                                id="edit_bank_ifsc_code" name="low_stock[]"
                                                                placeholder="IFSC Code" required
                                                                value="{{ $vendorDetails->vendor_ifsc_number }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="mb-3">
                                                            <label class="form-label" for="product_low_stock">Products
                                                                *</label>
                                                            <select class="form-control select2" name="vendor_products[]"
                                                                multiple="multiple" id="edit_vendor_products" required>
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
                            <input type="hidden" name="" value="{{ $vendorDetails->id }}" id="edit_vendor_id">
                            <button class="btn btn-primary edit_submit_btn mt-3" type="submit">Submit</button>
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
            $('.select2').select2({
                placeholder: "Select Products",
                allowClear: true
            });
        });
    </script>

    <script>
        $(document).on('submit', '#editVendorForm', function(e) {
            e.preventDefault() // Prevent default form submission

            const formdata = new FormData(e.target) // Use e.target to get the form
            let vendorName = $('#edit_Vendor_name').val()
            let vendoremail = $('#edit_vendor_email').val()
            let vendorContactName = $('#edit_vendor_contact_name').val()
            let vendorContactNumber = $('#edit_vendor_contact_number').val()
            let vendorBusinessType = $('#edit_vendor_business_types').val()
            let vendorgst = $('#edit_vendor_gst_number').val()
            let vendorAddress = $('#edit_vendor_address').val()
            let vendorState = $('#edit_vendor_state_name').val()
            let vendorDistrict = $('#edit_vendor_district_name').val()
            let vendorPincode = $('#edit_vendor_pincode_value').val()
            let vendorBankName = $('#edit_vendor_bank_name').val()
            let vendorAccountHolderName = $('#edit_bank_account_name').val()
            let vendorAccountNumber = $('#edit_vendor_account_number').val()
            let vendorifsc = $('#edit_bank_ifsc_code').val();
            let vendorproducts = $('#edit_vendor_products').val();
            let vendorid = $('#edit_vendor_id').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
            })

            $.ajax({
                url: '/vendor/update',
                method: 'POST',
                dataType: 'json',
                data: {
                    vendorName: vendorName,
                    vendoremail: vendoremail,
                    vendorContactName: vendorContactName,
                    vendorContactNumber: vendorContactNumber,
                    vendorBusinessType: vendorBusinessType,
                    vendorgst: vendorgst,
                    vendorAddress: vendorAddress,
                    vendorState: vendorState,
                    vendorDistrict: vendorDistrict,
                    vendorPincode: vendorPincode,
                    vendorBankName: vendorBankName,
                    vendorAccountHolderName: vendorAccountHolderName,
                    vendorAccountNumber: vendorAccountNumber,
                    vendorifsc: vendorifsc,
                    vendorproducts: vendorproducts,
                    vendorid: vendorid
                },
                beforeSend: function() {
                    $('.edit_submit_btn').attr('disabled', true).html('Processing...')
                },
                success: function(response) {
                    $('.edit_submit_btn').removeAttr('disabled').html('Submit')

                    if (response.status == 200) {
                        const updatedProducts = response.products
                        $('#addVendorForm')[0].reset()

                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success',
                            customClass: {
                                popup: 'swal-custom-popup',
                            },
                        })

                        // Toast Notification
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true,
                            customClass: {
                                popup: 'swal-custom-popup',
                            },
                            didOpen: (toast) => {
                                toast.onmouseenter = Swal.stopTimer
                                toast.onmouseleave = Swal.resumeTimer
                            },
                        })

                        Toast.fire({
                            icon: 'success',
                            title: response.message,
                        })

                        // Redirect after success
                        setTimeout(function() {
                            window.location.reload()
                        }, 1500)
                    } else {
                        Swal.fire('Error', 'Unexpected response from server.', 'error')
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    $('.edit_submit_btn').removeAttr('disabled').html('Submit')

                    console.log(textStatus + ': ' + errorThrown)
                    Swal.fire(textStatus.toUpperCase(), errorThrown, 'warning')
                },
            })
        })
    </script>
@endpush