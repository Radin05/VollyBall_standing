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
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.2/css/buttons.dataTables.css">
</head>

<body>
    @include('bar.navbar')
    <div class="container-scroller bg-dribbble mt-5" align="center">
        <div class="container-fluid page-body-wrapper">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Klasemen Liga voli RR2</h4>
                        <p class="card-description">
                            Pertandingan Putri
                        </p>
                        @if (strpos(url()->current(), 'pdf') == false)
                            <a href="{{ url('team/view/pdf') }}" class="btn btn-dark text-light">View PDF</a>
                            <a href="{{ url('team/download/pdf') }}" class="btn btn-success">Download PDF</a>
                        @endif
                        <div class="table-responsive pt-3 m-auto">
                            <table class="table table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>POSISI</th>
                                        <th colspan="2">TIM</th>
                                        <th>MAIN</th>
                                        <th>MENANG</th>
                                        <th class="text-danger">KALAH</th>
                                        <th>JUMLAH SET MAIN</th>
                                        {{-- <th>JUMLAH SET</th> --}}
                                        <th colspan="3">SCORE SET</th>
                                        <th colspan="3">SCORE POINT</th>
                                        <th class="points-column">POINT</th>
                                    </tr>
                                </thead>
                                    <tr class="text-center">
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>SET MENANG</th>
                                        <th>SET KALAH</th>
                                        <th>SELISIH</th>
                                        <th>MEMASUKAN</th>
                                        <th>KEMASUKAN</th>
                                        <th>SELISIH</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $no = 1; @endphp
                                    @foreach ($tims as $data)
                                        <tr class="text-center">
                                            <td scope="row">{{ $no++ }}</td>
                                            <td>{{ $data->nama }}</td>
                                            <td>
                                                <img src="{{ asset($data->logo) }}" alt="Logo {{ $data->nama }}"
                                                    style="width: 50px; height: 50px;">
                                            </td>
                                            <td>{{ $data->main }}</td>
                                            <td>{{ $data->menang }}</td>
                                            <td>{{ $data->kalah }}</td>
                                            <td>{{ $data->set_main }}</td>
                                            <td>{{ $data->set_menang }}</td>
                                            <td>{{ $data->set_kalah }}</td>
                                            <td>{{ $data->set_difference }}</td>
                                            <td>{{ $data->getTotalSkorScored() }}</td>
                                            <td>{{ $data->getTotalSkorAgainst() }}</td>
                                            <td>{{ $data->skor_difference }}</td>
                                            <td>{{ $data->skor }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('tanding.create') }}" class="btn btn-primary mb-2">Tambah pertandingan</a>
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
    <!-- End custom js for this page-->
</body>

</html>
