@extends('layout.app')
@section('main_content')
    <div class="col-lg-12">
        <div class="card card-h-100">
            <div class="card-body">
                <div class="mb-5 text-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                        data-bs-target="#addprojectimageModal">
                        Add Category
                    </button>
                </div>
                {{-- {{ $dataTable->table() }} --}}
                <div class="container">
                    <h2 class="mb-4">Project Images</h2>
                    <div class="row">
                        @if ($projects)
                            @foreach ($projects as $project)
                                <div class="col-xl-3 col-md-6">
                                    <!-- card -->
                                    <div class="card card-h-100">
                                        <!-- card body -->
                                        <div class="card-body">
                                            <div class="d-flex align-items-center">
                                                <div class="flex-grow-1">
                                                    {{-- <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Orders</span> --}}
                                                    <img src="/uploads/projects/{{ $project->painter_project_image }}"
                                                        alt="Project Image" style="width: 230px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="col-lg-12">
                                No Projects Uploaded
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addprojectimageModal" tabindex="-1" aria-labelledby="addcategoryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="addcategoryModalLabel">Add project Image</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" id="project_image_add_form">
                        <div class="mb-3">
                            <label for="category_add_input" class="form-label">project Image</label>
                            <input type="file" class="form-control" id="add_painter_project_image"
                                placeholder="Painter Project Image" accept="image/*" name="add_painter_project_image"
                                required>
                            <input type="hidden" value="{{ Auth::user()->user_id }}" name="add_painter_user_id">
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
                    <form id="category_edit_form" method="POST">
                        @csrf
                        @method('POST') {{-- Use PUT since you're updating --}}
                        <input type="hidden" id="editCategoryId" name="id">

                        <div class="mb-3">
                            <label for="editCategoryName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="editCategoryName" name="category_name"
                                placeholder="Enter Category Name">
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
        $(document).on('submit', '#project_image_add_form', function(event) {
            event.preventDefault() // Prevent default form submission

            let formdata = new FormData($('#project_image_add_form')[0])

            // AJAX Submission
            $.ajax({
                type: 'POST',
                url: '/painter/project/add', // Changed from "/logout" to "/login"
                data: formdata,
                processData: false, // Required for FormData
                contentType: false, // Required for FormData
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
@endpush
