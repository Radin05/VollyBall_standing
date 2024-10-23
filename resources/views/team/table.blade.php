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
    <thead>
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
        @foreach ($teams as $data)
            <tr class="text-center">
                <td scope="row">{{ $no++ }}</td>
                <td>{{ $data->name }}</td>
                <td>
                    <img src="{{ asset($data->cover) }}" alt="Logo {{ $data->name }}"
                        style="width: 50px; height: 50px;">
                </td>
                <td>{{ $data->played }}</td>
                <td>{{ $data->won }}</td>
                <td>{{ $data->lost }}</td>
                <td>{{ $data->sets_played }}</td>
                <td>{{ $data->sets_won }}</td>
                <td>{{ $data->sets_lost }}</td>
                <td>{{ $data->set_difference }}</td>
                <td>{{ $data->getTotalPointsScored() }}</td>
                <td>{{ $data->getTotalPointsAgainst() }}</td>
                <td>{{ $data->point_difference }}</td>
                <td>{{ $data->points }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
