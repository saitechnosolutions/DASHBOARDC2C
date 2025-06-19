@extends('layout.app')
@section('main_content')
    <div class="col-lg-12">
        <div class="card card-h-100">
            <div class="card-body">
                <div class="mb-5 text-end">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop1">
                        Add Offers
                    </button>
                </div>
                <div class="container overflow-hidden">
                    <h2 class="mb-4">Offers</h2>
                    <table id="projectsTable" class="table table-bordered table-hover nowrap w-100 mt-5">
                        <thead>
                            <tr class="">
                                <th>S.NO</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Offer Price</th>
                                <th>Offer End Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- ADD MODAL --}}
    <div class="modal fade" id="staticBackdrop1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Stock</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="add_prod_offer_form">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Product</label>
                            <select class="form-select" aria-label="Default select example" id="add_prod_offer_select">
                                <option selected>Choose Product</option>
                                @foreach ($products as $prod)
                                    <option value="{{ $prod->id }}">{{ $prod->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="formFileMultiple" class="form-label">Product Price</label>
                            <input class="form-control" type="text" id="add_product_price">
                        </div>
                        <div class="mb-3">
                            <label for="formFileDisabled" class="form-label">Offer Price</label>
                            <input class="form-control" type="text" id="add_offer_price">
                        </div>
                        <div class="mb-3">
                            <label for="formFileDisabled" class="form-label">Offer End Date</label>
                            <input class="form-control" type="date" id="add_offer_end_date">
                        </div>

                        <input type="hidden" name="" value="{{ Auth::user()->id }}" id="add_offer_vendor_id">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="add_offer_submit_btn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- EDIT MODAL --}}
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Stock</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="edit_prod_offer_form">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Product</label>
                            <select class="form-select" aria-label="Default select example" id="edit_offer_prod_select">
                                <option selected>Choose Product</option>
                                @foreach ($products as $prod)
                                    <option value="{{ $prod->id }}">{{ $prod->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="formFileMultiple" class="form-label">Product Price</label>
                            <input class="form-control" type="text" id="edit_offer_prod_price">
                        </div>
                        <div class="mb-3">
                            <label for="formFileDisabled" class="form-label">Offer Price</label>
                            <input class="form-control" type="text" id="edit_offer_price">
                        </div>
                        <div class="mb-3">
                            <label for="formFileDisabled" class="form-label">Offer End Date</label>
                            <input class="form-control" type="date" id="edit_offer_end_date">
                        </div>
                        <input type="hidden" name="" id="edit_offer_id">
                        <input type="hidden" name="" id="edit_offer_vendor_id">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="edit_offer_submit_btn">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            var table = $("#projectsTable").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "/vendor/fetchoffers",
                    type: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                },
                columns: [{
                        data: "sno",
                    },
                    {
                        data: "productname",
                    },
                    {
                        data: "productprice",
                    },
                    {
                        data: "offerprice",
                    },
                    {
                        data: "enddate",
                    },
                    {
                        data: "action",
                    },

                ],
                responsive: true,
                pageLength: 10,
                dom: "Bfrtip",
                buttons: [{
                        extend: "excelHtml5",
                        text: "Excel",
                        action: function(e, dt, button, config) {
                            var self = this;
                            var originalLength = dt.page.len();
                            $("#preloader").show();
                            dt.one("preXhr", function(e, s, data) {
                                data.length = -1; // Fetch all data
                            }).one("draw", function(e, settings, json) {
                                $.fn.dataTable.ext.buttons.excelHtml5.action.call(
                                    self,
                                    e,
                                    dt,
                                    button,
                                    $.extend(true, {}, config, {
                                        exportOptions: {
                                            columns: ":visible,:hidden", // Include all columns
                                        },
                                    })
                                );
                                dt.one("preXhr", function(e, s, data) {
                                    settings._iDisplayLength =
                                        originalLength; // Restore original length
                                    data.length = originalLength;
                                });
                                dt.ajax.reload();
                                $("#preloader").hide();
                            });
                            dt.ajax.reload();
                        },
                    },
                    {
                        extend: "csvHtml5",
                        text: "CSV",
                        action: function(e, dt, button, config) {
                            var self = this;
                            var originalLength = dt.page.len();
                            $("#preloader").show();
                            dt.one("preXhr", function(e, s, data) {
                                data.length = -1; // Fetch all data
                            }).one("draw", function(e, settings, json) {
                                $.fn.dataTable.ext.buttons.csvHtml5.action.call(
                                    self,
                                    e,
                                    dt,
                                    button,
                                    $.extend(true, {}, config, {
                                        exportOptions: {
                                            columns: ":visible,:hidden", // Include all columns
                                        },
                                    })
                                );
                                dt.one("preXhr", function(e, s, data) {
                                    settings._iDisplayLength =
                                        originalLength; // Restore original length
                                    data.length = originalLength;
                                });
                                dt.ajax.reload();
                                $("#preloader").hide();
                            });
                            dt.ajax.reload();
                        },
                    },
                    {
                        extend: "pdfHtml5",
                        text: "PDF",
                        action: function(e, dt, button, config) {
                            var self = this;
                            var originalLength = dt.page.len();
                            $("#preloader").show();
                            dt.one("preXhr", function(e, s, data) {
                                data.length = -1; // Fetch all data
                            }).one("draw", function(e, settings, json) {
                                $.fn.dataTable.ext.buttons.pdfHtml5.action.call(
                                    self,
                                    e,
                                    dt,
                                    button,
                                    $.extend(true, {}, config, {
                                        exportOptions: {
                                            columns: ":visible,:hidden", // Include all columns
                                        },
                                    })
                                );
                                dt.one("preXhr", function(e, s, data) {
                                    settings._iDisplayLength =
                                        originalLength; // Restore original length
                                    data.length = originalLength;
                                });
                                dt.ajax.reload();
                                $("#preloader").hide();
                            });
                            dt.ajax.reload();
                        },
                    },
                    {
                        extend: "print",
                        text: "Print",
                        action: function(e, dt, button, config) {
                            var self = this;
                            var originalLength = dt.page.len();
                            $("#preloader").show();
                            dt.one("preXhr", function(e, s, data) {
                                data.length = -1; // Fetch all data
                            }).one("draw", function(e, settings, json) {
                                $.fn.dataTable.ext.buttons.print.action.call(
                                    self,
                                    e,
                                    dt,
                                    button,
                                    $.extend(true, {}, config, {
                                        exportOptions: {
                                            columns: ":visible,:hidden", // Include all columns
                                        },
                                    })
                                );
                                dt.one("preXhr", function(e, s, data) {
                                    settings._iDisplayLength =
                                        originalLength; // Restore original length
                                    data.length = originalLength;
                                });
                                dt.ajax.reload();
                                $("#preloader").hide();
                            });
                            dt.ajax.reload();
                        },
                    },
                    "colvis",
                ],
            });

            $(".Allleads-btn").click(function() {
                table.ajax.reload();
            });
        });
    </script>
@endsection
