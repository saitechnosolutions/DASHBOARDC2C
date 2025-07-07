$(document).ready(function () {
    var table = $('#projectsTable').DataTable({
        destroy: true,
        processing: true,
        serverSide: true,
        ajax: {
            url: '/order/fetchallorder',
            type: 'POST',
            data: function (d) {
                d.executive = $('#executive').val()
                d.lead_id = $('#lead_id').val()
                d.type = $('#type').val()
                d.method = $('#method').val()
                d.branch = $('#branch').val()
                d.state = $('#state').val()
                d.city = $('#city').val()
                d.fdate = $('#fff_date').val()
                d.tdate = $('#ttt_date').val()
                d._token = $('meta[name="csrf-token"]').attr('content')
            },
        },
        columns: [
            {
                data: 'sno',
            },
            {
                data: 'orderid',
            },
            {
                data: 'customername',
            },
            {
                data: 'ordervalue',
            },
            {
                data: 'orderdate',
            },
            {
                data: 'orderstatus',
            },
        ],
        responsive: true,
        pageLength: 10,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'Excel',
                action: function (e, dt, button, config) {
                    var self = this
                    var originalLength = dt.page.len()
                    $('#preloader').show()
                    dt.one('preXhr', function (e, s, data) {
                        data.length = -1 // Fetch all data
                    }).one('draw', function (e, settings, json) {
                        $.fn.dataTable.ext.buttons.excelHtml5.action.call(
                            self,
                            e,
                            dt,
                            button,
                            $.extend(true, {}, config, {
                                exportOptions: {
                                    columns: ':visible,:hidden', // Include all columns
                                },
                            })
                        )
                        dt.one('preXhr', function (e, s, data) {
                            settings._iDisplayLength = originalLength // Restore original length
                            data.length = originalLength
                        })
                        dt.ajax.reload()
                        $('#preloader').hide()
                    })
                    dt.ajax.reload()
                },
            },
            {
                extend: 'csvHtml5',
                text: 'CSV',
                action: function (e, dt, button, config) {
                    var self = this
                    var originalLength = dt.page.len()
                    $('#preloader').show()
                    dt.one('preXhr', function (e, s, data) {
                        data.length = -1 // Fetch all data
                    }).one('draw', function (e, settings, json) {
                        $.fn.dataTable.ext.buttons.csvHtml5.action.call(
                            self,
                            e,
                            dt,
                            button,
                            $.extend(true, {}, config, {
                                exportOptions: {
                                    columns: ':visible,:hidden', // Include all columns
                                },
                            })
                        )
                        dt.one('preXhr', function (e, s, data) {
                            settings._iDisplayLength = originalLength // Restore original length
                            data.length = originalLength
                        })
                        dt.ajax.reload()
                        $('#preloader').hide()
                    })
                    dt.ajax.reload()
                },
            },
            {
                extend: 'pdfHtml5',
                text: 'PDF',
                action: function (e, dt, button, config) {
                    var self = this
                    var originalLength = dt.page.len()
                    $('#preloader').show()
                    dt.one('preXhr', function (e, s, data) {
                        data.length = -1 // Fetch all data
                    }).one('draw', function (e, settings, json) {
                        $.fn.dataTable.ext.buttons.pdfHtml5.action.call(
                            self,
                            e,
                            dt,
                            button,
                            $.extend(true, {}, config, {
                                exportOptions: {
                                    columns: ':visible,:hidden', // Include all columns
                                },
                            })
                        )
                        dt.one('preXhr', function (e, s, data) {
                            settings._iDisplayLength = originalLength // Restore original length
                            data.length = originalLength
                        })
                        dt.ajax.reload()
                        $('#preloader').hide()
                    })
                    dt.ajax.reload()
                },
            },
            {
                extend: 'print',
                text: 'Print',
                action: function (e, dt, button, config) {
                    var self = this
                    var originalLength = dt.page.len()
                    $('#preloader').show()
                    dt.one('preXhr', function (e, s, data) {
                        data.length = -1 // Fetch all data
                    }).one('draw', function (e, settings, json) {
                        $.fn.dataTable.ext.buttons.print.action.call(
                            self,
                            e,
                            dt,
                            button,
                            $.extend(true, {}, config, {
                                exportOptions: {
                                    columns: ':visible,:hidden', // Include all columns
                                },
                            })
                        )
                        dt.one('preXhr', function (e, s, data) {
                            settings._iDisplayLength = originalLength // Restore original length
                            data.length = originalLength
                        })
                        dt.ajax.reload()
                        $('#preloader').hide()
                    })
                    dt.ajax.reload()
                },
            },
            'colvis',
        ],
    })

    $('.Allleads-btn').click(function () {
        table.ajax.reload()
    })
})

$(document).ready(function () {
    $(document).on('click', '#pills-pending-tab', function () {
        var table = $('#pendingordersTable').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: '/order/pending-order',
                type: 'POST',
                data: function (d) {
                    d.executive = $('#executive').val()
                    d.lead_id = $('#lead_id').val()
                    d.type = $('#type').val()
                    d.method = $('#method').val()
                    d.branch = $('#branch').val()
                    d.state = $('#state').val()
                    d.city = $('#city').val()
                    d.fdate = $('#fff_date').val()
                    d.tdate = $('#ttt_date').val()
                    d._token = $('meta[name="csrf-token"]').attr('content')
                },
            },
            columns: [
                {
                    data: 'sno',
                },
                {
                    data: 'orderid',
                },
                {
                    data: 'customername',
                },
                {
                    data: 'ordervalue',
                },
                {
                    data: 'orderdate',
                },
                {
                    data: 'action',
                },
            ],
            responsive: true,
            pageLength: 10,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    action: exportAllData('excelHtml5'),
                },
                {
                    extend: 'csvHtml5',
                    text: 'CSV',
                    action: exportAllData('csvHtml5'),
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    action: exportAllData('pdfHtml5'),
                },
                {
                    extend: 'print',
                    text: 'Print',
                    action: exportAllData('print'),
                },
                'colvis',
            ],
        })
    })

    $('.Allleads-btn').click(function () {
        table.ajax.reload()
    })
})

$(document).ready(function () {
    $(document).on('click', '#pills-profile-tab', function () {
        var table = $('#packedordersTable').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: '/order/packed-order',
                type: 'POST',
                data: function (d) {
                    d.executive = $('#executive').val()
                    d.lead_id = $('#lead_id').val()
                    d.type = $('#type').val()
                    d.method = $('#method').val()
                    d.branch = $('#branch').val()
                    d.state = $('#state').val()
                    d.city = $('#city').val()
                    d.fdate = $('#fff_date').val()
                    d.tdate = $('#ttt_date').val()
                    d._token = $('meta[name="csrf-token"]').attr('content')
                },
            },
            columns: [
                {
                    data: 'sno',
                },
                {
                    data: 'orderid',
                },
                {
                    data: 'customername',
                },
                {
                    data: 'ordervalue',
                },
                {
                    data: 'orderdate',
                },
                {
                    data: 'action',
                },
            ],
            responsive: true,
            pageLength: 10,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    action: exportAllData('excelHtml5'),
                },
                {
                    extend: 'csvHtml5',
                    text: 'CSV',
                    action: exportAllData('csvHtml5'),
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    action: exportAllData('pdfHtml5'),
                },
                {
                    extend: 'print',
                    text: 'Print',
                    action: exportAllData('print'),
                },
                'colvis',
            ],
        })
    })

    $('.Allleads-btn').click(function () {
        table.ajax.reload()
    })
})

$(document).ready(function () {
    $(document).on('click', '#pills-contact-tab', function () {
        var table = $('#dispatchedorderTable').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: '/order/dispatched-order',
                type: 'POST',
                data: function (d) {
                    d.executive = $('#executive').val()
                    d.lead_id = $('#lead_id').val()
                    d.type = $('#type').val()
                    d.method = $('#method').val()
                    d.branch = $('#branch').val()
                    d.state = $('#state').val()
                    d.city = $('#city').val()
                    d.fdate = $('#fff_date').val()
                    d.tdate = $('#ttt_date').val()
                    d._token = $('meta[name="csrf-token"]').attr('content')
                },
            },
            columns: [
                {
                    data: 'sno',
                },
                {
                    data: 'orderid',
                },
                {
                    data: 'customername',
                },
                {
                    data: 'ordervalue',
                },
                {
                    data: 'orderdate',
                },
                {
                    data: 'action',
                },
            ],
            responsive: true,
            pageLength: 10,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    action: exportAllData('excelHtml5'),
                },
                {
                    extend: 'csvHtml5',
                    text: 'CSV',
                    action: exportAllData('csvHtml5'),
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    action: exportAllData('pdfHtml5'),
                },
                {
                    extend: 'print',
                    text: 'Print',
                    action: exportAllData('print'),
                },
                'colvis',
            ],
        })
    })

    $('.Allleads-btn').click(function () {
        table.ajax.reload()
    })
})

$(document).ready(function () {
    $(document).on('click', '#pills-ofd-tab', function () {
        var table = $('#outfordeliveryTable').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: '/order/out-for-delivery-order',
                type: 'POST',
                data: function (d) {
                    d.executive = $('#executive').val()
                    d.lead_id = $('#lead_id').val()
                    d.type = $('#type').val()
                    d.method = $('#method').val()
                    d.branch = $('#branch').val()
                    d.state = $('#state').val()
                    d.city = $('#city').val()
                    d.fdate = $('#fff_date').val()
                    d.tdate = $('#ttt_date').val()
                    d._token = $('meta[name="csrf-token"]').attr('content')
                },
            },
            columns: [
                {
                    data: 'sno',
                },
                {
                    data: 'orderid',
                },
                {
                    data: 'customername',
                },
                {
                    data: 'ordervalue',
                },
                {
                    data: 'orderdate',
                },
                {
                    data: 'action',
                },
            ],
            responsive: true,
            pageLength: 10,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    action: exportAllData('excelHtml5'),
                },
                {
                    extend: 'csvHtml5',
                    text: 'CSV',
                    action: exportAllData('csvHtml5'),
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    action: exportAllData('pdfHtml5'),
                },
                {
                    extend: 'print',
                    text: 'Print',
                    action: exportAllData('print'),
                },
                'colvis',
            ],
        })
    })

    $('.Allleads-btn').click(function () {
        table.ajax.reload()
    })
})

$(document).ready(function () {
    $(document).on('click', '#pills-delivered-tab', function () {
        var table = $('#deliveredorderTable').DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: {
                url: '/order/delivered-order',
                type: 'POST',
                data: function (d) {
                    d.executive = $('#executive').val()
                    d.lead_id = $('#lead_id').val()
                    d.type = $('#type').val()
                    d.method = $('#method').val()
                    d.branch = $('#branch').val()
                    d.state = $('#state').val()
                    d.city = $('#city').val()
                    d.fdate = $('#fff_date').val()
                    d.tdate = $('#ttt_date').val()
                    d._token = $('meta[name="csrf-token"]').attr('content')
                },
            },
            columns: [
                {
                    data: 'sno',
                },
                {
                    data: 'orderid',
                },
                {
                    data: 'customername',
                },
                {
                    data: 'ordervalue',
                },
                {
                    data: 'orderdate',
                },
                {
                    data: 'delivereddate',
                },
            ],
            responsive: true,
            pageLength: 10,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    text: 'Excel',
                    action: exportAllData('excelHtml5'),
                },
                {
                    extend: 'csvHtml5',
                    text: 'CSV',
                    action: exportAllData('csvHtml5'),
                },
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    action: exportAllData('pdfHtml5'),
                },
                {
                    extend: 'print',
                    text: 'Print',
                    action: exportAllData('print'),
                },
                'colvis',
            ],
        })
    })

    $('.Allleads-btn').click(function () {
        table.ajax.reload()
    })
})

function exportAllData(type) {
    return function (e, dt, button, config) {
        const self = this
        const originalLength = dt.page.len()
        $('#preloader').show()

        dt.one('preXhr', function (e, s, data) {
            data.length = -1
        }).one('draw', function (e, settings, json) {
            $.fn.dataTable.ext.buttons[type].action.call(
                self,
                e,
                dt,
                button,
                $.extend(true, {}, config, {
                    exportOptions: {
                        columns: ':visible,:hidden',
                    },
                })
            )

            dt.one('preXhr', function (e, s, data) {
                settings._iDisplayLength = originalLength
                data.length = originalLength
            })
            dt.ajax.reload()
            $('#preloader').hide()
        })

        dt.ajax.reload()
    }
}

$(document).on('submit', '.deleteCategoryForm', function (e) {
    e.preventDefault()

    const form = this

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit() // form will be submitted, then handled by Laravel
        }
    })
})

$(document).ready(function () {
    $(document).on('click', '.view-order-details-btn', function () {
        let order_id = $(this).data('orderid')

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
        })

        $.ajax({
            url: '/order/fetchorderdetails',
            method: 'POST',
            dataType: 'json',
            data: {
                order_id: order_id,
            },
            beforeSend: function () {
                $('.add_submit_btn')
                    .attr('disabled', true)
                    .html('Processing...')
            },
            success: function (response) {
                $('.add_submit_btn').removeAttr('disabled').html('Submit')

                let products = response.order_details // assuming array of products
                console.log(products)

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
                    <tbody>`

                products.forEach((product, index) => {
                    tableHtml += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${product.product.product_name}</td>
                        <td>${product.quantity}</td>
                        <td>${product.prod_price}</td>
                    </tr>`
                })

                tableHtml += `</tbody></table>`

                $('#editcategoryModal .modal-body').html(tableHtml)
                $('#editcategoryModal').modal('show')
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('.add_submit_btn').removeAttr('disabled').html('Submit')
                console.log(textStatus + ': ' + errorThrown)
                Swal.fire(textStatus.toUpperCase(), errorThrown, 'warning')
            },
        })
    })
})

$(document).ready(function () {
    $(document).on('click', '.update-order-details-btn', function () {
        let order_id = $(this).data('orderid')

        $('#order_id_append').val(order_id)
        $('#editcategoryModalupdate').modal('show')
    })
})

$(document).ready(function () {
    $(document).on('click', '.update-packedorder-details-btn', function () {
        let order_id = $(this).data('orderid')

        $('#packed_order_id_append').val(order_id)
        $('#editcategoryModalPacked').modal('show')
    })
})

$(document).ready(function () {
    $(document).on('click', '.update-dispatchedorder-details-btn', function () {
        let order_id = $(this).data('orderid')

        $('#dispatched_order_id_append').val(order_id)
        $('#editcategoryModalDispatched').modal('show')
    })
})

$(document).ready(function () {
    $(document).on(
        'click',
        '.update-outfordeliveryorder-details-btn',
        function () {
            let order_id = $(this).data('orderid')

            $('#out_for_delivery_order_id_append').val(order_id)
            $('#editcategoryModalOutfordelivery').modal('show')
        }
    )
})

$(document).ready(function () {
    const ordervalidator = new JustValidate(
        '#initial_delivery_status_update_form'
    )

    ordervalidator
        .addField('#initial_order_status', [
            {
                rule: 'required',
                errorMessage: 'Please select an order status',
            },
        ])
        .onSuccess(() => {
            let orderId = $('#order_id_append').val()
            let orderStat = $('#initial_order_status').val()

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'
                    ),
                },
            })

            $.ajax({
                type: 'POST',
                url: '/order/change-status',
                data: {
                    orderId: orderId,
                    orderStat: orderStat,
                },
                beforeSend: function () {
                    $('.preloader').fadeIn()
                },
                success: function (response) {
                    $('.preloader').fadeOut()
                    if (response.status == 200) {
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success',
                        })
                        setTimeout(() => window.location.reload(), 1500)
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text:
                                response.message ||
                                'An unexpected error occurred.',
                            icon: 'error',
                        })
                    }
                },
                error: function (xhr) {
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

$(document).ready(function () {
    const ordervalidator = new JustValidate(
        '#packed_delivery_status_update_form'
    )

    ordervalidator
        .addField('#packed_order_status_select', [
            {
                rule: 'required',
                errorMessage: 'Please select an order status',
            },
        ])
        .onSuccess(() => {
            let orderId = $('#packed_order_id_append').val()
            let orderStat = $('#packed_order_status_select').val()

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'
                    ),
                },
            })

            $.ajax({
                type: 'POST',
                url: '/order/change-status',
                data: {
                    orderId: orderId,
                    orderStat: orderStat,
                },
                beforeSend: function () {
                    $('.preloader').fadeIn()
                },
                success: function (response) {
                    $('.preloader').fadeOut()
                    if (response.status == 200) {
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success',
                        })
                        setTimeout(() => window.location.reload(), 1500)
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text:
                                response.message ||
                                'An unexpected error occurred.',
                            icon: 'error',
                        })
                    }
                },
                error: function (xhr) {
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

$(document).ready(function () {
    const ordervalidator = new JustValidate(
        '#dispatched_delivery_status_update_form'
    )

    ordervalidator
        .addField('#dispatched_order_status_select', [
            {
                rule: 'required',
                errorMessage: 'Please select an order status',
            },
        ])
        .onSuccess(() => {
            let orderId = $('#dispatched_order_id_append').val()
            let orderStat = $('#dispatched_order_status_select').val()

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'
                    ),
                },
            })

            $.ajax({
                type: 'POST',
                url: '/order/change-status',
                data: {
                    orderId: orderId,
                    orderStat: orderStat,
                },
                beforeSend: function () {
                    $('.preloader').fadeIn()
                },
                success: function (response) {
                    $('.preloader').fadeOut()
                    if (response.status == 200) {
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success',
                        })
                        setTimeout(() => window.location.reload(), 1500)
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text:
                                response.message ||
                                'An unexpected error occurred.',
                            icon: 'error',
                        })
                    }
                },
                error: function (xhr) {
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

$(document).ready(function () {
    const ordervalidator = new JustValidate(
        '#out_for_delivery_status_update_form'
    )

    ordervalidator
        .addField('#out_for_delivery_order_status_select', [
            {
                rule: 'required',
                errorMessage: 'Please select an order status',
            },
        ])
        .onSuccess(() => {
            let orderId = $('#out_for_delivery_order_id_append').val()
            let orderStat = $('#out_for_delivery_order_status_select').val()

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'
                    ),
                },
            })

            $.ajax({
                type: 'POST',
                url: '/order/change-status',
                data: {
                    orderId: orderId,
                    orderStat: orderStat,
                },
                beforeSend: function () {
                    $('.preloader').fadeIn()
                },
                success: function (response) {
                    $('.preloader').fadeOut()
                    if (response.status == 200) {
                        Swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success',
                        })
                        setTimeout(() => window.location.reload(), 1500)
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text:
                                response.message ||
                                'An unexpected error occurred.',
                            icon: 'error',
                        })
                    }
                },
                error: function (xhr) {
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
