@extends('layout.app')
@section('main_content')
    <style>
        .select2-container {
            z-index: 1055 !important;
            /* Bootstrap modal default is 1050 */
        }
    </style>
    <div class="col-lg-12">
        <div class="card card-h-100">
            <div class="card-body">
                <div class="container">
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <h2 class="mb-4">Projects</h2>
                        </div>
                        <div class="col-lg-6 text-end">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Add Project
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="projectviewTable"
                            class="table table-bordered table-hover nowrap dt-responsive w-100 mt-5">
                            <thead>
                                <tr class="table-warning">
                                    <th>S.NO</th>
                                    <th>Project Title</th>
                                    <th>Project Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Project</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="add_project_form">
                        <div class="mb-3">
                            <label for="form-label">Project Title</label>
                            <input type="text" name="add_project_title" id="add_project_title" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="form-label">Project Display Image</label>
                            <input type="file" name="add_project_image" id="add_project_image" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="form-label">Project Products</label>
                            <select class="form-control form-select select2" name="add_project_products[]"
                                multiple="multiple" id="add_project_products" required style="z-index: 9999">
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">
                                        {{ $product->product_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="projectproductModal" tabindex="-1" aria-labelledby="projectproductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="projectproductModalLabel">Edit Project</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="edit_project_form">
                        <div class="mb-3">
                            <label for="form-label">Project Title</label>
                            <input type="text" name="edit_project_title" id="edit_project_title" class="form-control">
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="form-label">Project Display Image</label>
                                    <input type="file" name="edit_project_image" id="edit_project_image"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <img id="edit_project_image_preview" src="" alt="Project Image" class="img-fluid">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="form-label">Project Products</label>
                            <select class="form-control form-select select2" name="edit_project_products[]"
                                multiple="multiple" id="edit_project_products" required style="z-index: 9999">
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">
                                        {{ $product->product_name }}
                                    </option>
                                @endforeach
                            </select>
                            <input type="hidden" name="project_id" id="hidden_project_id">
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Save changes</button>
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
            $('#add_project_products').select2({
                placeholder: "Select Products",
                allowClear: true,
                width: '100%' // Ensure it expands fully
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            var table = $("#projectviewTable").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "/projects/fetchallprojects",
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
                        data: "projecttitle",
                    },
                    {
                        data: "projectimage",
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
            $('#edit_project_products').select2({
                placeholder: "Select Products",
                allowClear: true,
                width: '100%'
            });
            $(document).on('click', '.edit-project-products-btn', function() {
                let projectId = $(this).data('id');
                let projectName = $(this).data('name');
                let projectImage = $(this).data('image');
                let projectProducts = $(this).data('products'); // this will be an array

                // Set input values
                $('#edit_project_title').val(projectName);
                $('#hidden_project_id').val(projectId);

                // Set preview image
                let imageUrl = `${window.location.origin}/uploads/projects/${projectImage}`;
                $('#edit_project_image').closest('.row').find('img').attr('src', imageUrl);

                // Set Select2 selected values
                $('#edit_project_products').val(projectProducts);
            });

            // Initialize select2
            if (Array.isArray(projectProducts)) {
                $('#edit_project_products').val(projectProducts.map(String)).trigger('change');
            }
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

    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endpush
