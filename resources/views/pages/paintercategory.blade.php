@extends('layout.app')
@section('main_content')
    <div class="col-lg-12">
        <div class="card card-h-100">
            <div class="card-body">
                <div class="mb-5 text-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addcategoryModal">
                        Add Painter Category
                    </button>
                </div>
                {{-- {{ $dataTable->table() }} --}}
                <div class="container">
                    <h2 class="mb-4">Painter Categories</h2>
                    <div class="table-responsive">
                        <table id="projectsTable" class="table table-bordered table-hover nowrap dt-responsive w-100 mt-5">
                            <thead>
                                <tr class="table-warning">
                                    <th>S.NO</th>
                                    <th>Category name</th>
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
                    <form action="" id="painter_category_add_form">
                        <div class="mb-3">
                            <label for="painter_category_add_input" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="painter_category_add_input"
                                name="painter_category_add_input" placeholder="Enter Category Name">
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
                    <h1 class="modal-title fs-5" id="editcategoryModalLabel">Edit Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="painter_category_edit_form" method="POST">
                        <input type="hidden" id="editCategoryId" name="id">

                        <div class="mb-3">
                            <label for="editCategoryName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="editpainterCategoryName" name="category_name"
                                placeholder="Enter Category Name">
                            <input type="hidden" id="edit_painter_category_id">
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
                    url: "/painter/category/fetchallcategory",
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
                        data: "categoryname",
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
        $(document).on('submit', '#painter_category_add_form', function(event) {
            event.preventDefault() // Prevent default form submission

            let categoryname = $('#painter_category_add_input').val();

            // AJAX Submission
            $.ajax({
                type: 'POST',
                url: '/painter/category/store', // Changed from "/logout" to "/login"
                data: {
                    categoryname: categoryname,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                beforeSend: function() {
                    $('.preloader').fadeIn()
                },
                success: function(response) {
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

            // Handle Edit Button Click
            $(document).on('click', '.edit-painter-category-btn', function() {
                let categoryId = $(this).data('id');
                let categoryName = $(this).data('categoryname');

                $('#edit_painter_category_id').val(categoryId);
                $('#editpainterCategoryName').val(categoryName);
                // $('#category_edit_form').attr('action', '/category/update/' + categoryId);
            })



        });
    </script>

    <script>
        $(document).on('submit', '#painter_category_edit_form', function(event) {
            event.preventDefault() // Prevent default form submission

            let categoryname = $('#editpainterCategoryName').val();
            let categoryid = $('#edit_painter_category_id').val();

            // AJAX Submission
            $.ajax({
                type: 'POST',
                url: '/painter/category/update', // Changed from "/logout" to "/login"
                data: {
                    categoryname: categoryname,
                    categoryid: categoryid,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                beforeSend: function() {
                    $('.preloader').fadeIn()
                },
                success: function(response) {
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
            $(document).on('click', '.delete-painter-category-btn', function() {

                let categoryid = $(this).data('id');

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
                            url: '/painter/category/delete',
                            data: {
                                categoryid: categoryid,
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
