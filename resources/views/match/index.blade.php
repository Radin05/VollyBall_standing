<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
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
</head>

<body>

    <div class="col-12 grid-margin">
        <div class="mt-5 card bg-dark text-dark">
            <div class="card-body">
                <h4 class="card-title text-center text-light mb-4" style="font-size: 60px;">List pertandingan
                </h4>
                <div class="row bg-light">
                    <div class="col-md-6">
                        <div class="container">
                            <table class="table table-striped text-center" style="border-collapse: collapse; width: 100%;" border="2">
                                <thead>
                                    <tr>
                                        <th style="border: 1px solid black;">No</th>
                                        <th style="border: 1px solid black;">Tim 1</th>
                                        <th style="border: 1px solid black;">win Set Tim 1</th>
                                        <th style="border: 1px solid black;">Skor Tim 1</th>
                                        <th style="border: 1px solid black;"></th>
                                        <th style="border: 1px solid black;">Tim 2</th>
                                        <th style="border: 1px solid black;">win Set Tim 2</th>
                                        <th style="border: 1px solid black;">Skor Tim 2</th>
                                        <th style="border: 1px solid black;">Tanggal</th>
                                        <th style="border: 1px solid black;">Keterangan hasil</th>
                                        <th style="border: 1px solid black;">Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($matches as $match)
                                        <tr>
                                            <td style="border: 1px solid black;">{{ $loop->iteration }}</td>
                                            <td style="border: 1px solid black;">{{ $match->team1->name }}</td>
                                            <td style="border: 1px solid black;">{{ $match->team1_sets_won }}</td>
                                            <td style="border: 1px solid black;">{{ $match->getTotalScoreTeam1() }}</td> <!-- Skor total tim 1 -->
                                            <td style="border: 1px solid black;">VS</td>
                                            <td style="border: 1px solid black;">{{ $match->team2->name }}</td>
                                            <td style="border: 1px solid black;">{{ $match->team2_sets_won }}</td>
                                            <td style="border: 1px solid black;">{{ $match->getTotalScoreTeam2() }}</td> <!-- Skor total tim 2 -->
                                            <td style="border: 1px solid black;">{{ $match->created_at->format('d M Y') }}</td>
                                            <td style="border: 1px solid black;">
                                                @if ($match->team1_sets_won > $match->team2_sets_won)
                                                    Tim menang: <p class="text-success"> {{ $match->team1->name }} </p>
                                                    <br>
                                                    Tim kalah: <p class="text-danger"> {{ $match->team2->name }}</p>
                                                @elseif ($match->team2_sets_won > $match->team1_sets_won)
                                                    Tim menang: <p class="text-success"> {{ $match->team2->name }}</p>
                                                    <br>
                                                    Tim kalah: <p class="text-danger"> {{ $match->team1->name }}</p>
                                                @endif
                                            </td>
                                            <td style="border: 1px solid black;">
                                                <form action="{{ route('match.destroy', $match->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-danger uhuy"
                                                        onclick="return confirm('Apakah Yakin Ingin Menghapus??')">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-trash-fill"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Jika tidak ada data pertandingan -->
                            @if ($matches->isEmpty())
                                <p class="text-center m-4" style="font-size: 30px">Belum ada hasil pertandingan yang
                                    diinputkan.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <a href="{{ route('match.create') }}" class="btn-secondary btn_uhuy btn-default mt-3 mb-3">
                <h3>Kembali</h3>
            </a>
        </div>
    </div>

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
