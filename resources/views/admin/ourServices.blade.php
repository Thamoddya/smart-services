@extends('components.data.AdminLayout')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Our Services</h1>
        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
    </div>
    <div class="col-xl-12 col-lg-7 my-3">
        <a type="button" onclick="POPUP_ADD_SERVICEMODAL();" class="btn btn-success btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Add Service</span>
        </a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Our Services</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Service Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($serviceCenter->ourServices as $index => $services)
                            <tr>
                                <td>{{ $index + 1 }}</td> <!-- Auto-incremented ID -->
                                <td>{{ $services->service_name }}</td>
                                <td>
                                    <a href="{{ route('delete-our-service', $services->id) }}"
                                        class="btn btn-danger btn-sm">
                                        DELETE
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Service Modal -->
    <div class="modal fade" id="addOurServiceModal" tabindex="-1" role="dialog" aria-labelledby="addServiceModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addServiceModalLabel">Add New Service</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div>
                        <input type="text" hidden id="serviceCenterId">
                        <div class="form-group row" id="newServiceName-group">
                            <label for="newServiceName" class="col-sm-3 col-form-label">New Service Name </label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="newServiceName"
                                    placeholder="Enter Service Name">
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

    <script>
        function POPUP_ADD_SERVICEMODAL() {
            $('#serviceCenterId').val({{ $serviceCenter->id }});
            $('#addOurServiceModal').modal('show');
        }

        function storeService() {

            var formData = new FormData();
            formData.append('serviceCenterId', $('#serviceCenterId').val());
            formData.append('newServiceName', $('#newServiceName').val());

            $.ajax({
                type: 'POST',
                url: '{{ route('store-our-service') }}',
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
            $('#newServiceName-group').removeClass('has-error');
            $('#newServiceName-group .help-block').remove();
            $('#newServiceName-group').append('<span class="help-block">' + errors.newServiceName + '</span>');
            $('#newServiceName-group').addClass('has-error');
        }
    </script>
@endsection
