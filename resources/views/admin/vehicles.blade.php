@extends('components.data.AdminLayout')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Vehicle Details</h1>
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Vehicles
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $vehicleCount }}</div>
                                </div>

                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-car fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- Add Service Center Admin --}}
    <div class="row my-2">
        <div class="col-xl-12 col-lg-7">
            <a type="button" onclick="POPUP_ADD_VEHICLEMODAL();" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add Vehicle</span>
            </a>
        </div>
    </div>

    <!-- Customer DataTales -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Vehicle Data</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Vehicle ID</th>
                            <th>Vehicle Number</th>
                            <th>Chassis Number</th>
                            <th>Vehicle Type</th>
                            <th>Customer NIC</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vehicles as $vehicle)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/' . $vehicle->vehicle_photo) }}" alt="Vehicle Photo"
                                        class="img-thumbnail" style="width: 100px;">
                                </td>
                                <td>{{ $vehicle->vehicle_id }}</td>
                                <td>{{ $vehicle->vehicle_number }}</td>
                                <td>{{ $vehicle->chassis_number }}</td>
                                <td>{{ $vehicle->type->name }}</td>
                                <td>{{ $vehicle->customer->nic }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-circle btn-sm">
                                        <i class="fas fa-eye text-white"></i>
                                    </a>
                                    <a href="#" class="btn btn-warning btn-circle btn-sm">
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

    <!-- Add Vehicle Admin Modal-->
    <div class="modal fade" id="addVehicleModal" tabindex="-1" role="dialog"
        aria-labelledby="addServiceStationCustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addServiceStationCustomerModalLabel">Add Vehicle To Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div>
                        <div class="form-group" id="customerNic-group">
                            <label for="customerNic">Customer NIC</label>
                            <input type="text" class="form-control" id="customerNic" placeholder="Enter Customer NIC">
                        </div>
                        {{-- Select Vehicle Type --}}
                        <div class="form-group row" id="vehicleTypeId-group">
                            <label for="vehicleTypeId" class="col-sm-3 col-form-label">Vehicle Type</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="vehicleTypeId">
                                    <option value="0">Select Type</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="vehicleID-group">
                            <label for="vehicleID" class="text-danger">Vehicle ID *</label>
                            <input type="text" class="form-control" id="vehicleID" placeholder="Enter Vehicle Id">
                        </div>
                        <div class="form-group" id="vehicleNumber-group">
                            <label for="vehicleNumber">Vehicle Number Plate (Eg:- BDO2763)</label>
                            <input type="text" class="form-control" id="vehicleNumber"
                                placeholder="Enter Vehicle Number">
                        </div>
                        <div class="form-group" id="chassisNumber-group">
                            <label for="chassisNumber">Chassis Number</label>
                            <input type="text" class="form-control" id="chassisNumber"
                                placeholder="Enter Chassis Number">
                        </div>
                        {{-- Vehicle Photo --}}
                        <div class="form-group row" id="vehiclePhoto-group">
                            <label for="vehiclePhoto" class="col-sm-3 col-form-label">Vehicle Photo</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="vehiclePhoto">
                                <!-- Error message will be appended here -->
                            </div>
                        </div>

                        {{-- Optional Data devider --}}
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <hr>
                                <h6 class="text-center">Optional Data</h6>
                                <hr>
                            </div>
                        </div>

                        {{-- Last Service Date --}}
                        <div class="form-group row" id="lastServiceDate-group">
                            <label for="lastServiceDate" class="col-sm-3 col-form-label">Last Service Date</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="lastServiceDate">
                                <!-- Error message will be appended here -->
                            </div>
                        </div>
                        {{-- Last Service Milage --}}
                        <div class="form-group row" id="lastServiceMilage-group">
                            <label for="lastServiceMilage" class="col-sm-3 col-form-label">Last Service Milage</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="lastServiceMilage"
                                    placeholder="Enter Last Service Milage">
                                <!-- Error message will be appended here -->
                            </div>
                        </div>
                        {{-- Next Service Milage --}}
                        <div class="form-group row" id="nextServiceMilage-group">
                            <label for="nextServiceMilage" class="col-sm-3 col-form-label">Next Service Milage</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nextServiceMilage"
                                    placeholder="Enter Next Service Milage">
                                <!-- Error message will be appended here -->
                            </div>
                        </div>

                        {{-- Vehicle Video --}}
                        <div class="form-group row" id="vehicleVideo-group">
                            <label for="vehicleVideo" class="col-sm-3 col-form-label">Vehicle Video</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="vehicleVideo">
                                <!-- Error message will be appended here -->
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addVehicle();">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function POPUP_ADD_VEHICLEMODAL() {
            // Get Vehicle Types
            $.ajax({
                url: "{{ route('get-vehicle-types') }}",
                type: 'POST',
                success: function(response) {
                    response.data.forEach(function(vehicleType) {
                        $('#vehicleTypeId').append('<option value="' + vehicleType.id + '">' +
                            vehicleType.name +
                            '</option>');
                    });
                    $('#addVehicleModal').modal('show');
                }
            });


        }

        function displayValidationErrors(errors) {
            // Clear previous errors
            $('.form-group').removeClass('has-error');
            $('.form-group .help-block').remove();

            // Display new errors
            $.each(errors, function(key, errorMessages) {
                var group = $('#' + key + '-group');
                group.addClass('has-error');
                errorMessages.forEach(function(message) {
                    group.append('<span class="help-block text-danger">' + message + '</span>');
                });
            });
        }

        function addVehicle() {
            var customerNic = $('#customerNic').val();
            var vehicleTypeId = $('#vehicleTypeId').val();
            var vehicleID = $('#vehicleID').val();
            var vehicleNumber = $('#vehicleNumber').val();
            var chassisNumber = $('#chassisNumber').val();
            var lastServiceDate = $('#lastServiceDate').val();
            var lastServiceMilage = $('#lastServiceMilage').val();
            var nextServiceMilage = $('#nextServiceMilage').val();
            var vehiclePhoto = $('#vehiclePhoto')[0].files[0];
            var vehicleVideo = $('#vehicleVideo')[0].files[0];

            var formData = new FormData();
            formData.append('customerNic', customerNic);
            formData.append('vehicleTypeId', vehicleTypeId);
            formData.append('vehicleID', vehicleID);
            formData.append('vehicleNumber', vehicleNumber);
            formData.append('chassisNumber', chassisNumber);
            formData.append('lastServiceDate', lastServiceDate);
            formData.append('lastServiceMilage', lastServiceMilage);
            formData.append('nextServiceMilage', nextServiceMilage);
            formData.append('cerviceCenterId', '{{ $serviceCenter->id }}');
            if (vehiclePhoto) {
                formData.append('vehiclePhoto', vehiclePhoto);
            }
            if (vehicleVideo) {
                formData.append('vehicleVideo', vehicleVideo);
            }

            $.ajax({
                type: 'POST',
                url: '{{ route('store-vehicle') }}',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.status === 'success') {
                        alert('Vehicle added successfully!');
                        // Handle success, e.g., close modal, refresh page
                    } else if (data.status === 'error') {
                        displayValidationErrors(data.errors);
                    }
                },
                error: function(xhr) {
                    alert('An error occurred: ' + xhr.responseJSON.message);
                }
            });
        }

        function displayValidationErrors(errors) {
            // Clear previous errors
            $('.form-group').removeClass('has-error');
            $('.form-group .help-block').remove();

            // Display new errors
            $.each(errors, function(key, errorMessages) {
                var group = $('#' + key + '-group');
                group.addClass('has-error');
                errorMessages.forEach(function(message) {
                    group.append('<span class="help-block text-danger">' + message + '</span>');
                });
            });
        }
    </script>
@endsection
