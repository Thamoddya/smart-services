@extends('components.data.superAdminLayout')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Service Centers</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Service Centers
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">29</div>
                                </div>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Add Service Center Admin --}}
    <div class="row my-2">
        <div class="col-xl-12 col-lg-7">
            <a type="button" data-toggle="modal" data-target="#addServiceCenterAdminModal"
                class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add Admin</span>
            </a>
        </div>
    </div>
    {{-- Add Service Center Button --}}
    <div class="row my-2">
        <div class="col-xl-12 col-lg-7">
            <a type="button" onclick="POPUP_addServiceCenterModal()" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add Service Center</span>
            </a>
        </div>
    </div>

    <!-- Service Admins -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Service Admins</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="adminsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Admin Name</th>
                            <th>Email</th>
                            <th>username</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Admin Name</th>
                            <th>Email</th>
                            <th>username</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>

                        @foreach ($serviceAdmins as $admin)
                            <tr>
                                <td>{{ $admin->name }}</td>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->username }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-circle btn-sm">
                                        <i class="fas fa-eye text-white"></i>
                                    </a>
                                    <a href="#" class="btn btn-success btn-circle btn-sm">
                                        <i class="fas fa-edit text-white"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-circle btn-sm">
                                        <i class="fas fa-trash text-white"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Service Centers -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Service Centers</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Admin Name</th>
                            <th>Service Center Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Vehicles</th>
                            <th>Earnings</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Admin Name</th>
                            <th>Service Center Name</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Vehicles</th>
                            <th>Earnings</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($serviceCenters as $serviceCenter)
                            <tr>
                                <td>{{ $serviceCenter->user->name }}</td>
                                <td>{{ $serviceCenter->name }}</td>
                                <td>{{ $serviceCenter->mobile }}</td>
                                <td>{{ $serviceCenter->email }}</td>
                                <td>{{ $serviceCenter->total_access_vehicles }}</td>
                                <td>Rs.{{ $serviceCenter->earnings }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-circle btn-sm">
                                        <i class="fas fa-eye text-white"></i>
                                    </a>
                                    <a href="#" class="btn btn-success btn-circle btn-sm">
                                        <i class="fas fa-edit text-white"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger btn-circle btn-sm">
                                        <i class="fas fa-trash text-white"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Add Service Center Admin Modal --}}
    <div class="modal  fade" id="addServiceCenterAdminModal" tabindex="-1" role="dialog"
        aria-labelledby="addServiceCenterAdminModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addServiceCenterAdminModalLabel">Add Service Center Admin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-left">
                    <div class="form-group row" id="name-group">
                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="name" placeholder="Name">
                            <!-- Error message will be appended here -->
                        </div>
                    </div>
                    <div class="form-group row" id="email-group">
                        <label for="email" class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" id="email" placeholder="Email">
                            <!-- Error message will be appended here -->
                        </div>
                    </div>
                    <div class="form-group row" id="username-group">
                        <label for="username" class="col-sm-3 col-form-label">UserName</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="username" placeholder="Username">
                            <!-- Error message will be appended here -->
                        </div>
                    </div>
                    <div class="form-group row" id="password-group">
                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" placeholder="Password">
                            <!-- Error message will be appended here -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addNewAdmin();">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Service Center Model --}}

    <div class="modal  fade" id="addServiceCenterModal" tabindex="-1" role="dialog"
        aria-labelledby="addServiceCenterModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addServiceCenterModalLabel">Add Service Center</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-left">
                    <div>
                        {{-- Select Admin --}}
                        <div class="form-group row" id="adminSelect-group">
                            <label for="adminSelect" class="col-sm-3 col-form-label">Admin</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="adminSelect">
                                    <option value="0">Select Admin</option>
                                </select>
                                <!-- Error message will be appended here -->
                            </div>
                        </div>
                        {{-- Service Center Name --}}
                        <div class="form-group row" id="serviceCenterName-group">
                            <label for="serviceCenterName" class="col-sm-3 col-form-label">Service Center Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="serviceCenterName"
                                    placeholder="Service Center Name">
                                <!-- Error message will be appended here -->
                            </div>
                        </div>
                        {{-- Mobile --}}
                        <div class="form-group row" id="serviceCenterMobile-group">
                            <label for="serviceCenterMobile" class="col-sm-3 col-form-label">Mobile</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="serviceCenterMobile"
                                    placeholder="Mobile">
                                <!-- Error message will be appended here -->
                            </div>
                        </div>
                        {{-- Email --}}
                        <div class="form-group row" id="serviceCenterEmail-group">
                            <label for="serviceCenterEmail" class="col-sm-3 col-form-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="serviceCenterEmail" placeholder="Email">
                                <!-- Error message will be appended here -->
                            </div>
                        </div>
                        {{-- Address --}}
                        <div class="form-group row" id="serviceCenterAddress-group">
                            <label for="serviceCenterAddress" class="col-sm-3 col-form-label">Address</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="serviceCenterAddress"
                                    placeholder="Address">
                                <!-- Error message will be appended here -->
                            </div>
                        </div>
                        {{-- total_access_vehicles count --}}
                        <div class="form-group row" id="total_access_vehicles-group">
                            <label for="total_access_vehicles" class="col-sm-3 col-form-label">Total Access
                                Vehicles</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="total_access_vehicles"
                                    placeholder="Total Access Vehicles">
                                <!-- Error message will be appended here -->
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="StoreServiceCenter()">Add Service
                            Center</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function StoreServiceCenter() {
            var adminSelect = $('#adminSelect').val();
            var serviceCenterName = $('#serviceCenterName').val();
            var serviceCenterMobile = $('#serviceCenterMobile').val();
            var serviceCenterEmail = $('#serviceCenterEmail').val();
            var serviceCenterAddress = $('#serviceCenterAddress').val();
            var total_access_vehicles = $('#total_access_vehicles').val();


            let data = {
                adminSelect: adminSelect,
                serviceCenterName: serviceCenterName,
                serviceCenterMobile: serviceCenterMobile,
                serviceCenterEmail: serviceCenterEmail,
                serviceCenterAddress: serviceCenterAddress,
                total_access_vehicles: total_access_vehicles
            };

            $.ajax({
                url: '{{ route('store-service-center') }}',
                type: 'POST',
                data: data,
                success: function(response) {
                    if (response.status === 'success') {
                        window.location.reload();
                    } else {
                        // Handle validation errors
                        displayServicecenterErrors(response.errors);
                        console.log(response.errors);

                    }
                },
                error: function(xhr) {
                    // Handle server errors
                    alert('An error occurred: ' + xhr.responseJSON.message);
                }
            });
        }

        function displayServicecenterErrors(errors) {
            // Clear previous errors
            $('.form-group').removeClass('has-error');
            $('.form-group .text-danger').remove();

            // Display new errors
            $.each(errors, function(key, value) {
                // Get the input element
                var input = $('#' + key);

                // Add error class to the form group
                input.closest('.form-group').addClass('has-error');

                // Create error message element
                var errorHtml = '<span class="text-danger">' + value.join(', ') + '</span>';

                // Append error message after the input field
                input.after(errorHtml);
            });
        }

        function POPUP_addServiceCenterModal() {

            //Load Admins
            $.ajax({
                url: '{{ route('get-admins') }}',
                type: 'POST',
                success: function(response) {
                    if (response.status === 'success') {
                        var admins = response.data;
                        var adminSelect = $('#adminSelect');
                        adminSelect.empty();
                        adminSelect.append('<option value="0">Select Admin</option>');
                        $.each(admins, function(index, admin) {
                            adminSelect.append('<option value="' + admin.id + '">' + admin.name +
                                '</option>');
                        });
                        $('#addServiceCenterModal').modal('show');
                    } else {
                        alert('An error occurred: ' + response.message);
                    }
                },
                error: function(xhr) {
                    alert('An error occurred: ' + xhr.responseJSON.message);
                }
            });
        }

        function addNewAdmin() {
            var name = $('#name').val();
            var email = $('#email').val();
            var username = $('#username').val();
            var password = $('#password').val();

            let data = {
                name: name,
                email: email,
                username: username,
                password: password
            };

            $.ajax({
                url: '{{ route('store-admin') }}',
                type: 'POST',
                data: data,
                success: function(response) {
                    if (response.status === 'success') {
                        window.location.reload();
                    } else {
                        // Handle validation errors
                        displayErrors(response.errors);
                    }
                },
                error: function(xhr) {
                    // Handle server errors
                    alert('An error occurred: ' + xhr.responseJSON.message);
                }
            });
        }

        function displayErrors(errors) {
            // Clear previous errors
            $('.form-group').removeClass('has-error');
            $('.form-group .text-danger').remove();

            // Display new errors
            $.each(errors, function(key, value) {
                var input = $('#' + key);
                input.closest('.form-group').addClass('has-error');
                var errorHtml = '<span class="text-danger">' + value.join(', ') + '</span>';
                input.after(errorHtml);
            });
        }
    </script>
@endsection
