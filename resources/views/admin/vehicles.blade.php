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

        @if ($vehicleCount >= $serviceCenter->total_access_vehicles)
            <div class="col-xl-12 col-lg-7">
                <div class="alert alert-danger alert-sm" role="alert">
                    <h4 class="alert-heading">Warning!</h4>
                    <p class="mb-0">You have reached the maximum number of vehicles that can be added to the service
                        center.Contact Admin to increase the limit.
                    </p>
                </div>
            </div>
        @else
            <div class="col-xl-12 col-lg-7">
                <a type="button" onclick="POPUP_ADD_VEHICLEMODAL();" class="btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add Vehicle</span>
                </a>
            </div>
        @endif
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
                                    <button onclick="POPUP_ADD_SERVICEMODAL('{{ $vehicle->vehicle_id }}');"
                                        class="btn btn-success btn-sm">Add Service</button>
                                </td>
                                <td>{{ $vehicle->vehicle_id }}</td>
                                <td>{{ $vehicle->vehicle_number }}</td>
                                <td>{{ $vehicle->chassis_number }}</td>
                                <td>{{ $vehicle->type->name }}</td>
                                <td>{{ $vehicle->customer->nic }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm">Edit</button>
                                    <button class="btn btn-success btn-sm"
                                        onclick="POPUP_VIEW_VEHICLE_MODAL('{{ $vehicle->vehicle_id }}','{{ $vehicle->vehicle_number }}','{{ $vehicle->customer->nic }}','{{ $vehicle->type->name }}');">VIEW</button>
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
                        <div class="form-group row" id="modelName-group">
                            <label for="modelName" class="col-sm-3 col-form-label">Model Name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="modelName" placeholder="Enter Model Name">
                                <!-- Error message will be appended here -->
                            </div>
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

    {{-- add service modal --}}
    <div class="modal fade" id="addServiceModal" tabindex="-1" role="dialog" aria-labelledby="addServiceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addServiceModalLabel">Add Service To Vehicle</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div>
                        <div class="form-group row" id="serviceVehicleID-group">
                            <label for="serviceVehicleID" class="col-sm-3 col-form-label">Vehicle ID</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="serviceVehicleID"
                                    placeholder="Service Vehicle ID" disabled>
                                <!-- Error message will be appended here -->
                            </div>
                        </div>
                        <div class="form-group row" id="beforeServiceMilage-group">
                            <label for="beforeServiceMilage" class="col-sm-3 col-form-label">Last Service Milage</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="beforeServiceMilage"
                                    placeholder="Enter Service Milage">
                                <!-- Error message will be appended here -->
                            </div>
                        </div>
                        <div class="form-group row" id="serviceMilage-group">
                            <label for="serviceMilage" class="col-sm-3 col-form-label">Next Service Milage</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="serviceMilage"
                                    placeholder="Enter Next Service Milage">
                                <!-- Error message will be appended here -->
                            </div>
                        </div>
                        <div class="form-group row" id="serviceType-group">
                            <label for="serviceType" class="col-sm-3 col-form-label">Service Type</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="serviceType"
                                    placeholder="Enter Service Type">
                                <!-- Error message will be appended here -->
                            </div>
                        </div>
                        <div class="form-group row" id="serviceDate-group">
                            <label for="serviceDate" class="col-sm-3 col-form-label">Service Date</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="serviceDate">
                                <!-- Error message will be appended here -->
                            </div>
                        </div>
                        <div class="form-group  row" id="servicePrice-group">
                            <label for="servicePrice" class="col-sm-3 col-form-label">Service Price</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="servicePrice"
                                    placeholder="Enter Service Price">
                                <!-- Error message will be appended here -->
                            </div>
                        </div>
                        <div class="form-group row" id="serviceDescription-group">
                            <label for="serviceDescription" class="col-sm-3 col-form-label">Service Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" id="serviceDescription" placeholder="Enter Service Description"></textarea>
                                <!-- Error message will be appended here -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="storeService();">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    {{-- View Vehicle Details --}}
    <div class="modal fade" id="viewVehicleModal" tabindex="-1" role="dialog" aria-labelledby="viewVehicleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewVehicleModalLabel">Vehicle Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div class="vehicle-card">
                        <div class="vehicle-header">
                            <h4 id="VehicleIDNumber">Vehicle ID: </h4>
                        </div>
                        <div class="vehicle-body">
                            <div class="vehicle-info">
                                <p><strong>V Number:</strong> <p id="modalVehicleNumber"></p></p>
                                <p><strong>Type:</strong><p id="modalVehicleType"></p></p>
                                <p><strong>NIC:</strong> <p id="modalNic"></p></p>
                                <!-- Add more vehicle details as needed -->
                            </div>
                            <div class="vehicle-qr">
                                <!-- Container for the QR code -->
                                <div id="qrcode"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function POPUP_VIEW_VEHICLE_MODAL(vehicleID,VehicleNumber,customerNIC,vehicleType) {
            document.getElementById('qrcode').innerHTML = '';
            document.getElementById('VehicleIDNumber').innerText = `Vehicle ID: ${vehicleID}`;
            document.getElementById('modalVehicleNumber').innerText = VehicleNumber;
            document.getElementById('modalVehicleType').innerText = vehicleType;
            document.getElementById('modalNic').innerText = customerNIC;
            var url = `{{ url('/cus') }}/${vehicleID}`;

            var qrcode = new QRCode(document.getElementById("qrcode"), {
                text: url,
                width: 128, // QR code width
                height: 128, // QR code height
            });

            $('#viewVehicleModal').modal('show');
        }

        function POPUP_ADD_SERVICEMODAL(serviceVehicleNumber) {
            $('#serviceVehicleID').val(serviceVehicleNumber);
            $('#addServiceModal').modal('show');
        }

        function storeService() {
            var serviceVehicleID = $('#serviceVehicleID').val();
            var serviceType = $('#serviceType').val();
            var serviceDate = $('#serviceDate').val();
            var servicePrice = $('#servicePrice').val();
            var serviceDescription = $('#serviceDescription').val();
            var serviceMilage = $('#serviceMilage').val();
            var beforeServiceMilage = $('#beforeServiceMilage').val();

            console.log("lastServiceMilage : ", beforeServiceMilage); // Add this line to debug

            $.ajax({
                type: 'POST',
                url: '{{ route('store-service') }}',
                data: {
                    serviceVehicleID: serviceVehicleID,
                    serviceType: serviceType,
                    serviceDate: serviceDate,
                    beforeServiceMilage: beforeServiceMilage,
                    servicePrice: servicePrice,
                    serviceDescription: serviceDescription,
                    serviceMilage: serviceMilage
                },
                success: function(data) {
                    if (data.status === 'success') {
                        window.location.reload();
                    } else if (data.status === 'error') {
                        displayValidationErrors(data.errors);
                        console.log(data.errors);
                    }
                },
                error: function(xhr) {
                    alert('An error occurred: ' + xhr.responseJSON.message);
                }
            });
        }

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
            var lastServiceMilage = $('#lastServiceMilage').val();
            var nextServiceMilage = $('#nextServiceMilage').val();
            var modelName = $('#modelName').val();
            var vehiclePhoto = $('#vehiclePhoto')[0].files[0];
            var vehicleVideo = $('#vehicleVideo')[0].files[0];

            var formData = new FormData();
            formData.append('customerNic', customerNic);
            formData.append('vehicleTypeId', vehicleTypeId);
            formData.append('vehicleID', vehicleID);
            formData.append('vehicleNumber', vehicleNumber);
            formData.append('chassisNumber', chassisNumber);
            formData.append('lastServiceMilage', lastServiceMilage);
            formData.append('nextServiceMilage', nextServiceMilage);
            formData.append('cerviceCenterId', '{{ $serviceCenter->id }}');
            formData.append('modelName', modelName);

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
                        window.location.reload();
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
