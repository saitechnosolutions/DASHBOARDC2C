@extends('layout.app')
@section('main_content')
    <div class="col-lg-12">
        <div class="card card-h-100">
            <div class="card-body">
                {{-- <div class="mb-5 text-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addcategoryModal">
                        Add Category
                    </button>
                </div> --}}
                {{-- {{ $dataTable->table() }} --}}
                <div class="container">
                    <h2 class="mb-4">Orders</h2>
                    <div class="table-responsive">
                        <table id="projectsTable" class="table table-bordered table-hover nowrap dt-responsive w-100 mt-5">
                            <thead>
                                <tr class="table-warning">
                                    <th>S.NO</th>
                                    <th>Order ID</th>
                                    <th>Customer Name</th>
                                    <th>Order Value</th>
                                    <th>Order Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addcategoryModal" tabindex="-1" aria-labelledby="addcategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addcategoryModalLabel">Add Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="category_add_form">
                        <div class="mb-3">
                            <label for="category_add_input" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="category_add_input" name="category_add_input"
                                placeholder="Enter Category Name">
                        </div>
                        <div class="mb-3">
                            <label for="category_add_input" class="form-label">Category Name</label>
                            <input type="file" class="form-control" id="add_category_image" placeholder="Category Image"
                                accept="image/*" name="add_category_image" required>
                        </div>
                        <div class="text-end gap-4">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Category Modal --}}
    <div class="modal fade" id="editcategoryModal" tabindex="-1" aria-labelledby="editcategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editcategoryModalLabel">View Order Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="order-details_table_append">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            var table = $("#projectsTable").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "/order/fetchallorder",
                    type: "POST",
                    data: function(d) {
                        d.executive = $("#executive").val();
                        d.lead_id = $("#lead_id").val();
                        d.type = $("#type").val();
                        d.method = $("#method").val();
                        d.branch = $("#branch").val();
                        d.state = $("#state").val();
                        d.city = $("#city").val();
                        d.fdate = $("#fff_date").val();
                        d.tdate = $("#ttt_date").val();
                        d._token = $('meta[name="csrf-token"]').attr("content");
                    },
                },
                columns: [{
                        data: "sno",
                    },
                    {
                        data: "orderid",
                    },
                    {
                        data: "customername",
                    },
                    {
                        data: "ordervalue",
                    },
                    {
                        data: "orderdate",
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

    <script>
        $(document).ready(function() {

            // Handle Edit Button Click
            $(document).on('click', '.edit-category-btn', function() {
                let categoryId = $(this).data('id');
                let categoryName = $(this).data('name');

                //             Try me!
                // Swal.fire({
                //   title: "Updated!",
                //   icon: "success",
                //   draggable: true
                // });

                $('#editCategoryId').val(categoryId);
                $('#editCategoryName').val(categoryName);
                $('#category_edit_form').attr('action', '/category/update/' + categoryId);
            })



        });
    </script>

    <script>
        $(document).on('submit', '.deleteCategoryForm', function(e) {
            e.preventDefault();

            const form = this;

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // form will be submitted, then handled by Laravel
                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.view-order-details-btn', function() {

                let order_id = $(this).data('id');

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                });

                $.ajax({
                    url: '/order/fetchorderdetails',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        order_id: order_id,
                    },
                    beforeSend: function() {
                        $('.add_submit_btn').attr('disabled', true).html('Processing...');
                    },
                    success: function(response) {
                        $('.add_submit_btn').removeAttr('disabled').html('Submit');

                        let products = response.order_details; // assuming array of products
                        console.log(products);

                        let tableHtml = `
                        <table class="table table-bordered mt-3">
                            <thead>
                                <tr>
                                    <th>S No</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>`;

                        products.forEach((product, index) => {
                            tableHtml += `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${product.product.product_name}</td>
                                <td>${product.quantity}</td>
                                <td>${product.prod_price}</td>
                            </tr>`;
                        });

                        tableHtml += `</tbody></table>`;

                        $('#editcategoryModal .modal-body').html(tableHtml);
                        $('#editcategoryModal').modal('show');
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('.add_submit_btn').removeAttr('disabled').html('Submit');
                        console.log(textStatus + ': ' + errorThrown);
                        Swal.fire(textStatus.toUpperCase(), errorThrown, 'warning');
                    },
                });

            });
        });
    </script>
@endpush
