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
                    <h2 class="mb-4">Contractors</h2>
                    <div class="table-responsive">
                        <table id="projectsTable" class="table table-bordered table-hover nowrap dt-responsive w-100 mt-5">
                            <thead>
                                <tr class="table-warning">
                                    <th>S.NO</th>
                                    <th>Contractor name</th>
                                    <th>Contractor Email</th>
                                    <th>Contractor Mobile Number</th>
                                    <th>Contractor State</th>
                                    <th>Contractor City</th>
                                    <th>Contractor Address</th>
                                    <th>Contractor Pincode</th>
                                    <th>Contractor Status</th>
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
                    <h5 class="modal-title" id="viewPainterModalLabel">Contractor Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Content will be loaded dynamically -->
                    <div id="painterDetailsContainer">
                        <form action="" id="contractor_verification_form">
                            <label for="exampleFormControlInput1" class="form-label">Verification Status</label>
                            <select class="form-select mb-5" aria-label="Default select example"
                                id="contractor_approval_select">
                                <option value="0" selected>Not Verified</option>
                                <option value="1">Verified</option>
                            </select>
                            <input type="hidden" name="" id="approval_contractor_id">
                            <button class="btn btn-success" type="submit" id="approve_contractor_submit">
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
    {{-- {{ $dataTable->scripts(attributes: ['type' => 'module']) }} --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>

    <script>
        $(document).ready(function() {
            var table = $("#projectsTable").DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "/contractor/fetchAllContractors",
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
                        data: "contractorname",
                    },
                    {
                        data: "contractoremail",
                    },
                    {
                        data: "contractormobile",
                    },
                    {
                        data: "contractorstate",
                    },
                    {
                        data: "contractorcity",
                    },
                    {
                        data: "contractoraddress",
                    },
                    {
                        data: "contractorpincode",
                    },
                    {
                        data: "contractorStatus",
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
            $(document).on('click', '.approve-contractor-btn', function() {
                let contractorId = $(this).data('id');

                $("#approval_contractor_id").val(contractorId);
            })
        })
    </script>

    <script>
        $(document).ready(function() {
            $(document).on('submit', '#contractor_verification_form', function(e) {
                e.preventDefault()

                let approvalStat = $('#contractor_approval_select').val();
                let contractorId = $('#approval_contractor_id').val();


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                })

                $.ajax({
                    url: '/contractor/approvecontractor',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        approvalStat: approvalStat,
                        contractorId: contractorId,
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
