@extends('layout.app')
@section('main_content')
    <div class="col-lg-12">
        <div class="card card-h-100">
            <div class="card-body">
                <div class="mb-5 text-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubcategoryModal">
                        Add Hot Deal
                    </button>
                </div>
                {{-- {{ $dataTable->table() }} --}}
                <div class="container">
                    <h2 class="mb-4">Hot Deals</h2>
                    <div class="table-responsive">
                        <table id="projectsTable" class="table table-bordered table-hover nowrap dt-responsive w-100 mt-5">
                            <thead>
                                <tr class="table-warning">
                                    <th>S.NO</th>
                                    <th>Product Name</th>
                                    <th>Offer Value(%)</th>
                                    <th>Offer Price</th>
                                    <th>Offer Start Date</th>
                                    <th>Offer End Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addSubcategoryModal" tabindex="-1" aria-labelledby="addSubcategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addSubcategoryModalLabel">Add Hot Deal</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="hot_deal_add_form">
                        <div class="mb-3">
                            <label for="add_deal_prod_select" class="form-label">Choose product</label>
                            <select class="form-select" aria-label="Default select example" id="add_deal_prod_select"
                                name="add_deal_prod_select">
                                <option selected>Choose Product</option>
                                @foreach ($prodVarients as $prodVarient)
                                    <option value="{{ $prodVarient->id }}">{{ $prodVarient->varient_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="add_deal_percentage_input" class="form-label">Offer Percentage</label>
                            <input type="text" class="form-control" id="add_deal_percentage_input"
                                placeholder="Enter Offer Percentage" name="add_deal_percentage_input">
                        </div>
                        <div class="mb-3">
                            <label for="add_deal_Actual_price" class="form-label">Product Actual Price</label>
                            <input type="text" class="form-control" id="add_deal_Actual_price"
                                placeholder="Product Actual Price" name="add_deal_Actual_price" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="add_deal_offer_price" class="form-label">Product Offer Price</label>
                            <input type="text" class="form-control" id="add_deal_offer_price"
                                placeholder="Product Offer Price" name="add_deal_offer_price" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="add_deal_start_date" class="form-label">Offer Start Date</label>
                            <input type="date" class="form-control" id="add_deal_start_date"
                                placeholder="Offer Start Date" name="add_deal_start_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="add_deal_end_date" class="form-label">Offer End Date</label>
                            <input type="date" class="form-control" id="add_deal_end_date" placeholder="Offer End Date"
                                name="add_deal_end_date" required>
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
    <div class="modal fade" id="editsubcategoryModal" tabindex="-1" aria-labelledby="editsubcategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editsubcategoryModalLabel">Edit Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="hot_deal_edit_form">
                        <div class="mb-3">
                            <label for="edit_deal_prod_select" class="form-label">Choose product</label>
                            <select class="form-select" aria-label="Default select example" id="edit_deal_prod_select"
                                name="edit_deal_prod_select">
                                <option selected>Choose Product</option>
                                @foreach ($prodVarients as $prodVarient)
                                    <option value="{{ $prodVarient->id }}">{{ $prodVarient->varient_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="edit_deal_percentage_input" class="form-label">Offer Percentage</label>
                            <input type="text" class="form-control" id="edit_deal_percentage_input"
                                placeholder="Enter Offer Percentage" name="edit_deal_percentage_input">
                        </div>
                        <div class="mb-3">
                            <label for="edit_deal_Actual_price" class="form-label">Product Actual Price</label>
                            <input type="text" class="form-control" id="edit_deal_Actual_price"
                                placeholder="Product Actual Price" name="edit_deal_Actual_price" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="edit_deal_offer_price" class="form-label">Product Offer Price</label>
                            <input type="text" class="form-control" id="edit_deal_offer_price"
                                placeholder="Product Offer Price" name="edit_deal_offer_price" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="edit_deal_start_date" class="form-label">Offer Start Date</label>
                            <input type="date" class="form-control" id="edit_deal_start_date"
                                placeholder="Offer Start Date" name="edit_deal_start_date" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_deal_end_date" class="form-label">Offer End Date</label>
                            <input type="date" class="form-control" id="edit_deal_end_date"
                                placeholder="Offer End Date" name="edit_deal_end_date" required>
                            <input type="hidden" id="edit_hot_deal_id">
                        </div>
                        <div class="text-end gap-4">
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
            var table = $("#projectsTable").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "/hotdeals/fetchallhotdeals",
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
                        data: "productname",
                    },
                    {
                        data: "offervalue",
                    },
                    {
                        data: "offerprice",
                    },
                    {
                        data: "offerstartdate",
                    },
                    {
                        data: "offerenddate",
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
            $(document).on('click', '.edit-subcategory-btn', function() {
                let subcategoryId = $(this).data('id');
                let subcategoryName = $(this).data('name');
                let categoryName = $(this).data('catname');

                $('#subcategory_edit_id').val(subcategoryId);
                $('#subcategory_edit_input').val(subcategoryName);
                $('#category_edit_select').val(categoryName);
                $('#category_edit_form').attr('action', '/category/update/' + categoryId);
            })



        });
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('change', '#add_deal_prod_select', function() {
                let varientid = $(this).val();

                $.ajax({
                    type: 'POST',
                    url: '/hotdeals/proddetailsfetch',
                    data: {
                        varientid: varientid,
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        if (response.status == 200) {
                            $('#add_deal_Actual_price').val(response.productdetails.mrp_price)
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text: response.message ||
                                    'An unexpected error occurred.',
                                icon: 'error',
                            })
                            console.log(response.message)
                        }
                    },
                    error: function(xhr) {
                        $('.preloader').fadeOut()

                        Swal.fire({
                            title: 'Error',
                            text: xhr.responseJSON?.message || 'An error occurred.',
                            icon: 'error',
                        })
                    },
                })
            })
        })
    </script>

    <script>
        $(document).ready(function() {
            $('#add_deal_percentage_input').on('input', function() {
                const percentageInput = $(this).val().replace('%', '').trim();
                const actualPrice = parseFloat($('#add_deal_Actual_price').val());

                if (!isNaN(percentageInput) && !isNaN(actualPrice)) {
                    const discount = (actualPrice * parseFloat(percentageInput)) / 100;
                    const offerPrice = actualPrice - discount;
                    $('#add_deal_offer_price').val(offerPrice.toFixed(2));
                } else {
                    $('#add_deal_offer_price').val('');
                }
            });

            var today = new Date().toISOString().split('T')[0];
            $('#add_deal_start_date').attr('min', today);

            // When start date changes, set it as min for end date
            $('#add_deal_start_date').on('change', function() {
                var startDate = $(this).val();
                $('#add_deal_end_date').attr('min', startDate);
            });
        });
    </script>

    <script>
        $(document).on('submit', '#hot_deal_add_form', function(event) {
            event.preventDefault() // Prevent default form submission

            let varientid = $('#add_deal_prod_select').val();
            let offerprice = $('#add_deal_offer_price').val();
            let offerpercentage = $('#add_deal_percentage_input').val();
            let offeractualprice = $('#add_deal_Actual_price').val();
            let offerstartdate = $('#add_deal_start_date').val();
            let offerenddate = $('#add_deal_end_date').val();

            // AJAX Submission
            $.ajax({
                type: 'POST',
                url: '/hotdeals/store', // Changed from "/logout" to "/login"
                data: {
                    varientid: varientid,
                    offerprice: offerprice,
                    offerpercentage: offerpercentage,
                    offeractualprice: offeractualprice,
                    offerstartdate: offerstartdate,
                    offerenddate: offerenddate,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                beforeSend: function() {
                    $('.preloader').fadeIn()
                },
                success: function(response) {
                    $('.preloader').fadeOut()
                    console.log(response)
                    if (response.status == 200) {
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
                        Swal.fire({
                            title: 'Error',
                            text: response.message || 'An unexpected error occurred.',
                            icon: 'error',
                        })
                        console.log(response.message)
                    }
                },
                error: function(xhr) {
                    $('.preloader').fadeOut()

                    Swal.fire({
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'An error occurred.',
                        icon: 'error',
                    })
                },
            })
        })
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.edit-hot-deal-btn', function() {
                let dealid = $(this).data('id');
                let varientid = $(this).data('varientid')
                let offervalue = $(this).data('offervalue')
                let offerprice = $(this).data('offerprice')
                let offerstartdate = $(this).data('offerstartdate')
                let offerenddate = $(this).data('offerenddate')
                let actualprice = $(this).data('actualprice')

                $('#edit_deal_prod_select').val(varientid);
                $('#edit_deal_percentage_input').val(offervalue);
                $('#edit_deal_Actual_price').val(actualprice);
                $('#edit_deal_offer_price').val(offerprice);
                $('#edit_deal_start_date').val(offerstartdate);
                $('#edit_deal_end_date').val(offerenddate);
                $('#edit_hot_deal_id').val(dealid);
            })
        })
    </script>

    <script>
        $(document).on('submit', '#hot_deal_edit_form', function(event) {
            event.preventDefault() // Prevent default form submission

            let dealid = $('#edit_hot_deal_id').val();
            let varientid = $('#edit_deal_prod_select').val();
            let offerprice = $('#edit_deal_offer_price').val();
            let offerpercentage = $('#edit_deal_percentage_input').val();
            let offeractualprice = $('#edit_deal_Actual_price').val();
            let offerstartdate = $('#edit_deal_start_date').val();
            let offerenddate = $('#edit_deal_end_date').val();

            // AJAX Submission
            $.ajax({
                type: 'POST',
                url: '/hotdeals/update', // Changed from "/logout" to "/login"
                data: {
                    varientid: varientid,
                    offerprice: offerprice,
                    offerpercentage: offerpercentage,
                    offeractualprice: offeractualprice,
                    offerstartdate: offerstartdate,
                    offerenddate: offerenddate,
                    dealid: dealid,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                beforeSend: function() {
                    $('.preloader').fadeIn()
                },
                success: function(response) {
                    $('.preloader').fadeOut()
                    console.log(response)
                    if (response.status == 200) {
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
                        Swal.fire({
                            title: 'Error',
                            text: response.message || 'An unexpected error occurred.',
                            icon: 'error',
                        })
                        console.log(response.message)
                    }
                },
                error: function(xhr) {
                    $('.preloader').fadeOut()

                    Swal.fire({
                        title: 'Error',
                        text: xhr.responseJSON?.message || 'An error occurred.',
                        icon: 'error',
                    })
                },
            })
        })
    </script>

    <script>
        $(document).ready(function() {
            $('#edit_deal_percentage_input').on('input', function() {
                const percentageInput = $(this).val().replace('%', '').trim();
                const actualPrice = parseFloat($('#edit_deal_Actual_price').val());

                if (!isNaN(percentageInput) && !isNaN(actualPrice)) {
                    const discount = (actualPrice * parseFloat(percentageInput)) / 100;
                    const offerPrice = actualPrice - discount;
                    $('#edit_deal_offer_price').val(offerPrice.toFixed(2));
                } else {
                    $('#edit_deal_offer_price').val('');
                }
            });

            var today = new Date().toISOString().split('T')[0];
            $('#edit_deal_start_date').attr('min', today);

            // When start date changes, set it as min for end date
            $('#edit_deal_start_date').on('change', function() {
                var startDate = $(this).val();
                $('#edit_deal_end_date').attr('min', startDate);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('click', '.delete-hot-deal-btn', function() {

                let dealid = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You want to delete?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                    'content'
                                ),
                            },
                        })
                        $.ajax({
                            type: 'POST',
                            url: '/hotdeals/delete',
                            data: {
                                dealid: dealid,
                            },
                            beforeSend: function() {
                                $('.preloader').fadeIn()
                            },
                            success: function(response) {
                                $('.preloader').fadeOut()

                                if (response.status == 200) {
                                    Swal.fire({
                                        title: 'Success',
                                        text: response.message,
                                        icon: 'success',
                                        customClass: {
                                            popup: 'swal-custom-popup',
                                        },
                                    })

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
                                            toast.onmouseenter = Swal
                                                .stopTimer
                                            toast.onmouseleave = Swal
                                                .resumeTimer
                                        },
                                    })

                                    Toast.fire({
                                        icon: 'success',
                                        title: response.message,
                                    })

                                    setTimeout(function() {
                                        window.location.reload();
                                    }, 1500)
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message ||
                                            'An unexpected error occurred.',
                                        icon: 'error',
                                    })
                                    console.log(response.message)
                                }
                            },
                            error: function(xhr) {
                                $('.preloader').fadeOut()

                                Swal.fire({
                                    title: 'Error',
                                    text: xhr.responseJSON?.message ||
                                        'An error occurred.',
                                    icon: 'error',
                                })

                                setTimeout(function() {
                                    window.location.reload();
                                }, 1500);
                            },
                        })
                    }
                })
            })
        })
    </script>
@endpush
