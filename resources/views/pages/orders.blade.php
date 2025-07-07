@extends('layout.app')
@section('main_content')
    <div class="col-lg-12">
        <div class="card card-h-100">
            <div class="card-body">
                <div class="container">

                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">All Orders</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-pending-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-pending" type="button" role="tab" aria-controls="pills-pending"
                                aria-selected="true">Pending Orders</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">Packed</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                                aria-selected="false">Dispatched</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-ofd-tab" data-bs-toggle="pill" data-bs-target="#pills-ofd"
                                type="button" role="tab" aria-controls="pills-ofd" aria-selected="false">Out For
                                Delivery</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-delivered-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-delivered" type="button" role="tab"
                                aria-controls="pills-delivered" aria-selected="false">Delivered</button>
                        </li>

                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab" tabindex="0">
                            <h2 class="mb-4">Orders</h2>
                            <div class="table-responsive">
                                <table id="projectsTable"
                                    class="table table-bordered table-hover nowrap dt-responsive w-100 mt-5">
                                    <thead>
                                        <tr class="table-warning">
                                            <th>S.NO</th>
                                            <th>Order ID</th>
                                            <th>Customer Name</th>
                                            <th>Order Value</th>
                                            <th>Order Date</th>
                                            <th>Order Status</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-pending" role="tabpanel" aria-labelledby="pills-pending-tab"
                            tabindex="0">
                            <h2 class="mb-4">Orders</h2>
                            <div class="table-responsive">
                                <table id="pendingordersTable"
                                    class="table table-bordered table-hover nowrap dt-responsive w-100 mt-5">
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
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab"
                            tabindex="0">
                            <h2 class="mb-4">Packed Orders</h2>
                            <div class="table-responsive">
                                <table id="packedordersTable"
                                    class="table table-bordered table-hover nowrap dt-responsive w-100 mt-5">
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
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"
                            tabindex="0">
                            <h2 class="mb-4">Dispatched Orders</h2>
                            <div class="table-responsive">
                                <table id="dispatchedorderTable"
                                    class="table table-bordered table-hover nowrap dt-responsive w-100 mt-5">
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
                        <div class="tab-pane fade" id="pills-ofd" role="tabpanel" aria-labelledby="pills-ofd-tab"
                            tabindex="0">
                            <h2 class="mb-4">Out For Delivery Orders</h2>
                            <div class="table-responsive">
                                <table id="outfordeliveryTable"
                                    class="table table-bordered table-hover nowrap dt-responsive w-100 mt-5">
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
                        <div class="tab-pane fade" id="pills-delivered" role="tabpanel"
                            aria-labelledby="pills-delivered-tab" tabindex="0">
                            <h2 class="mb-4">Delivered Orders</h2>
                            <div class="table-responsive">
                                <table id="deliveredorderTable"
                                    class="table table-bordered table-hover nowrap dt-responsive w-100 mt-5">
                                    <thead>
                                        <tr class="table-warning">
                                            <th>S.NO</th>
                                            <th>Order ID</th>
                                            <th>Customer Name</th>
                                            <th>Order Value</th>
                                            <th>Order Date</th>
                                            <th>Delivered Date</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addcategoryModal" tabindex="-1" aria-labelledby="addcategoryModalLabel"
        aria-hidden="true">
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
                            <input type="file" class="form-control" id="add_category_image"
                                placeholder="Category Image" accept="image/*" name="add_category_image" required>
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

    <div class="modal fade" id="editcategoryModalupdate" tabindex="-1" aria-labelledby="editcategoryupdateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editcategoryupdateModalLabel">View Order Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="order-details_table_append">
                        <form action="" id="initial_delivery_status_update_form">
                            <div class="mb-3">
                                <label for="" class="form-label">Order ID</label>
                                <input type="text" name="" id="order_id_append" class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Order Status</label>
                                <select class="form-select" aria-label="Default select example" id="initial_order_status"
                                    name="">
                                    <option value="" selected>Change order Status</option>
                                    <option value="1">Packing</option>
                                </select>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editcategoryModalPacked" tabindex="-1" aria-labelledby="editcategorypackedModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editcategorypackedModalLabel">Update Order Status</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="order-details_table_append">
                        <form action="" id="packed_delivery_status_update_form">
                            <div class="mb-3">
                                <label for="" class="form-label">Order ID</label>
                                <input type="text" name="" id="packed_order_id_append" class="form-control"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Order Status</label>
                                <select class="form-select" aria-label="Default select example"
                                    id="packed_order_status_select" name="">
                                    <option value="" selected>Change order Status</option>
                                    <option value="2">Dispatched</option>
                                </select>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editcategoryModalDispatched" tabindex="-1"
        aria-labelledby="editcategorydispatchedModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editcategorydispatchedModalLabel">Update Order Status</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="order-details_table_append">
                        <form action="" id="dispatched_delivery_status_update_form">
                            <div class="mb-3">
                                <label for="" class="form-label">Order ID</label>
                                <input type="text" name="" id="dispatched_order_id_append"
                                    class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Order Status</label>
                                <select class="form-select" aria-label="Default select example"
                                    id="dispatched_order_status_select" name="">
                                    <option value="" selected>Change order Status</option>
                                    <option value="3">Out For Delivery</option>
                                </select>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editcategoryModalOutfordelivery" tabindex="-1"
        aria-labelledby="editcategorydoutfordeliveryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editcategorydoutfordeliveryModalLabel">Update Order Status</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="order-details_table_append">
                        <form action="" id="out_for_delivery_status_update_form">
                            <div class="mb-3">
                                <label for="" class="form-label">Order ID</label>
                                <input type="text" name="" id="out_for_delivery_order_id_append"
                                    class="form-control" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Order Status</label>
                                <select class="form-select" aria-label="Default select example"
                                    id="out_for_delivery_order_status_select" name="">
                                    <option value="" selected>Change order Status</option>
                                    <option value="4">Delivered</option>
                                </select>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
