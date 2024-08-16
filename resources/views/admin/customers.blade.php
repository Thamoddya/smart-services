@extends('components.data.AdminLayout')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Customer Detail</h1>
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Customers
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $customerCount }}</div>
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
            <a type="button" data-toggle="modal" data-target="#addServiceStationCustomerModal"
                class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Add Customer</span>
            </a>
        </div>
    </div>

    <!-- Customer DataTales -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Customer Data</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Customer Name</th>
                            <th>Customer Email</th>
                            <th>Customer Phone</th>
                            <th>Customer NIC</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>{{ $customer->nic }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add Customer Admin Modal-->
    <div class="modal fade" id="addServiceStationCustomerModal" tabindex="-1" role="dialog"
        aria-labelledby="addServiceStationCustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addServiceStationCustomerModalLabel">Add Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body mx-3">
                    <div>
                        <div class="form-group" id="customerName-group">
                            <label for="customerName">Customer Name</label>
                            <input type="text" class="form-control" id="customerName" placeholder="Enter Customer Name">
                        </div>
                        <div class="form-group" id="customerEmail-group">
                            <label for="customerEmail">Customer Email</label>
                            <input type="email" class="form-control" id="customerEmail"
                                placeholder="Enter Customer Email">
                        </div>
                        <div class="form-group row">
                            <div class="col" id="customerPhone-group">
                                <label for="customerPhone">Customer Phone</label>
                                <input type="number" class="form-control" id="customerPhone"
                                    placeholder="Enter Customer Phone">
                            </div>
                            <div class="col" id="customerNIC-group">
                                <label for="customerNIC">Customer NIC</label>
                                <input type="text" class="form-control" id="customerNIC"
                                    placeholder="Enter Customer NIC">
                            </div>
                        </div>
                        <div class="form-group" id="customerAddress-group">
                            <label for="customerAddress">Customer Address</label>
                            <input type="text" class="form-control" id="customerAddress"
                                placeholder="Enter Customer Address">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="addServiceStationCustomer();">Save
                        changes</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addServiceStationCustomer() {
            var customerName = $('#customerName').val();
            var customerEmail = $('#customerEmail').val();
            var customerPhone = $('#customerPhone').val();
            var customerNIC = $('#customerNIC').val();
            var customerAddress = $('#customerAddress').val();

            $.ajax({
                type: 'POST',
                url: '{{ route('store-customer') }}',
                data: {
                    customerName: customerName,
                    customerEmail: customerEmail,
                    customerPhone: customerPhone,
                    customerNIC: customerNIC,
                    customerAddress: customerAddress,
                    serviceCenterId: {{ $serviceCenter->id }}
                },
                success: function(data) {
                    if (data.status === 'success') {
                        alert('Customer added successfully');
                        window.location.reload();
                    } else if (data.status === 'error') {
                        // Display validation errors
                        displayValidationErrors(data.errors);
                        console.log(data.errors);

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
