<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klasemen Tim </title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }

        /* Aturan baru untuk kolom nama tim dan gambar */
        .team-name,
        .team-logo {
            width: 100px;
        }
    </style>
</head>

<body>
    <div style="text-align: center; margin-bottom: 30px;">
        <div style="float: left; width: 30%;">
            <img src="{{ public_path('rt/mbb.png') }}" alt="Mbb" width="100px" height="50px">
        </div>
        <div style="float: left; width: 40%;">
            <p style="color: red; font-size: 11px;"><b>KLASEMEN PERTANDINGAN LIGA VOLI PUTRA</b></p>
            <p style="font-size: 10px;"><b>TURNAMEN SUMPAH PEMUDA PIALA TAHUN 2024</b></p>
            <p style="font-size: 10px;"><b>RW 20 KABUPATEN RANCAMANYAR 2</b></p>
        </div>
        <div style="float: left; width: 30%;">
            <img src="{{ public_path('rt/logo tour sumpah pemuda.png') }}" alt="Logo" width="100px" height="50px">
        </div>
        <div style="clear: both;"></div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Posisi</th>
                <th colspan="2">Tim</th>
                <th>Main</th>
                <th>Menang</th>
                <th>Kalah</th>
                <th>Set Menang</th>
                <th>Set Kalah</th>
                <th>Selisih Set</th>
                <th>Skor Memasukkan</th>
                <th>Skor Kemasukan</th>
                <th>Selisih Skor</th>
                <th>Poin</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($teams as $team)
                <tr class="text-center">
                    <td scope="row">{{ $no++ }}</td>
                    <td class="team-name">{{ $team->name }}</td>
                    <td class="team-logo">
                        <img src="{{ public_path($team->cover) }}" alt="Logo {{ $team->name }}"
                            style="width: 50px; height: 50px;">
                    </td>
                    <td>{{ $team->played }}</td>
                    <td>{{ $team->won }}</td>
                    <td>{{ $team->lost }}</td>
                    <td>{{ $team->sets_won }}</td>
                    <td>{{ $team->sets_lost }}</td>
                    <td>{{ $team->set_difference }}</td>
                    <td>{{ $team->getTotalPointsScored() }}</td>
                    <td>{{ $team->getTotalPointsAgainst() }}</td>
                    <td>{{ $team->point_difference }}</td>
                    <td>{{ $team->points }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- putri --}}

    <div style="text-align: center; margin-bottom: 30px; margin-top: 30px;">
        <div style="float: left; width: 30%;">
            <img src="{{ public_path('rt/mbb.png') }}" alt="Mbb" width="100px" height="50px">
        </div>
        <div style="float: left; width: 40%;">
            <p style="color: red; font-size: 11px;"><b>KLASEMEN PERTANDINGAN LIGA VOLI PUTRA</b></p>
            <p style="font-size: 10px;"><b>TURNAMEN SUMPAH PEMUDA PIALA TAHUN 2024</b></p>
            <p style="font-size: 10px;"><b>RW 20 KABUPATEN RANCAMANYAR 2</b></p>
        </div>
        <div style="float: left; width: 30%;">
            <img src="{{ public_path('rt/logo tour sumpah pemuda.png') }}" alt="Logo" width="100px" height="50px">
        </div>
        <div style="clear: both;"></div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Posisi</th>
                <th colspan="2">Tim</th>
                <th>Main</th>
                <th>Menang</th>
                <th>Kalah</th>
                <th>Set Menang</th>
                <th>Set Kalah</th>
                <th>Selisih Set</th>
                <th>Skor Memasukkan</th>
                <th>Skor Kemasukan</th>
                <th>Selisih Skor</th>
                <th>Poin</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($tims as $data)
                <tr class="text-center">
                    <td scope="row">{{ $no++ }}</td>
                    <td class="team-name">{{ $data->nama }}</td>
                    <td class="team-logo">
                        <img src="{{ public_path($data->logo) }}" alt="Logo {{ $data->nama }}"
                            style="width: 50px; height: 50px;">
                    </td>
                    <td>{{ $data->main }}</td>
                    <td>{{ $data->menang }}</td>
                    <td>{{ $data->kalah }}</td>
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

    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body" style="text-align: left;  white-space: nowrap;">
                    <p class="card-title">Keterangan:</p>
                    <ol class="font-weight-500">
                        <li>Tim yang menang dalam setiap partai pertandingan mendapat point
                            1 dan yang kalah tidak mendapat point (0).</li>
                        <li>Urutan klasemen berdasarkan komulatif jumlah point kemenangan di
                            setiap partai yang dimenangkan.</li>
                        <li>
                            Apabila terdapat kesamaan nilai komulatif jumlah point kemenangan antara satu tim dengan tim
                            yang lainnya atau beberapa tim lainnya,
                            maka klasemen ditentukan dengan jumlah score set kemenangan. Apabila masih ada kesamaan
                            juga,
                            maka klasemen ditentukan dengan selisih score point memasukan dan kemasukan dari tim yang
                            mempunyai nilai sama pada point kemenangan.
                            Apabila masih terjadi kesamaan, maka ditentukan dengan head to head di antara tim yang
                            memiliki nilai point yang sama tersebut.
                        </li>
                        <li>
                            Setelah semua partai pertandingan dimainkan, berdasarkanperingkat klasemen akhir untuk final
                            perebutan juara 1, 2 dan 3
                            akan dipertandingkan
                            <br>
                            perebutan juara 1 antara peringkat klasemen 1 dan 2, untuk
                            perebutan juara 3 antara peringkat klasemen 3 dan 4.
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
