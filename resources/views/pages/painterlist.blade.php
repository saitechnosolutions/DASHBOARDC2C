@extends('layout.app')
@section('main_content')
    <div class="col-lg-12">
        <div class="card card-h-100">
            <div class="card-body">
                {{-- <div class="mb-5 text-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addcategoryModal">
                        
                    </button>
                </div> --}}
                <div class="container">
                    <h2 class="mb-4">Painters</h2>
                    <div class="table-responsive">
                        <table id="projectsTable" class="table table-bordered table-hover nowrap dt-responsive w-100 mt-5">
                            <thead>
                                <tr class="table-warning">
                                    <th>S.NO</th>
                                    <th>Painter name</th>
                                    <th>Painter Email</th>
                                    <th>Painter Mobile Number</th>
                                    <th>Painter State</th>
                                    <th>Painter City</th>
                                    <th>Painter Address</th>
                                    <th>Painter Pincode</th>
                                    <th>Painter Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- View Painter Modal -->
    <div class="modal fade" id="viewPainterModal" tabindex="-1" aria-labelledby="viewPainterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewPainterModalLabel">Painter Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Content will be loaded dynamically -->
                    <div id="painterDetailsContainer">
                        <form action="" id="painter_verification_form">
                            <label for="exampleFormControlInput1" class="form-label">Verification Status</label>
                            <select class="form-select mb-5" aria-label="Default select example"
                                id="painter_approval_select">
                                <option value="0" selected>Not Verified</option>
                                <option value="1">Verified</option>
                            </select>
                            <div class="mb-3">
                                <label for="approve_painter_category_select" class="form-label">Choose Category</label>
                                <select class="form-select" aria-label="Default select example"
                                    id="approve_painter_category_select" name="approve_painter_category_select">
                                    <option selected>Choose Product</option>
                                    @foreach ($paintercategory as $category)
                                        <option value="{{ $category->id }}">{{ $category->painter_category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="approve_painter_description_input" class="form-label">Choose Category</label>
                                <textarea class="form-control" placeholder="Painter Description" id="approve_painter_description_input"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="approve_painter_image_upload" class="form-label">Choose Category</label>
                                <input type="file" class="form-control" id="approve_painter_image_upload"
                                    placeholder="painter Image" accept="image/*" name="approve_painter_image_upload"
                                    required>
                            </div>
                            <input type="hidden" name="" id="approval_painter_id">
                            <button class="btn btn-success" type="submit" id="approve_painter_submit">
                                Submit
                            </button>
                        </form>
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
                    url: "/painter/fetchAllPainters",
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
                        data: "paintername",
                    },
                    {
                        data: "painteremail",
                    },
                    {
                        data: "paintermobile",
                    },
                    {
                        data: "painterstate",
                    },
                    {
                        data: "paintercity",
                    },
                    {
                        data: "painteraddress",
                    },
                    {
                        data: "painterpincode",
                    },
                    {
                        data: "painterStatus",
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
            $(document).on('click', '.approve-painter-btn', function() {
                let painterId = $(this).data('id');

                $("#approval_painter_id").val(painterId);
            })
        })
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('submit', '#painter_verification_form', function(e) {
                e.preventDefault()

                let formData = new formData('#painter_verification_form')[0];

                let approvalStat = $('#painter_approval_select').val();
                let painterId = $('#approval_painter_id').val();


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                })

                $.ajax({
                    url: '/painter/approvepainter',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        approvalStat: approvalStat,
                        painterId: painterId,
                    },
                    beforeSend: function() {
                        $('#approve_painter_submit')
                            .attr('disabled', true)
                            .html('Processing...')
                    },
                    success: function(response) {
                        $('#approve_painter_submit').removeAttr('disabled').html('Submit')

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
                            Swal.fire('Error', 'Unexpected response from server.', 'error')
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('#approve_painter_submit').removeAttr('disabled').html('Submit')

                        console.log(textStatus + ': ' + errorThrown)
                        Swal.fire(textStatus.toUpperCase(), errorThrown, 'warning')
                    },
                })
            })
        });
    </script>
@endpush
