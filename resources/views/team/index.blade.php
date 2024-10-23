<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Klasemen</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }} ">
    <style>
        .text-center th {
            padding: 10px;
            /* Adjust padding as needed */
            border: 1px solid #ddd;
            /* Optional: Add borders */
        }

        .text-danger {
            color: red;
            /* Optional: Style for the "KALAH" column */
        }

        /* Optional: Styles for overall table */
        table {
            width: 100%;
            /* Adjust to fit your layout */
            border-collapse: collapse;
            /* Makes borders collapse into one */
        }
    </style>
</head>

<body>
    @include('bar.navbar')
    <div class="container-scroller bg-primary mt-5" align="center">
        <div class="container-fluid page-body-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Klasemen Liga voli RR2</h4>
                        <p class="card-description">
                            Pertandingan Putra
                        </p>
                        @if (strpos(url()->current(), 'pdf') == false)
                            <a href="{{ url('team/view/pdf') }}" class="btn btn-dark text-light">View PDF</a>
                            <a href="{{ url('team/download/pdf') }}" class="btn btn-dark text-success">Download PDF</a>
                            <a href="{{ url('team/export/excel') }}" class="btn btn-success">Download Excel</a>
                        @endif
                        <div class="table-responsive pt-3 m-auto">
                            @include('team.table', $teams)
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('match.create') }}" class="btn btn-primary mb-2">Tambah pertandingan</a>
                    </div>
                </div>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <!-- End custom js for this page>
</body>

</html>
