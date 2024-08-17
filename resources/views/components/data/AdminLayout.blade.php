<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0,shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('data/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('data/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <link href="{{ asset('data/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <style>
        .vehicle-card {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .vehicle-header {
            text-align: center;
            margin-bottom: 15px;
        }

        .vehicle-body {
            display: flex;
            justify-content: space-between;
            width: 100%;
        }

        .vehicle-info {
            flex: 1;
        }

        .vehicle-qr {
            flex: 0 0 128px;
            margin-left: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .vehicle-qr #qrcode {
            width: 128px;
            height: 128px;
        }
    </style>
</head>

<body>

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('components.data.AdminSidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('components.data.superAdminTopbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>


    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{ route('logout') }}">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('data/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('data/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('data/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('data/js/sb-admin-2.min.js') }}"></script>

    {{-- <!-- Page level plugins -->
    <script src="{{ asset('data/vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('data/js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('data/js/demo/chart-pie-demo.js') }}"></script> --}}

    <!-- Page level plugins -->
    <script src="{{ asset('data/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('data/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.flash.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    @if (Route::currentRouteName() == 'admin.index')
        <!-- Page level plugins -->
        <script src="{{ asset('data/vendor/chart.js/Chart.min.js') }}"></script>

        <!-- Page level custom scripts -->
        <script src="{{ asset('data/js/demo/chart-area-demo.js') }}"></script>
        <script src="{{ asset('data/js/demo/chart-pie-demo.js') }}"></script>

        <script>
            var ctx = document.getElementById("myAreaChart");
            var monthlyRevenue = @json($monthlyRevenue); // Pass PHP array to JavaScript

            var myLineChart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: [
                        // Adjust labels as needed
                        "{{ now()->subMonths(4)->format('M') }}",
                        "{{ now()->subMonths(3)->format('M') }}",
                        "{{ now()->subMonths(2)->format('M') }}",
                        "{{ now()->subMonths(1)->format('M') }}",
                        "{{ now()->format('M') }}",
                    ],
                    datasets: [{
                        label: "Earnings",
                        lineTension: 0.3,
                        backgroundColor: "rgba(78, 115, 223, 0.05)",
                        borderColor: "rgba(78, 115, 223, 1)",
                        pointRadius: 3,
                        pointBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointBorderColor: "rgba(78, 115, 223, 1)",
                        pointHoverRadius: 3,
                        pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
                        pointHoverBorderColor: "rgba(78, 115, 223, 1)",
                        pointHitRadius: 10,
                        pointBorderWidth: 2,
                        data: monthlyRevenue,
                    }, ],
                },
                options: {
                    // Your existing chart options
                },
            });

            var ctx = document.getElementById("myPieChart");
            var vehicleTypeLabels = @json($vehicleTypeLabels); // Pass PHP array to JavaScript
            var vehicleTypeCounts = @json($vehicleTypeCounts); // Pass PHP array to JavaScript

            var myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: vehicleTypeLabels,
                    datasets: [{
                        data: vehicleTypeCounts,
                        backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e',
                        '#e74a3b'], // Add more colors if needed
                        hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf', '#d4a23b', '#c13a3b'],
                        hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                    },
                    legend: {
                        display: true // Set to true to display the legend
                    },
                    cutoutPercentage: 80,
                },
            });
        </script>
    @endif

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'csvHtml5',
                        text: '<i class="fa fa-file-csv"></i> CSV',
                        titleAttr: 'Export to CSV',
                        className: 'btn btn-primary my-2' // Adds Bootstrap primary button styling
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf"></i> PDF',
                        titleAttr: 'Export to PDF',
                        className: 'btn btn-danger my-2' // Adds Bootstrap danger button styling (red)
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> Print',
                        titleAttr: 'Print',
                        className: 'btn btn-success my-2' // Adds Bootstrap success button styling (green)
                    }
                ]
            });
        });
    </script>
</body>

</html>
