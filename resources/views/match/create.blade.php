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
    <form action="{{ route('match.store') }}" method="POST">
        @csrf
        <div class="col-12 grid-margin">
            <div class="mt-5 card bg-dark text-light">
                <div class="card-body">
                    <h4 class="card-title text-center text-light mb-4" style="font-size: 60px;">Tambahkan pertandingan
                    </h4>
                    <div class="row mx-4">
                        <div class="col-md-6">
                            <div class="form-group row mt-4">
                                <label for="team1_id" class="col-sm-2 col-form-label">Tim 1</label>
                                <div class="col-sm-9">
                                    <select name="team1_id" id="team1_id" class="form-control" required>
                                        <option selected disabled> pilih tim </option>
                                        @foreach ($teams as $team)
                                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row mt-4">
                                <label for="team2_id" class="col-sm-2 col-form-label">Tim 2</label>
                                <div class="col-sm-9">
                                    <select name="team2_id" id="team2_id" class="form-control" required>
                                        <option selected disabled> pilih tim </option>
                                        @foreach ($teams as $team)
                                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mx-5">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="team1_score">menang tim 1</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="number" name="team1_score" id="team1_score" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="team2_score">menang tim 2</label>
                            </div>
                            <div class="col-sm-9">
                                <input type="number" name="team2_score" id="team2_score" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mx-5">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="team1_sets_won" class="col-sm-2">Set Menang Tim 1</label>
                            <div class="col-sm-9">
                                <input type="number" name="team1_sets_won" id="team1_sets_won" class="form-control"
                                    required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="team2_sets_won" class="col-sm-2">Set Menang Tim 2</label>
                            <div class="col-sm-9">
                                <input type="number" name="team2_sets_won" id="team2_sets_won" class="form-control"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mx-5">
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="team1_set_scores[]" class="col-sm-2">Skor Set Tim 1</label>
                            <div class="col-sm-9">
                                <input type="number" name="team1_set_scores[]" class="form-control" required
                                    placeholder="Set 1">
                                <input type="number" name="team1_set_scores[]" class="form-control mt-2" required
                                    placeholder="Set 2">
                                <input type="number" name="team1_set_scores[]" class="form-control mt-2" required
                                    placeholder="Set 3">
                                <input type="number" name="team1_set_scores[]" class="form-control mt-2" required
                                    placeholder="Set 4">
                                <input type="number" name="team1_set_scores[]" class="form-control mt-2" required
                                    placeholder="Set 5">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group row">
                            <label for="team2_set_scores[]" class="col-sm-2">Skor Set Tim 2</label>
                            <div class="col-sm-9">
                                <input type="number" name="team2_set_scores[]" class="form-control" required
                                    placeholder="Set 1">
                                <input type="number" name="team2_set_scores[]" class="form-control mt-2" required
                                    placeholder="Set 2">
                                <input type="number" name="team2_set_scores[]" class="form-control mt-2" required
                                    placeholder="Set 3">
                                <input type="number" name="team2_set_scores[]" class="form-control mt-2" required
                                    placeholder="Set 4">
                                <input type="number" name="team2_set_scores[]" class="form-control mt-2" required
                                    placeholder="Set 5">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-left: 520px;">
                    <div class="col-md-4">
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Simpan Pertandingan</button>
                            <a href="{{ route('match.index') }}" class="btn-primary btn btn-default mt-3"
                                style="margin-left: 8px;">Lihat Pertandingan</a>
                            <a href="{{ route('team.index') }}" class="btn-secondary btn btn-default mt-3"
                                style="margin-left: 41px;">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const team1Select = document.getElementById('team1_id');
            const team2Select = document.getElementById('team2_id');
    
            function disableSelectedTeam() {
                const team1Value = team1Select.value;
                const team2Value = team2Select.value;
    
                // Enable all options first
                Array.from(team2Select.options).forEach(option => {
                    option.disabled = false;
                });
    
                Array.from(team1Select.options).forEach(option => {
                    option.disabled = false;
                });
    
                // Disable the option that matches team1 in team2 select
                if (team1Value) {
                    Array.from(team2Select.options).forEach(option => {
                        if (option.value === team1Value) {
                            option.disabled = true;
                        }
                    });
                }
    
                // Disable the option that matches team2 in team1 select
                if (team2Value) {
                    Array.from(team1Select.options).forEach(option => {
                        if (option.value === team2Value) {
                            option.disabled = true;
                        }
                    });
                }
            }
    
            // Event listener when team1 or team2 is changed
            team1Select.addEventListener('change', disableSelectedTeam);
            team2Select.addEventListener('change', disableSelectedTeam);
        });
    </script>
</body>

</html>
