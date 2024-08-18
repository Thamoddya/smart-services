@extends('components.data.superAdminLayout')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">All Vehicle Types</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>


    <div class="row my-2">
        <div class="col-xl-12 col-lg-7">
            <a type="button" onclick="POPUP_addVehicleType()" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add Vehicle Type</span>
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Vehicle Types</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Vehicle Type ID</th>
                            <th>Vehicle Type</th>
                            <th>Added Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($vehicleTypes as $vehicleType)
                            <tr>
                                <td>{{ $vehicleType->id }}</td>
                                <td>{{ $vehicleType->name }}</td>
                                <td>{{ date('d-m-Y', strtotime($vehicleType->created_at)) }}</td>
                                <td>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Add Vehicle Type Modal -->
    <div class="modal fade" id="addVehicleTypeModal" tabindex="-1" role="dialog"
        aria-labelledby="addVehicleTypeModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div>
                    <div class="modal-header">
                        <h5 class="modal-title" id="addVehicleTypeModalLabel">Add Vehicle Type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body
                    text-left">
                        <div class="form-group row" id="vehicleTypeName-group">
                            <label for="vehicleTypeName" class="col-sm-3 col-form-label">Vehicle Type</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="vehicleTypeName"
                                    placeholder="Enter Vehicle Type Name">
                                <!-- Error message will be appended here -->
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" onclick="StoreVehicleType();">Add Vehicle
                                Type</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        function POPUP_addVehicleType() {
            $('#addVehicleTypeModal').modal('show');
        }

        function StoreVehicleType() {
            var vehicleTypeName = $('#vehicleTypeName').val();

            $.ajax({
                url: '{{ route('store-vehicletype') }}',
                type: 'POST',
                data: {
                    vehicleTypeName: vehicleTypeName,
                },
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
