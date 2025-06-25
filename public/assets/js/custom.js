// LOGIN AJAX

$(document).on('submit', '#Login_form', function (event) {
    event.preventDefault() // Prevent default form submission

    let username = $('#input_username').val()
    let password = $('#password_input').val()

    // AJAX Submission
    $.ajax({
        type: 'POST',
        url: '/login', // Changed from "/logout" to "/login"
        data: {
            username: username,
            password: password,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        beforeSend: function () {
            $('.preloader').fadeIn()
        },
        success: function (response) {
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
                setTimeout(function () {
                    window.location.href = '/dashboard'
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

window.onload = function () {
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href)
    }

    // Prevent back button from going back to login
    window.history.pushState(null, '', window.location.href)
    window.onpopstate = function () {
        window.history.go(1)
    }
}

$(document).ready(function () {
    $(document).on('click', '#user_Log_off', function () {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to Log Out?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Log Out',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content'
                        ),
                    },
                })

                // AJAX Submission
                $.ajax({
                    type: 'post',
                    url: '/logout',
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
                                    toast.onmouseenter = Swal.stopTimer
                                    toast.onmouseleave = Swal.resumeTimer
                                },
                            })

                            Toast.fire({
                                icon: 'success',
                                title: response.message,
                            })

                            setTimeout(function () {
                                window.location.href = '/'
                            }, 1500)
                        } else {
                            Swal.fire({
                                title: 'Error',
                                text:
                                    response.message ||
                                    'An unexpected error occurred.',
                                icon: 'error',
                            })
                            console.log(response.message)
                        }
                    },
                    error: function (xhr) {
                        $('.preloader').fadeOut()

                        Swal.fire({
                            title: 'Error',
                            text:
                                xhr.responseJSON?.message ||
                                'An error occurred.',
                            icon: 'error',
                        })

                        // setTimeout(function () {
                        //     window.location.reload();
                        // }, 1500);
                    },
                })
            }
        })
    })
})

// ========== CATEGORY ========== //

// ADD CATEGORY
$(document).on('submit', '#category_add_form', function (event) {
    event.preventDefault() // Prevent default form submission

    let formdata = new FormData($('#category_add_form')[0])

    // AJAX Submission
    $.ajax({
        type: 'POST',
        url: '/category/add', // Changed from "/logout" to "/login"
        data: formdata,
        processData: false, // Required for FormData
        contentType: false, // Required for FormData
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        beforeSend: function () {
            $('.preloader').fadeIn()
        },
        success: function (response) {
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
                setTimeout(function () {
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

// ========== SUBCATEGORY ========== //

// ADD SUBCATEGORY
$(document).on('submit', '#subcategory_add_form', function (event) {
    event.preventDefault() // Prevent default form submission

    // let category = $('#category_add_select').val()
    // let subcategoryname = $('#subcategory_add_input').val()

    let formdata = new FormData($('#subcategory_add_form')[0])

    // AJAX Submission
    $.ajax({
        type: 'POST',
        url: '/subcategory/add', // Changed from "/logout" to "/login"
        data: formdata,
        processData: false, // Required for FormData
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        beforeSend: function () {
            $('.preloader').fadeIn()
        },
        success: function (response) {
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
                setTimeout(function () {
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

// EDIT SUBCATEGORY
$(document).on('submit', '#sub_category_edit_form', function (event) {
    event.preventDefault() // Prevent default form submission

    let formdata = new FormData($('#sub_category_edit_form')[0])

    // AJAX Submission
    $.ajax({
        type: 'POST',
        url: '/subcategory/edit', // Changed from "/logout" to "/login"
        data: formdata,
        processData: false, // Required for FormData
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        beforeSend: function () {
            $('.preloader').fadeIn()
        },
        success: function (response) {
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
                setTimeout(function () {
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

// DELETE SUBCATEGORY

$(document).on('click', '.delete-subcategory-btn', function (e) {
    e.preventDefault()

    const subid = $(this).data('id')

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
            $.ajax({
                type: 'POST',
                url: '/subcategory/delete', // Changed from "/logout" to "/login"
                data: {
                    subid: subid,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content'
                    ),
                },
                beforeSend: function () {
                    $('.delete-subcategory-btn')
                        .prop('disabled', true)
                        .text('Processing...')
                },
                success: function (response) {
                    $('.preloader').fadeOut()
                    $('.delete-subcategory-btn')
                        .prop('disabled', false)
                        .text('Submit')
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
                        setTimeout(function () {
                            window.location.reload()
                        }, 1500)
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text:
                                response.message ||
                                'An unexpected error occurred.',
                            icon: 'error',
                        })
                        console.log(response.message)
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
        }
    })
})

// ===== PRODUCT ===== //
$(document).on('change', '#add_category_select', function () {
    let id = $(this).val()

    $('#add_subcategory_select').empty()
    $('#add_subcategory_select').append(
        '<option value="" disabled selected>Processing...</option>'
    )

    $.ajax({
        type: 'GET',
        url: '/product/fetchsubcategory/' + id,
        success: function (response) {
            console.log(response)
            $('#add_subcategory_select').empty()
            $('#add_subcategory_select').append(
                '<option value="" disabled selected>Select Subcategory</option>'
            )
            response.forEach((element) => {
                $('#add_subcategory_select').append(
                    `<option value='${element['id']}'>${element['subcategory_name']}</option>`
                )
            })
        },
    })
})

$(function () {
    const backupHtml = $('#preview-container').html()

    // Listen for changes to the input field
    $('#add_product_image').on('change', function () {
        // Get the selected file
        var file = $(this)[0].files[0]

        // Check if the file is an image
        if (file.type.match('image.*')) {
            // Create a new FileReader object
            var reader = new FileReader()

            // Set up the FileReader to load the image
            reader.onload = function (e) {
                // Create a new image element
                var img = $('<img>').attr('src', e.target.result)

                // Create a remove button
                var removeBtn = $('<button>')
                    .addClass('btn btn-danger product_remove_btn mt-2')
                    .text('Remove')

                // Add the image and remove button to the preview container
                $('#preview-container').empty().append(img).append(removeBtn)

                // Listen for clicks on the remove button
                removeBtn.on('click', function (e) {
                    e.preventDefault()

                    // Remove the image from the preview container
                    $('#preview-container').html(backupHtml)
                    // Clear the input field
                    $('#add_product_image').val('')
                })
            }

            // Read the selected file as a data URL
            reader.readAsDataURL(file)
        }
    })
})

$(function () {
    const backupHtml = $('#preview-container1').html()

    // Listen for changes to the input field
    $('#add_varient_image').on('change', function () {
        // Get the selected file
        var file = $(this)[0].files[0]

        // Check if the file is an image
        if (file.type.match('image.*')) {
            // Create a new FileReader object
            var reader = new FileReader()

            // Set up the FileReader to load the image
            reader.onload = function (e) {
                // Create a new image element
                var img = $('<img>').attr('src', e.target.result)

                // Create a remove button
                var removeBtn = $('<button>')
                    .addClass('btn btn-danger product_remove_btn mt-2')
                    .text('Remove')

                // Add the image and remove button to the preview container
                $('#preview-container1').empty().append(img).append(removeBtn)

                // Listen for clicks on the remove button
                removeBtn.on('click', function (e) {
                    e.preventDefault()

                    // Remove the image from the preview container
                    $('#preview-container1').html(backupHtml)
                    // Clear the input field
                    $('#add_varient_image').val('')
                })
            }

            // Read the selected file as a data URL
            reader.readAsDataURL(file)
        }
    })
})

$(document).ready(function () {
    // Add input
    $('.add-input1').click(function () {
        var inputField = $('.product_image_count')
        var currentValue = parseInt(inputField.val())
        inputField.val(currentValue + 1)
        var inputGroup = `
        <div class="d-flex product_fields1">
        <div class="row">
            <div class="col-lg-8">
                <div class="mb-3">
                    <label class="form-label" for="add_product_image">Product Image*(750 *
                        600)</label>
                    <input type="file" class="form-control image_el dropzone needsclick"
                        id="add_product_image" placeholder="Product Image" name="product_image1[]" required>
                </div>
            </div>
            <div class="col-lg-4 col-sm-12 mt-4">
                <div class="input-group-append">
                    <button class="btn btn-danger delete-input1"
                        type="button">Delete</button>
                </div>
            </div>
        </div>
    </div>`
        $('.dynamic-inputs1').append(inputGroup)
    })

    // Delete input
    $(document).on('click', '.delete-input1', function () {
        $(this).closest('.product_fields1').remove()
    })
})

// $(document).on("submit", "#addProductForm", function () {
//     const formdata = new FormData(e.target);
//     $.ajaxSetup({
//         headers: {
//             "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
//         },
//     });
//     $.ajax({
//         url: "/product/store",
//         method: "POST",
//         dataType: "json",
//         data: formdata,
//         processData: false,
//         contentType: false,
//         success: function (response) {
//             $(".add_submit_btn").removeAttr("disabled");
//             $(".add_submit_btn").html("Submit");

//             const updatedProducts = response.products;
//             $("#addProductForm")[0].reset();
//             $("#addProductModal").hide();
//             $(".modal-backdrop").remove();
//             document.body.style.overflowY = "scroll";

//             console.log(updatedProducts);

//             gridjsReRender(updatedProducts);
//             Swal.fire("Added", "Records Added Successfully.", "success");
//         },
//         error: function (jqXHR, textStatus, errorThrown) {
//             $(".edit_submit_btn").removeAttr("disabled");
//             $(".add_submit_btn").removeAttr("disabled");
//             $(".edit_submit_btn").html("Update");
//             $(".add_submit_btn").html("Submit");
//             console.log(textStatus + ": " + errorThrown);

//             Swal.fire(textStatus.toUpperCase(), errorThrown, "warning");
//         },
//     });
// });

$(document).on('submit', '#addProductForm', function (e) {
    e.preventDefault() // Prevent default form submission

    const formdata = new FormData(e.target) // Use e.target to get the form

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    })

    $.ajax({
        url: '/product/store',
        method: 'POST',
        dataType: 'json',
        data: formdata,
        processData: false,
        contentType: false,
        beforeSend: function () {
            $('.add_submit_btn').attr('disabled', true).html('Processing...')
        },
        success: function (response) {
            $('.add_submit_btn').removeAttr('disabled').html('Submit')

            if (response.products) {
                const updatedProducts = response.products
                $('#addProductForm')[0].reset()

                // Close modal properly
                $('#addProductModal').modal('hide')

                // Remove backdrop manually (if still present)
                $('.modal-backdrop').remove()
                $('body').removeClass('modal-open').css('overflow', 'auto')

                console.log(updatedProducts)

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
                setTimeout(function () {
                    window.location.reload()
                }, 1500)
            } else {
                Swal.fire('Error', 'Unexpected response from server.', 'error')
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('.add_submit_btn').removeAttr('disabled').html('Submit')

            console.log(textStatus + ': ' + errorThrown)
            Swal.fire(textStatus.toUpperCase(), errorThrown, 'warning')
        },
    })
})

$(document).on('submit', '#addVendorForm', function (e) {
    e.preventDefault() // Prevent default form submission

    const formdata = new FormData(e.target) // Use e.target to get the form
    let vendorName = $('#add_Vendor_name').val()
    let vendoremail = $('#add_vendor_email').val()
    let vendorContactName = $('#vendor_contact_name').val()
    let vendorContactNumber = $('#vendor_contact_number').val()
    let vendorBusinessType = $('#vendor_business_type').val()
    let vendorgst = $('#vendor_gst_number').val()
    let vendorAddress = $('#add_vendor_address').val()
    let vendorState = $('#vendor_state_name').val()
    let vendorDistrict = $('#vendor_district_name').val()
    let vendorPincode = $('#vendor_pincode_value').val()
    let vendorBankName = $('#vendor_bank_name').val()
    let vendorAccountHolderName = $('#bank_account_name').val()
    let vendorAccountNumber = $('#vendor_account_number').val()
    let vendorifsc = $('#bank_ifsc_code').val()
    let vendorproducts = $('#vendor_areas_dealing_with').val()
    let vendorareas = $('#edit_vendor_products').val()

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    })

    $.ajax({
        url: '/vendor/store',
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
            vendorareas: vendorareas,
        },
        beforeSend: function () {
            $('.add_submit_btn').attr('disabled', true).html('Processing...')
        },
        success: function (response) {
            $('.add_submit_btn').removeAttr('disabled').html('Submit')

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
                setTimeout(function () {
                    window.location.reload()
                }, 1500)
            } else {
                Swal.fire('Error', 'Unexpected response from server.', 'error')
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('.add_submit_btn').removeAttr('disabled').html('Submit')

            console.log(textStatus + ': ' + errorThrown)
            Swal.fire(textStatus.toUpperCase(), errorThrown, 'warning')
        },
    })
})

$(document).ready(function () {
    // VENDOR STOCK EDIT
    $(document).on('click', '.change-status-btn', function () {
        let prod_stock_id = $(this).data('id')
        let vendorid = $(this).data('vendorid')
        let categoryid = $(this).data('cateid')
        let product_id = $(this).data('prodid')
        let available_stock = $(this).data('availstock')
        let sale_stock = $(this).data('salestock')

        $('#edit_stock_prod').val(product_id)
        $('#edit_stock_avail').val(available_stock)
        $('#edit_stock_sale').val(sale_stock)
        $('#edit_prodstock_id').val(prod_stock_id)
        $('#edit_prodstock_vendor_id').val(vendorid)
        $('#edit_prodstock_category_id').val(categoryid)
    })

    // VENDOR OFFER EDIT
    $(document).on('click', '.edit-vendor-offer-btn', function () {
        let offerid = $(this).data('offerid')
        let vendorid = $(this).data('vendorid')
        let productid = $(this).data('productid')
        let productprice = $(this).data('productprice')
        let offerprice = $(this).data('offerprice')
        let offerendDate = $(this).data('offerendDate')

        $('#edit_offer_prod_select').val(productid)
        $('#edit_offer_prod_price').val(productprice)
        $('#edit_offer_price').val(offerprice)
        $('#edit_offer_end_date').val(offerendDate)
        $('#edit_offer_id').val(offerid)
        $('#edit_offer_vendor_id').val(vendorid)
    })
})

// EDIT VENDOR STOCK
$(document).on('submit', '#edit_prod_stock_form', function (e) {
    e.preventDefault()

    let product = $('#edit_stock_prod').val()
    let availstock = $('#edit_stock_avail').val()
    let saleStock = $('#edit_stock_sale').val()
    let prodStockid = $('#edit_prodstock_id').val()
    let vendor_id = $('#edit_prodstock_vendor_id').val()

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    })

    $.ajax({
        url: '/vendor/editprodstock',
        method: 'POST',
        dataType: 'json',
        data: {
            product: product,
            availstock: availstock,
            saleStock: saleStock,
            prodStockid: prodStockid,
            vendor_id: vendor_id,
        },
        beforeSend: function () {
            $('#edit_stock_submit_btn')
                .attr('disabled', true)
                .html('Processing...')
        },
        success: function (response) {
            $('#edit_stock_submit_btn').removeAttr('disabled').html('Submit')

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
                setTimeout(function () {
                    window.location.reload()
                }, 1500)
            } else {
                Swal.fire('Error', 'Unexpected response from server.', 'error')
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('#edit_stock_submit_btn').removeAttr('disabled').html('Submit')

            console.log(textStatus + ': ' + errorThrown)
            Swal.fire(textStatus.toUpperCase(), errorThrown, 'warning')
        },
    })
})

// ADD VENDOR STOCK
$(document).on('submit', '#add_prod_stock_form', function (e) {
    e.preventDefault()

    let product = $('#add_stock_prod').val()
    let availstock = $('#add_stock_avail').val()
    let saleStock = $('#add_stock_sale').val()
    let vendor_id = $('#add_stock_vendor_id').val()

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    })

    $.ajax({
        url: '/vendor/addprodstock',
        method: 'POST',
        dataType: 'json',
        data: {
            product: product,
            availstock: availstock,
            saleStock: saleStock,
            vendor_id: vendor_id,
        },
        beforeSend: function () {
            $('#add_stock_submit_btn')
                .attr('disabled', true)
                .html('Processing...')
        },
        success: function (response) {
            $('#add_stock_submit_btn').removeAttr('disabled').html('Submit')

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
                setTimeout(function () {
                    window.location.reload()
                }, 1500)
            } else {
                Swal.fire('Error', 'Unexpected response from server.', 'error')
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('#add_stock_submit_btn').removeAttr('disabled').html('Submit')

            console.log(textStatus + ': ' + errorThrown)
            Swal.fire(textStatus.toUpperCase(), errorThrown, 'warning')
        },
    })
})

// VENDOR OFFER PRODUCT PRICE FETCH
$(document).on('change', '#add_prod_offer_select', function (e) {
    e.preventDefault()

    let product = $(this).val()

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    })

    $.ajax({
        url: '/vendor/fetchproddetail',
        method: 'POST',
        dataType: 'json',
        data: {
            product: product,
        },
        success: function (response) {
            if (response.status == 200) {
                $('#add_product_price').val(response.data.product_mrp_price)
            } else {
                Swal.fire('Error', 'Unexpected response from server.', 'error')
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('#edit_stock_submit_btn').removeAttr('disabled').html('Submit')

            console.log(textStatus + ': ' + errorThrown)
            Swal.fire(textStatus.toUpperCase(), errorThrown, 'warning')
        },
    })
})

// VENDOR ADD OFFER
$(document).on('submit', '#add_prod_offer_form', function (e) {
    e.preventDefault()

    let product = $('#add_prod_offer_select').val()
    let productPrice = $('#add_product_price').val()
    let offerprice = $('#add_offer_price').val()
    let offerendDate = $('#add_offer_end_date').val()
    let vendorid = $('#add_offer_vendor_id').val()

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    })

    $.ajax({
        url: '/vendor/addoffer',
        method: 'POST',
        dataType: 'json',
        data: {
            product: product,
            productPrice: productPrice,
            offerprice: offerprice,
            offerendDate: offerendDate,
            vendorid: vendorid,
        },
        beforeSend: function () {
            $('#add_offer_submit_btn')
                .attr('disabled', true)
                .html('Processing...')
        },
        success: function (response) {
            $('#add_offer_submit_btn').removeAttr('disabled').html('Submit')

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
                setTimeout(function () {
                    window.location.reload()
                }, 1500)
            } else {
                Swal.fire('Error', 'Unexpected response from server.', 'error')
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('#add_offer_submit_btn').removeAttr('disabled').html('Submit')

            console.log(textStatus + ': ' + errorThrown)
            Swal.fire(textStatus.toUpperCase(), errorThrown, 'warning')
        },
    })
})

// VENDOR EDIT OFFER
$(document).on('submit', '#edit_prod_offer_form', function (e) {
    e.preventDefault()

    let product = $('#edit_offer_prod_select').val()
    let productPrice = $('#edit_offer_prod_price').val()
    let offerprice = $('#edit_offer_price').val()
    let offerendDate = $('#edit_offer_end_date').val()
    let vendorid = $('#edit_offer_vendor_id').val()
    let offerid = $('#edit_offer_id').val()

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    })

    $.ajax({
        url: '/vendor/editoffer',
        method: 'POST',
        dataType: 'json',
        data: {
            product: product,
            productPrice: productPrice,
            offerprice: offerprice,
            offerendDate: offerendDate,
            vendorid: vendorid,
            offerid: offerid,
        },
        beforeSend: function () {
            $('#edit_offer_submit_btn')
                .attr('disabled', true)
                .html('Processing...')
        },
        success: function (response) {
            $('#edit_offer_submit_btn').removeAttr('disabled').html('Submit')

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
                setTimeout(function () {
                    window.location.reload()
                }, 1500)
            } else {
                Swal.fire('Error', 'Unexpected response from server.', 'error')
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            $('#edit_offer_submit_btn').removeAttr('disabled').html('Submit')

            console.log(textStatus + ': ' + errorThrown)
            Swal.fire(textStatus.toUpperCase(), errorThrown, 'warning')
        },
    })
})

// ADD COLORFAMILY
$(document).on('submit', '#color_family_add_form', function (event) {
    event.preventDefault()

    let colorfamily = $('#color_family_add_input').val()
    let colorCodes = []
    let colorBrands = []

    $('.color-code-input').each(function () {
        let val = $(this).val().trim()
        if (val) {
            colorCodes.push(val)
        }
    })

    $('.color-brand-input').each(function () {
        let val = $(this).val().trim()
        if (val) {
            colorBrands.push(val)
        }
    })

    $.ajax({
        type: 'POST',
        url: '/colorfamily/store',
        data: {
            colorfamily: colorfamily,
            color_codes: colorCodes,
            color_brands: colorBrands,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        beforeSend: function () {
            $('.preloader').fadeIn()
        },
        success: function (response) {
            $('.preloader').fadeOut()
            console.log(response)
            if (response.status == 200) {
                Swal.fire({
                    title: 'Success',
                    text: response.message,
                    icon: 'success',
                })

                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.onmouseenter = Swal.stopTimer
                        toast.onmouseleave = Swal.resumeTimer
                    },
                })

                Toast.fire({
                    icon: 'success',
                    title: response.message,
                })

                setTimeout(function () {
                    window.location.reload()
                }, 1500)
            } else {
                Swal.fire({
                    title: 'Error',
                    text: response.message || 'An unexpected error occurred.',
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
