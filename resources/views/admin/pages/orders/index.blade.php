@extends('admin.layouts.app')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Orders /</span> Order List</h4>
        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Order Code</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Delivered?</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <th>1</th>
                            <td>Mg Mg</td>
                            <td><a href="#" class="text-decoration-underline">ed12gr45</a></td>
                            <td>$ 120</td>
                            <td>
                                <select class="form-select form-select-sm" name="status" id="status">
                                    <option value="2">pending</option>
                                    <option value="0">reject</option>
                                    <option value="1">success</option>
                                </select>
                            </td>
                            <td>
                                <input type="checkbox" class="form-check-input" name="delivered" id="delivered">
                            </td>
                            <td>12-03-2023</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0);"><i
                                                class="bx bx-edit-alt me-1"></i> Detail</a>
                                        <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash me-1"></i>
                                            Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
